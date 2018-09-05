<?php

class Domain_GetGroupPosts {

    public function get_Tree_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getTreeInfo($data);
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
        $check_GroupState = new Model_GroupInfo();
        $group_state = $check_GroupState->getInfoById($data->groupId);
        if (!$group_state) {
            throw new PhalApi_Exception_BadRequest(T('no Group'), 109);
        }
    }

    public function getTreeInfo($data) {
        $this->check_rel($data);
        return $this->getPosts($data->groupId);
    }

    public function getPosts($groupId) {
        //get Org Relation
        $groupRel = new Model_RelGroupPost();
        $postInfos = $groupRel->getRel($groupId);
        //get All Releated Org Info
        foreach ($postInfos as $key => $value) {
            $psotsInfo = new Model_PostInfo();
            $retArr['postInfos'][$key] = $psotsInfo->getInfoById($value['posts_id']);
            $retArr['postInfos'][$key]['rel_group_post'] = $value;
            //get Duty Relation
            $postRel = new Model_RelPostDuty();
            $dutyRel = $postRel->getRel($value['posts_id']);
            //get All Releated Group Info
            foreach ($dutyRel as $keyD => $value) {
                $groupInfo = new Model_GroupInfo();
                $retArr['postInfos'][$key]['dutyInfos'][$keyD] = $groupInfo->getInfoById($value['duty_id']);
            }
        }
        return $retArr;
    }

}
