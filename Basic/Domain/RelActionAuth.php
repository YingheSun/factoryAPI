<?php

class Domain_RelActionAuth {

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
        $check_Rel = new Model_RelActionAuth();
        $rel_state = $check_Rel->checkExistState($data);
        if ($rel_state) {
            throw new PhalApi_Exception_BadRequest(T('has already seted Relation'), 106);
        }
        $check_ActionState = new Model_ActionInfo();
        $action_state = $check_ActionState->getInfoById($data->actionId);
        if (!$action_state) {
            throw new PhalApi_Exception_BadRequest(T('no Action'), 112);
        }
        $check_AuthState = new Model_AuthInfo();
        $auth_State = $check_AuthState->getInfoById($data->authId);
        if (!$auth_State) {
            throw new PhalApi_Exception_BadRequest(T('no Auth'), 113);
        }
    }

    public function setRelInfo($data) {
        $this->check_rel($data);
        $set_Rel = new Model_RelActionAuth();
        $set_Rel->setRelInfo($data);
        return array("设置成功");
    }

}
