<?php

class Api_AdminLogin extends PhalApi_Api {

    public function getRules() {
        return array(
            'loginWithToken' => array(
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
            )
        );
    }

    /**
     * 登录
     * @desc 通过该接口可以进行登录获取token,并将token保存起来,用于以后使用
     * @return array ret为200=>返回token(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function loginWithToken() {
        $getLogin = new Domain_LoginAction();
        return $getLogin->login_Action($this);
    }

}
