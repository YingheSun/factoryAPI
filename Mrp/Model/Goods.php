<?php

/**
 * 查看条码接口文件
 *
 * @author: YHS 20160603
 * @author: YHS 20160619 重构
 * @author: YHS 20160720 重构
 * @author: YHS 20170112 重构
 */
class Model_Goods extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'mrp_goods' . $id;
    }

    public function getGoods($compid , $barcode) {
        return $this->getORM($compid)->where("barcode", $barcode)->fetchRow();
    }

}
