<?php

class Api_StoreList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getStoreList' => array(
                'compid' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'desc' => '企业id'),
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
     * 仓库列表
     * @desc 接口用于获取仓库列表
     * @return array ret为200=>列表
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getStoreList() {
        $makeStore = new Domain_Store();
        return $makeStore->getStoreList($this);
    }

}
