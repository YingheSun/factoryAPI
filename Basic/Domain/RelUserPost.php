<?php

class Domain_RelUserPost {

    public function set_Rel_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setRelInfo($data);
        }
    }

    public function checkToken($id, $token) {
        $getLogInfo = new Model_PassLog();
        $res = $getLogInfo->getInfos($id, $token);
        if (!$res) {
            throw new PhalApi_Exception_BadRequest(T('no Token'), 104);
        }
        if ($res['overdue_time'] < time()) {
            throw new PhalApi_Exception_BadRequest(T('overdued'), 105);
        }
        $resetLogInfo = new Model_PassLog();
        $resetLogInfo->reset_overdue_time($id);
        return TRUE;
    }

    public function check_rel($data) {
        $check_Rel = new Model_RelUserPost();
        $rel_state = $check_Rel->checkExistState($data);
        if ($rel_state) {
            throw new PhalApi_Exception_BadRequest(T('has already seted Relation'), 106);
        }
        $check_PostState = new Model_PostInfo();
        $post_state = $check_PostState->getInfoById($data->postId);
        if (!$post_state) {
            throw new PhalApi_Exception_BadRequest(T('no Post'), 110);
        }
        $check_DutyState = new Model_UserInfo();
        $duty_State = $check_DutyState->getInfoById($data->userId);
        if (!$duty_State) {
            throw new PhalApi_Exception_BadRequest(T('no User'), 112);
        }
    }

    public function setRelInfo($data) {
        $this->check_rel($data);
        $postBaseInfo = $this->getAuthTree($data->postId, $data->userId);
        $set_Rel = new Model_RelUserPost();
        $set_Rel->setRelInfo($data);
        return $postBaseInfo;
//        return array("设置成功");
    }

    public function getAuthTree($postId, $userId) {
        //get Post Base Environment Info
        $baseInfo = $this->getPostInfo($postId);
        //get list Info
        $authList = $this->getPostAuth($postId);
        $authListAll = $this->getExecList($baseInfo, $authList, $postId, $userId);
        $this->makePostAuths($authListAll);
//        return $authList;
    }

    public function getPostInfo($postId) {
        $retArr = [];
        /*
         * get Comp Org Group ID
         */
        //get Group ID
        $getGroupId = new Model_RelGroupPost();
        $retArr['groupId'] = $getGroupId->getGroupId($postId);
        //get Org ID
        $getOrgId = new Model_RelOrgGroup();
        $retArr['orgId'] = $getOrgId->getOrgId($retArr['groupId']);
        //get Comp ID
        $getCompId = new Model_RelCompOrg();
        $retArr['compId'] = $getCompId->getCompId($retArr['orgId']);
        if (!$retArr['groupId'] || !$retArr['orgId'] || !$retArr['compId']) {
            throw new PhalApi_Exception_BadRequest(T('post base Info Error'), 113);
        }
        return $retArr;
    }

    public function updateUserInfo($userId, $postId, $compId) {
        $set_Info = new Model_UserInfo();
        return $set_Info->updateInfoById($userId, $postId, $compId);
    }

    public function getPostAuth($postId) {
        $retArr = [];
        /*
         * get All Duty Action Auth ID
         */
        //get Dutys
        $getDuty = new Model_RelPostDuty();
        $dutys = $getDuty->getRel($postId);
        $actions = $this->getActionList($dutys);
        $retArr[] = $this->getAuthsList($actions);
        return $retArr;
    }

    public function getActionList($dutys) {
        $retArr = [];
        foreach ($dutys as $key => $value) {
            //get Actions
            $getActions = new Model_RelDutyAction();
            $actions = $getActions->getActionIds($value['basic_duty_id']);
            foreach ($actions as $keyAc => $valueAc) {
                $retArr[] = $valueAc;
            }
        }
        return $retArr;
    }

    public function getAuthsList($actions) {
        $retArr = [];
        foreach ($actions as $key => $value) {
            //get Actions
            $getAuths = new Model_RelActionAuth();
            $auths = $getAuths->getAuthIds($value['basic_action_id']);
            foreach ($auths as $keyAu => $valueAu) {
                $retArr[][] = array(
                    'authority_id' => $valueAu['basic_authority_id'],
                    'action_id' => $value['basic_action_id'],
                    'duty_id' => $value['basic_duty_id']
                );
            }
        }
        return $retArr;
    }

    public function getExecList($baseInfo, $authList, $postId, $userId) {
        //update userinfo table
        $this->updateUserInfo($userId, $postId, $baseInfo['compId']['basic_company_id']);
        $retArr = [];
        foreach ($authList as $keyOut => $valueOut) {
            foreach ($authList[$keyOut] as $keyIn => $value) {
                $retArr[][] = array(
                    'authId' => $value[$keyOut]['authority_id'],
                    'actionId' => $value[$keyOut]['action_id'],
                    'dutyId' => $value[$keyOut]['duty_id'],
                    'postId' => $postId,
                    'userId' => $userId,
                    'groupId' => $baseInfo['groupId']['group_id'],
                    'orgId' => $baseInfo['orgId']['basic_organize_id'],
                    'compId' => $baseInfo['compId']['basic_company_id'],
                );
            }
        }
        return $retArr;
    }

    public function makePostAuths($authList) {
        $this->makePostAuthsCheck($authList);
    }

    public function makePostAuthsCheck($authList) {
        foreach ($authList as $keyOut => $valueOut) {
            foreach ($authList[$keyOut] as $keyIn => $value) {
                $getAuthInfoCheck = new Model_UserAuth();
                $state_info = $getAuthInfoCheck->getAuthCheck($value['authId'], $value['actionId'], $value['dutyId'], $value['postId'], $value['userId'], $value['groupId'], $value['orgId'], $value['compId']);
                if (!$state_info) {
                    //set the Auth which DB don't have
                    $this->PostAuthsSetter($value['authId'], $value['actionId'], $value['dutyId'], $value['postId'], $value['userId'], $value['groupId'], $value['orgId'], $value['compId']);
                }
            }
        }
    }

    public function PostAuthsSetter($authId, $actionId, $dutyId, $postId, $userId, $groupId, $orgId, $compId) {
        $setAuths = new Model_UserAuth();
        $setAuths->setUserAuth($authId, $actionId, $dutyId, $postId, $userId, $groupId, $orgId, $compId);
    }

}
