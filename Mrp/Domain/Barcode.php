<?php

/**
 * 查看条码接口文件
 *
 */
class Domain_Barcode {

    public function getBarcode($data) {
        $userInfo = $this->UUIDCheck($data->uuid);
        if ($data->mode == "basic") {
            return $this->basicMode($data);
        } else if ($data->mode == "scanin") {
            return $this->scanInMode($userInfo, $data);
        } elseif ($data->mode == "scanout") {
            
        }
    }

    public function basicMode($data) {
        $Model_Barcode = new Model_Barcode();
        $retBasicInfo = $Model_Barcode->getBarcode($data->barcode);
        if (!$retBasicInfo) {
            throw new PhalApi_Exception_BadRequest(T("Barcode don't Exists"), 204);
        }
        $ret = array(
            "GoodInfo" => NULL,
            "BasicInfo" => $retBasicInfo
        );
        return $ret;
    }

    public function scanInMode($userInfo, $data) {
        $getGoodInfo = new Model_Goods();
        $retGoodInfo = $getGoodInfo->getGoods($userInfo['compid'], $data->barcode);
        if (!$retGoodInfo) {
            //get normal Barcode DB Info
            $Model_Barcode = new Model_Barcode();
            $retBasicInfo = $Model_Barcode->getBarcode($data->barcode);
            if (!$retBasicInfo) {
                throw new PhalApi_Exception_BadRequest(T("Barcode don't Exists"), 204);
            }
            $ret = array(
                "GoodInfo" => NULL,
                "BasicInfo" => $retBasicInfo
            );
        } else {
            $ret = array(
                "GoodInfo" => $retGoodInfo,
                "BasicInfo" => NULL
            );
        }
        return $ret;
    }

    public function UUIDCheck($uuid) {
        $Model_User = new Model_ESUserLogin();
        $userInfo = $Model_User->getUserbyUUID($uuid);
        if (!$userInfo) {
            throw new PhalApi_Exception_BadRequest(T("divice not allowed"), 207);
        }
        if ($userInfo['state'] != 'activate') {
            throw new PhalApi_Exception_BadRequest(T("divice not activated"), 202);
        }

        return $userInfo;
    }

}
