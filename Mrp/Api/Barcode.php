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
                'mode' => array(
                    'name' => 'mode',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '查看模式'),
                'barcode' => array(
                    'name' => 'barcode',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '条码号'),
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'min' => 1,
                    'require' => true,
                    'desc' => '设备id'),
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

}
