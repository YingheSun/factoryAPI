<?php

class Api_AuthList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getAuthList' => array(
                'id' => array(
                    'name' => 'actionId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '作业id'),
                'checkCode' => array(
                    'name' => 'checkCode',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => 'checkCode'),
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
     * 权限列表
     * @desc 接口用于查看作业的权限列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getAuthList() {
        $getList = new Domain_AuthInfo();
        return $getList->get_Auth_List_Action($this);
    }

}
