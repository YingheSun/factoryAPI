<?php

/**
 * 入库栈转订单接口服务类
 *
 * @author: YHS 20160603
 * @author: YHS 20160620 重构
 * @author: YHS 20160722 重构
 */
class Api_StockOrder extends PhalApi_Api {

    public function getRules() {
        return array(
            'stackToOrder' => array(
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识')
            ),
        );
    }

    /**
     * 入库栈转订单
     * @desc 获得扫描反回列表
     * @return string 扫描列表
     */
    public function stackToOrder() {
        $Domain_StockInOrder = new Domain_StockInOrder();
        return $Domain_StockInOrder->makeOrder($this);
    }

}
