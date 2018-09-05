<?php

class Domain_PostTopology {

    public function get_Topology_Action($data) {
        $Model_UserInfo = new Model_DiviceInfo();
        $info = $Model_UserInfo->getUserbyUUID($data->uuid);
        return $this->get_Topology_mobile($info['post_id'], $info['user_id']);
    }

    public function get_Topology_mobile($postid, $userid) {
        return $this->getAuthTree($postid, $userid);
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

    public function getAuthTree($postId, $userId) {
        //get Post Base Environment Info
        $baseInfo = $this->getPostInfo($postId, $userId);
        //get list Info
        $authList = $this->getPostAuth($postId);
        $authListAll = $this->getExecList($baseInfo, $authList, $postId, $userId);
        return $authListAll;
    }

    public function getPostInfo($postId, $userId) {
        $retArr = [];
        /*
         * get Comp Org Group ID
         */
        $getuserInfo = new Model_UserInfo();
        $retArr['userName'] = $getuserInfo->getInfoById($userId);
        $getPostinfo = new Model_PostInfo();
        $retArr['postName'] = $getPostinfo->getInfoById($postId);
        //get Group ID
        $getGroupId = new Model_RelGroupPost();
        $retArr['groupId'] = $getGroupId->getGroupId($postId);
        $getGroupinfo = new Model_GroupInfo();
        $retArr['groupName'] = $getGroupinfo->getInfoById($retArr['groupId']);
        //get Org ID
        $getOrgId = new Model_RelOrgGroup();
        $retArr['orgId'] = $getOrgId->getOrgId($retArr['groupId']);
        $getOrginfo = new Model_OrgInfo();
        $retArr['orgName'] = $getOrginfo->getInfoById($retArr['orgId']);
        //get Comp ID
        $getCompId = new Model_RelCompOrg();
        $retArr['compId'] = $getCompId->getCompId($retArr['orgId']);
        $getCompinfo = new Model_CompInfo();
        $retArr['compName'] = $getCompinfo->getInfoById($retArr['compId']);
        if (!$retArr['groupId'] || !$retArr['orgId'] || !$retArr['compId']) {
            throw new PhalApi_Exception_BadRequest(T('post base Info Error'), 113);
        }
        return $retArr;
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

    public function getNames($lists) {
        foreach ($lists as $key => $valueOut) {
            $getDutyInfo = new Model_DutyInfo();
            $lists[]['dutyName'] = $getDutyInfo->getInfoById($lists[$key]['dutyId']);
            $getActionInfo = new Model_DutyInfo();
            $lists[]['actionName'] = $getActionInfo->getInfoById($lists[$key]['actionId']);
            $getAuthInfo = new Model_AuthInfo();
            $lists[]['authName'] = $getAuthInfo->getInfoById($lists[$key]['authId']);
        }
        return $lists;
    }

    public function getExecList($baseInfo, $authList, $postId, $userId) {
        $retArr = [];
        foreach ($authList as $keyOut => $valueOut) {
            foreach ($authList[$keyOut] as $keyIn => $value) {
                $getDutyInfo = new Model_DutyInfo();
                $dutyName = $getDutyInfo->getInfoById($value[$keyOut]['duty_id']);
                $getActionInfo = new Model_ActionInfo();
                $actionName = $getActionInfo->getInfoById($value[$keyOut]['action_id']);
                $getAuthInfo = new Model_AuthInfo();
                $authName = $getAuthInfo->getInfoById($value[$keyOut]['authority_id']);
                $retArr[][] = array(
                    'authId' => $value[$keyOut]['authority_id'],
                    'authName' => $authName['authority_name'],
                    'actionId' => $value[$keyOut]['action_id'],
                    'actionName' => $actionName['action_name'],
                    'dutyId' => $value[$keyOut]['duty_id'],
                    'dutyName' => $dutyName['duty_name'],
                    'postId' => $postId,
                    'postName' => $baseInfo['postName']['post_name'],
                    'userId' => $userId,
                    'userName' => $baseInfo['userName']['user_name'],
                    'groupId' => $baseInfo['groupId']['group_id'],
                    'groupName' => $baseInfo['groupName']['group_name'],
                    'orgId' => $baseInfo['orgId']['basic_organize_id'],
                    'orgName' => $baseInfo['orgName']['organize_name'],
                    'compId' => $baseInfo['compId']['basic_company_id'],
                    'compName' => $baseInfo['compName']['company_name'],
                );
            }
        }
        return $retArr;
    }

}
