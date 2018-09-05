<?php

/**
 * 入库栈接口服务类
 *
 * @author: YHS 20160603
 * @author: YHS 20160620 重构
 * @author: YHS 20160722 重构
 */
class Api_StockInStack extends PhalApi_Api {

    public function getRules() {
        return array(
            'AddToStack' => array(
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识'),
                'barcode' => array(
                    'name' => 'barcode',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '条码号'),
                'storeid' => array(
                    'name' => 'storeId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '库房id'),
            ),
        );
    }

    /**
     * 入库栈存储
     * @desc 获得扫描反回列表
     * @return string 扫描列表
     */
    public function AddToStack() {
        $Domain_StockIn = new Domain_StockInStack();
        return $Domain_StockIn->getStackList($this);
    }

}
