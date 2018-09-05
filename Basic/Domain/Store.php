<?php

class Domain_Store {

    public function addStore($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->addStoreToComp($data);
        }
    }

    public function storeList($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getStoreList($data);
        }
    }

    public function storeState($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->makeStoreState($data);
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

    public function addStoreToComp($data) {
        //add to store
        $model_store = new Model_Store();
        $model_store->addStore($data);
        //set store table 
        $model_storeset = new Model_StoreSet();
        $model_storeset->addStore($data->compid);
    }

    public function getStoreList($data) {
        $model_store = new Model_Store();
        if (isset($data->compid)) {
            return $model_store->getcompStoreList($data->compid);
        } else {
            return $model_store->getStoreList();
        }
    }

    public function makeStoreState($data) {
        $model_store = new Model_Store();
        $model_store->makeStoreState($data->storeid, $data->state);
    }

}
