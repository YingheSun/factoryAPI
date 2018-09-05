<?php

class Domain_PostInfo {

    public function set_Post_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setPostInfo($data);
        }
    }
    
    public function get_Post_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getsPostInfo($data);
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

    public function setPostInfo($data) {
        $set_Info = new Model_PostInfo();
        return $set_Info->setPostInfo($data);
    }
    
    public function getsPostInfo($data) {
        $set_Info = new Model_PostInfo();
        return $set_Info->getInfoById($data->id);
    }

}
