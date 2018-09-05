<?php

class Domain_AdminStatChg {

    public function AdminStatChg($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode && $this->uniqueCheck($data)) {
            $addAdmin = new Model_AdminInfo();
            $addAdmin->chgState($data->id, $data->state);
        }
        return array("修改成功");
    }

    public function AdminPassCodeChg($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        $getLogInfo = new Model_PassLog();
        $res = $getLogInfo->getInfos($data->checkCode, $data->token);
        if ($chkCode && $this->passcodeCheck($data, $res['admin_id'])) {
            $addAdmin = new Model_AdminInfo();
            $addAdmin->chgPassCode($res['admin_id'], $data->newpassword);
        }
        return array("修改成功");
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

    public function uniqueCheck($data) {
        $unicCheck = new Model_AdminInfo();
        if ($unicCheck->getAdminInfo($data->id)) {
            return TRUE;
        } else {
            throw new PhalApi_Exception_BadRequest(T('no Admin'), 107);
        }
    }

    public function passcodeCheck($data, $id) {
        $unicCheck = new Model_AdminInfo();
        $usrInfo = $unicCheck->getAdminInfo($id);
        DI()->logger->info($id . "fffffff" .$usrInfo['admin_passcode']."fffffff".$data->password .$usrInfo['admin_name']."fdsafsdaf".$data->name);
        if ($usrInfo['admin_passcode'] == $data->password && $usrInfo['admin_name'] == $data->name) {
            return TRUE;
        } else {
            throw new PhalApi_Exception_BadRequest(T('no Admin'), 107);
        }
    }

}
