<?php

class Domain_ActionInfo {

    public function set_Action_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setActionInfo($data);
        }
    }

    public function get_Action_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $set_Info = new Model_ActionInfo();
            return $set_Info->getInfoById($data->id);
        }
    }

    public function get_action_list($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $get_List = new Model_RelDutyAction();
            return $get_List->getActionList($data->id);
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

    public function setActionInfo($data) {
        //set Authority Info
        $set_Info = new Model_ActionInfo();
        return $set_Info->setActionInfo($data);
    }

}
