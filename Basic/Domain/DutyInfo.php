<?php

class Domain_DutyInfo {

    public function set_Duty_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setDutyInfo($data);
        }
    }

    public function get_Duty_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $set_Info = new Model_DutyInfo();
            return $set_Info->getInfoById($data->id);
        }
    }

    public function get_duty_list($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getDutyList($data);
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

    public function setDutyInfo($data) {
        $set_Info = new Model_DutyInfo();
        return $set_Info->setDutyInfo($data);
    }

    public function getDutyList($data) {
        $get_List = new Model_RelPostDuty();
        return $get_List->getDutyList($data->id);
    }

}
