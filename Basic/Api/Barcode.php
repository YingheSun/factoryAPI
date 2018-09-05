<?php

/**
 * 查看条码接口服务类
 *
 * @author: YHS 20160603
 * @author: YHS 20160620 重构
 * @author: YHS 20160722 重构
 */
class Api_Barcode extends PhalApi_Api {

    public function getRules() {
        return array(
            'getBarcode' => array(
                'barcode' => array(
                    'name' => 'barcode',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '条码号'),
            ),
            'addBarcode' => array(
                'item_no' => array(
                    'name' => 'item_no',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '条码号'),
                'item_name' => array(
                    'name' => 'item_name',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '名称'),
                'pym' => array(
                    'name' => 'pym',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '系列'),
                'item_size' => array(
                    'name' => 'item_size',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '大小,容量'),
                'unit_no' => array(
                    'name' => 'unit_no',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '计量单位'),
                'product_area' => array(
                    'name' => 'product_area',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '产地'),
            ),
        );
    }

    /**
     * 查看条码
     * @desc 查看条码信息
     * @return string 条码信息
     */
    public function getBarcode() {
        $Domain_Barcode = new Domain_Barcode();
        //获得用户是否可以登录，以及登录级别
        return $Domain_Barcode->getBarcode($this);
    }
    
    /**
     * 查看条码
     * @desc 查看条码信息
     * @return string 条码信息
     */
    public function addBarcode() {
        $Domain_Barcode = new Domain_Barcode();
        //获得用户是否可以登录，以及登录级别
        return $Domain_Barcode->addBarcode($this);
    }

}
