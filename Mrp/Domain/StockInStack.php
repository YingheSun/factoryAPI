<?php

class Domain_StockInStack {

    public function getStackList($data) {
        $userInfo = $this->UUIDCheck($data->uuid);
        $ret = $this->listCheck($data->uuid, $data->barcode);
        if (!$ret) {
            $goodInfo = $this->getGoodsInfo($userInfo['compid'], $data->barcode);
            $this->addToStack($data->uuid, $data->barcode, $goodInfo['name'], "1", $goodInfo['cost'], "StockIn", $userInfo['compid'], $data->storeid, $goodInfo['cost'], "0");
        } else {
            $this->updateToStackPlusStep($data->uuid, $data->barcode);
        }
        return $this->getRetList($data->uuid);
    }

    public function getRetList($uuid) {
        $retList = new Model_ScanStack();
        return $retList->getStackByTimeDESC($uuid);
    }

    public function updateCount($data) {
        //ensure id<->uuid relation
        $idInfo = new Model_ScanStack();
        $info = $idInfo->idExistCheck($data->id, $data->uuid);
        if ($info) {
            if ($data->num == 0) {
                $updateInfo = new Model_ScanStack();
                $updateInfo->delAccount($data->id);
            } else {
                $updateInfo = new Model_ScanStack();
                $updateInfo->updateAccountNumber($data->id, $data->num);
            }
        }
        return $this->getRetList($data->uuid);
    }

    public function addToStack($uuid, $barcode, $name, $number, $account, $scantype, $comp_id, $store_id, $cost, $price) {
        $addToStack = new Model_ScanStack();
        $addToStack->addToStack($uuid, $barcode, $name, $number, $account, $scantype, $comp_id, $store_id, $cost, $price);
    }

    public function updateToStackPlusStep($uuid, $barcode) {
        $scanPlusStep = new Model_ScanStack();
        $scanPlusStep->scanStackPlusStep($uuid, $barcode);
    }

    public function getGoodsInfo($compId, $barcode) {
        $retArr = array(
            "barcode" => $barcode,
            "name" => '新商品',
            "price" => "0",
            "cost" => "0",
            "limit" => "0",
        );
        $getGoodInfo = new Model_Goods();
        $retGoodInfo = $getGoodInfo->getGoods($compId, $barcode);
        if (!$retGoodInfo) {
            $Model_Barcode = new Model_Barcode();
            $retBasicInfo = $Model_Barcode->getBarcode($barcode);
            if ($retBasicInfo) {
                $retArr['name'] = $retBasicInfo['item_name'];
            }
        } else if ($retGoodInfo) {
            $retArr['name'] = $retGoodInfo['name'];
            $retArr['price'] = $retGoodInfo['price'];
            $retArr['cost'] = $retGoodInfo['cost'];
            $retArr['limit'] = $retGoodInfo['limits'];
        }
        return $retArr;
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

    public function listCheck($uuid, $barcode) {
        $getInfo = new Model_ScanStack();
        return $getInfo->barcodeExistCheck($uuid, $barcode);
    }

}
