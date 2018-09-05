<?php

class Api_AdminAdd extends PhalApi_Api {

    public function getRules() {
        return array(
            'addAdmin' => array(
                'name' => array(
                    'name' => 'adminName',
                    'type' => 'string',
                    'min' => 6,
                    'max' => 100,
                    'require' => true,
                    'desc' => '管理员名称'),
                'compid' => array(
                    'name' => 'compid',
                    'type' => 'string',
                    'min' => 6,
                    'max' => 100,
                    'require' => true,
                    'desc' => '管理员所属公司id'),
                'password' => array(
                    'name' => 'passCode',
                    'type' => 'string',
                    'min' => 6,
                    'max' => 100,
                    'require' => true,
                    'desc' => '管理员密码'),
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
     * 管理员注册
     * @desc 接口用于注册管理员
     * @return array ret为200=>创建成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function addAdmin() {
        $addAdmin = new Domain_AdminAdd();
        return $addAdmin->AdminAdd($this);
    }

}
