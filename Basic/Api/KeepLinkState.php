<?php

class Api_KeepLinkState extends PhalApi_Api {

    public function getRules() {
        return array(
            'checkWithToken' => array(
                'checkCode' => array(
                    'name' => 'checkCode',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '登录号id'),
                'token' => array(
                    'name' => 'token',
                    'type' => 'string',
                    'min' => 20,
                    'max' => 100,
                    'require' => true,
                    'desc' => 'token'),
            )
        );
    }

    /**
     * 检测登录状态
     * @desc 通过该接口可以进行登录获取token,并将token保存起来,用于以后使用
     * @return array ret为200=>返回状态:连接(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function checkWithToken() {
        $getLoginState= new Domain_CheckState();
        return $getLoginState->set_state_check($this);
    }

}
