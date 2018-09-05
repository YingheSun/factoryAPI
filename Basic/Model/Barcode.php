<?php

/**
 * 查看条码接口文件
 *
 * @author: YHS 20160603
 * @author: YHS 20160619 重构
 * @author: YHS 20160720 重构
 * @author: YHS 20170112 重构
 */
class Model_Barcode extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'mrp_barcodes';
    }

    /**
     * 用户添加打卡信息
     * @param type $data
     * @return type
     */
    public function addBarcode($data) {
        return $this->getORM()
                        ->insert(array(
                            "item_no" => $data->item_no,
                            "item_name" => $data->item_no,
                            "pym" => $data->item_no,
                            "item_size" => $data->item_no,
                            "unit_no" => $data->item_no,
                            "product_area" => $data->item_no
                                )
        );
    }

    public function getBarcode($barcode) {
        return $this->getORM()->where("item_no", $barcode)->fetchRow();
    }

}
