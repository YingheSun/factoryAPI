<?php

class Api_FreightSpace extends PhalApi_Api {

    public function getRules() {
        return array(
            'addFreightSpace' => array(
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
                'name' => array(
                    'name' => 'namePrefix',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '仓位名称前缀'),
                'type' => array(
                    'name' => 'type',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '仓位类型'),
                'number' => array(
                    'name' => 'createfsAccount',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '创建仓位数量'),
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
            'FreightSpaceState' => array(
                'compId' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '公司id'),
                'fsId' => array(
                    'name' => 'fsId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '仓位id'),
                'state' => array(
                    'name' => 'state',
                    'type' => 'enum',
                    'range' => array('activate', 'not_activated'),
                    'require' => true,
                    'desc' => '要修改的状态的类型'),
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
                    'desc' => 'token')
            )
        );
    }

    /**
     * 添加仓位
     * @desc 接口用于添加仓位
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function addFreightSpace() {
        $addFreightSpace = new Domain_FreightSpace();
        return $addFreightSpace->add_Space($this);
    }

    /**
     * 仓位状态(wait)
     * @desc 接口用于仓位状态管理
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function FreightSpaceState() {
        $FreightSpaceState = new Domain_FreightSpace();
        return $FreightSpaceState->makeSpaceState($this);
    }

}
