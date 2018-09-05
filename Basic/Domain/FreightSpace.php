<?php

class Domain_FreightSpace {

    public function add_Space($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->add_FreightSpace($data);
        }
    }

    public function getList($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getFreightSpaceList($data);
        }
    }

    public function makeSpaceState($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->makeFreightSpaceState($data);
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

    public function add_FreightSpace($data) {
        if ($data->number > 1000) {
            throw new PhalApi_Exception_BadRequest(T('more than limit'), 111);
        }
        //check_exist state
        $statecheck = new Model_FreightSpace();
        $checkState = $statecheck->getPrefixExistState($data);

        if ($checkState) {
            throw new PhalApi_Exception_BadRequest(T('already existed Prefix'), 110);
        } else {
            $this->createPrefix($data);
        }
        //create FreightSpace Account
        $this->createSerialNum($data);
        //update FS Account 
        $this->updateFSAccount($data);
    }

    public function createPrefix($data) {
        $model_space = new Model_FreightSpace();
        return $model_space->addPrefixExistState($data);
    }

    public function createSerialNum($data) {
        for ($i = 0; $i < intval($data->number); $i++) {
            $temp_num = 10000000;
            $new_num = $i + $temp_num + 1;
            $real_num = "_FS_" . substr($new_num, 1, 7); //即截取掉最前面的“1”
            $serial_num = $data->name . '_' . $data->type . '_' . $data->storeId . $real_num;
            $model_space = new Model_FreightSpace();
            DI()->logger->info('创建仓位:' . $serial_num . '进度:' . $i . '/' . $data->number);
            $model_space->setFreightSpaceInfo($data, $serial_num);
        }
    }

    public function updateFSAccount($data) {
        $getAccount = new Model_FreightSpace();
        $account = $getAccount->getStoreFSAccount($data);
        $updateAcc = new Model_Store();
        $updateAcc->updateStoreFS($data->storeId, $account);
    }

    public function getFreightSpaceList($data) {
        $model_space = new Model_FreightSpace();
        return $model_space->getList($data);
    }

    public function makeFreightSpaceState($data) {
        $model_space = new Model_FreightSpace();
        return $model_space->makeFreightSpaceState($data);
    }

}
