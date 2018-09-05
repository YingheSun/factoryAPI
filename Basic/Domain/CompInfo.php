<?php

class Domain_CompInfo {

    public function set_Comp_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setCompInfo($data);
        }
    }
    
     public function get_Comp_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getCompInfo($data);
        }
    }

    public function get_Comps_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $get_Info = new Model_CompInfo();
            return $get_Info->getCompLists();
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

    public function setCompInfo($data) {
        $set_Info = new Model_CompInfo();
        return $set_Info->setCompInfo($data);
    }
    
    public function getCompInfo($data) {
        $get_Info = new Model_CompInfo();
        return $get_Info->getInfoById($data->id);
    }

}
