<?php

class Api_PwsChange extends PhalApi_Api {

    public function getRules() {
        return array(
            'changeWithToken' => array(
                'name' => array(
                    'name' => 'adminName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '管理员名称'),
                'password' => array(
                    'name' => 'passCode',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '管理员密码'),
                'newpassword' => array(
                    'name' => 'newPassCode',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '管理员新密码'),
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
     * 修改密码
     * @desc 通过该接口可以修改密码
     * @return array ret为200=>返回token(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function changeWithToken() {
        $passCode = new Domain_AdminStatChg();
        return $passCode->AdminPassCodeChg($this);
    }

}
