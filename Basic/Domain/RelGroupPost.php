<?php

class Domain_RelGroupPost {

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
        $check_Rel = new Model_RelGroupPost();
        $rel_state = $check_Rel->checkExistState($data);
        if ($rel_state) {
            throw new PhalApi_Exception_BadRequest(T('has already seted Relation'), 106);
        }
        $check_GroupState = new Model_GroupInfo();
        $group_state = $check_GroupState->getInfoById($data->groupId);
        if (!$group_state) {
            throw new PhalApi_Exception_BadRequest(T('no Group'), 109);
        }
        $check_PostState = new Model_PostInfo();
        $post_State = $check_PostState->getInfoById($data->postId);
        if (!$post_State) {
            throw new PhalApi_Exception_BadRequest(T('no Post'), 110);
        }
    }

    public function setRelInfo($data) {
        $this->check_rel($data);
        $set_Rel = new Model_RelGroupPost();
        $set_Rel->setRelInfo($data);
        return array("设置成功");
    }

}
