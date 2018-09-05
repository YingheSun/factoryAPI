<?php

class Api_AdminList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getAdminList' => array(
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
     * 管理员列表
     * @desc 接口用于查看管理员列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getAdminList() {
        $getAdmin = new Domain_AdminList();
        return $getAdmin->getAdmin($this);
    }

}
