<?php

class Api_Store extends PhalApi_Api {

    public function getRules() {
        return array(
            'makeStore' => array(
                'storeName' => array(
                    'name' => 'storeName',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '仓库名称'),
                'compid' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '企业id'),
                'storeType' => array(
                    'name' => 'storeType',
                    'type' => 'enum',
                    'range' => array('store', 'sales_end'),
                    'require' => true,
                    'desc' => '仓库类型'),
                'storeAddress' => array(
                    'name' => 'storeAddress',
                    'type' => 'string',
                    'desc' => '仓库地址'),
                'checkCode' => array(
                    'name' => 'checkCode',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '用户id'),
                'token' => array(
                    'name' => 'token',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => 'token'),
            ),
            'StoreState' => array(
                'storeid' => array(
                    'name' => 'storeid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '仓库id'),
                'state' => array(
                    'name' => 'state',
                    'type' => 'enum',
                    'range' => array('activate', 'not_activated'),
                    'require' => true,
                    'desc' => '状态'),
                'checkCode' => array(
                    'name' => 'checkCode',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '用户id'),
                'token' => array(
                    'name' => 'token',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => 'token'),
                )
        );
    }

    /**
     * 创建仓库
     * @desc 接口用于创建仓库
     * @return array ret为200=>创建成功
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function makeStore() {
        $makeStore = new Domain_Store();
        return $makeStore->addStore($this);
    }

    /**
     * 仓库状态
     * @desc 接口用于仓库状态管理
     * @return array ret为200=>创建成功
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function StoreState() {
        $makeStore = new Domain_Store();
        return $makeStore->storeState($this);
    }
}
