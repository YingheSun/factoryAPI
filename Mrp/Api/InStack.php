<?php

/**
 * 入库栈列表
 *
 */
class Api_InStack extends PhalApi_Api {

    public function getRules() {
        return array(
            'getStack' => array(
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识')
            ),
            'updateStack' => array(
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识'),
                'id' => array(
                    'name' => 'id',
                    'type' => 'string',
                    'require' => true,
                    'desc' => 'id'),
                'num' => array(
                    'name' => 'num',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '数量'),
            ),
        );
    }

    /**
     * 获取入库栈列表
     * @desc 获取入库栈列表
     * @return string 扫描列表
     */
    public function getStack() {
        $Domain_StockIn = new Domain_StockInStack();
        return $Domain_StockIn->getRetList($this->uuid);
    }

    /**
     * 更新入库栈
     * @desc 更新入库栈
     * @return string 更新的入库栈
     * 
     */
    public function updateStack() {
        $Domain_StockIn = new Domain_StockInStack();
        return $Domain_StockIn->updateCount($this);
    }

}
