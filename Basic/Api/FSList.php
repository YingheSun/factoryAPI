<?php

class Api_FSList extends PhalApi_Api {

    public function getRules() {
        return array(
            'FreightSpaceList' => array(
                'compId' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '公司id'),
                'storeId' => array(
                    'name' => 'storeId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '仓库id'),
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
     * 仓位列表
     * @desc 接口用于仓位列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function FreightSpaceList() {
        $FreightSpaceList = new Domain_FreightSpace();
        return $FreightSpaceList->getList($this);
    }

}
