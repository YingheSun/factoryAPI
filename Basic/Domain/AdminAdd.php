<?php

class Domain_AdminAdd {

    public function AdminAdd($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode && $this->uniqueCheck($data)) {
            $addAdmin = new Model_PassCode();
            $addAdmin->Admin_Add($data);
        }
        return array("创建成功");
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
        $unicCheck = new Model_PassCode();
        if ($unicCheck->getPassCode($data->name)) {
            throw new PhalApi_Exception_BadRequest(T('unique check error'), 106);
        } else {
            return TRUE;
        }
    }

}
