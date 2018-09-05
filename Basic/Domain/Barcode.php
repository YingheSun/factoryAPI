<?php

/**
 * 查看条码接口文件
 *
 * @author: YHS 20160603
 * @author: YHS 20160619 重构
 * @author: YHS 20160720 重构
 * @author: YHS 20170112 重构
 */
class Domain_Barcode {

    public function getBarcode($data) {
        $Model_Barcode = new Model_Barcode();
        $retInfo = $Model_Barcode->getBarcode($data->barcode);
        if(!$retInfo){
            throw new PhalApi_Exception_BadRequest(T("Barcode don't Exists"), 204);
        }
    }
    
    public function addBarcode($data) {
        $Model_Barcode = new Model_Barcode();
        $retInfo = $Model_Barcode->getBarcode($data->barcode);
        if($retInfo){
            throw new PhalApi_Exception_BadRequest(T("Barcode already Exists"), 205);
        }
        $Barcode_Add = new Model_Barcode();
        $Barcode_Add->addBarcode($data);
        
    }

}
