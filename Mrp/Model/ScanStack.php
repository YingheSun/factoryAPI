<?php

/**
 * 查看条码接口文件
 *
 * @author: YHS 20160603
 * @author: YHS 20160619 重构
 * @author: YHS 20160720 重构
 * @author: YHS 20170112 重构
 */
class Model_ScanStack extends PhalApi_Model_NotORM {

    protected function getTableName() {
        return 'mrp_scan_stack';
    }

    public function addToStack($uuid, $barcode, $name, $number, $account, $scantype, $comp_id, $store_id, $cost, $price) {
        return $this->getORM()
                        ->insert(array(
                            "uuid" => $uuid,
                            "barcode" => $barcode,
                            "name" => $name,
                            "number" => $number,
                            "account" => $account,
                            "scantype" => $scantype,
                            "time" => time(),
                            "comp_id" => $comp_id,
                            "store_id" => $store_id,
                            "cost" => $cost,
                            "price" => $price
                                )
        );
    }

    public function scanStackPlusStep($uuid, $barcode) {
        return $this->getORM()->where("uuid", $uuid)->where("barcode", $barcode)->update(array("number" => new NotORM_Literal("number + 1"), "account" => new NotORM_Literal("number * cost")));
    }

    public function idExistCheck($id, $uuid) {
        return $this->getORM()->where("uuid", $uuid)->where("id", $id)->fetchRow();
    }

    public function updateAccountNumber($id, $number) {
        return $this->getORM()->where("id", $id)->update(array("number" => $number, "account" => new NotORM_Literal("number * cost")));
    }

    public function delAccount($id) {
        return $this->getORM()->where("id", $id)->delete();
    }

    public function stackExistCheck($uuid) {
        return $this->getORM()->where("uuid", $uuid)->fetchRow();
    }

    public function barcodeExistCheck($uuid, $barcode) {
        return $this->getORM()->where("uuid", $uuid)->where("barcode", $barcode)->fetchRow();
    }

    public function getStackByTimeDESC($uuid) {
        return $this->getORM()->where("uuid", $uuid)->order('time DESC')->fetchAll();
    }

    public function clearStack($uuid) {
        $this->getORM()->where("uuid", $uuid)->delete();
    }

}
