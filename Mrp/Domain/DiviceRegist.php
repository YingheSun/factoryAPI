<?php

/**
 * 用户注册接口文件
 *
 * @author: YHS 20160603
 * @author: YHS 20160619 重构
 * @author: YHS 20160720 重构
 * @author: YHS 20170112 重构
 */
class Domain_DiviceRegist {

    public function diviceReg($data) {
        $this->userIdCheck($data->userId);
        $this->diviceCheck($data->uuid);
        $this->RegDivice($data);
    }

    public function diviceCheck($uuid) {
        $getCheck = new Model_ESUserLogin();
        $retInfo = $getCheck->getUserbyUUID($uuid);
        if ($retInfo) {
            throw new PhalApi_Exception_BadRequest(T("divice already Exists"), 201);
        }
    }

    public function userIdCheck($userId) {
        $getCheck = new Model_ESUserLogin();
        $retInfo = $getCheck->getInfobyuserId($userId);
        if ($retInfo) {
            throw new PhalApi_Exception_BadRequest(T("user already Exists"), 201);
        }
    }

    public function RegDivice($data) {
        $regDivice = new Model_ESUserLogin();
        $regDivice->addDivice($data);
    }

}
