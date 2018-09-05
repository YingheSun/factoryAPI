<?php

class Domain_AuthInfo {

    public function set_Auth_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setAuthInfo($data);
        }
    }

    public function get_Auth_List_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $getList = new Model_RelActionAuth();
            return $getList->getAuthList($data->id);
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

    public function setAuthInfo($data) {
        //set Authority Info
        $set_Info = new Model_AuthInfo();
        return $set_Info->setAuthInfo($data);
    }

}
