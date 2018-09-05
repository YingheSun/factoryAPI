<?php

class Domain_LoginAction {

    public function login_Action($data) {
        $getPassInfos = new Model_PassCode();
        $passInfo = $getPassInfos->getPassCode($data->name);
        return $this->loginCheck($passInfo, $data);
    }

    public function loginCheck($passInfo, $data) {
        if (!$passInfo) {
            throw new PhalApi_Exception_BadRequest(T('passCode Error'), 101);
        }
        if ($passInfo['admin_passcode'] != $data->password) {
            throw new PhalApi_Exception_BadRequest(T('passCode Error'), 102);
        }
        if ($passInfo['state'] != "activate") {
            throw new PhalApi_Exception_BadRequest(T('not activated'), 103);
        }
        return $this->makeToken($passInfo);
    }

    public function makeToken($passInfo) {
        $time = date('Ymd') . substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
        $token = md5($time . $passInfo['reg_time']);
        return $this->updateToken($passInfo['id'], $token, $passInfo['compid']);
    }

    public function updateToken($user_id, $token, $level) {
        $logData = new Model_PassLog();
        $logData->login_Log_Add($user_id, $token, $level);
        return $this->retToken($user_id, $token);
    }

    public function retToken($id, $token) {
        $getLogInfo = new Model_PassLog();
        return $getLogInfo->getTokenInfo($id, $token);
    }

}
