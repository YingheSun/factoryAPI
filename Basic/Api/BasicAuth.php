<?php

class Api_BasicAuth extends PhalApi_Api {

    public function getRules() {
        return array(
            'setAuthInfo' => array(
                'name' => array(
                    'name' => 'authorityName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '权限名称'),
                'type' => array(
                    'name' => 'authorityType',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '权限类型'),
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
                'details' => array(
                    'name' => 'details',
                    'type' => 'array',
                    'format' => 'json',
                    'require' => true,
                    'desc' => '扩展属性,[扩展属性|多维数组]'),
            )
        );
    }

    /**
     * 设置权限信息
     * @desc 通过该接口可以设置权限信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setAuthInfo() {
        $setAuthAct = new Domain_AuthInfo();
        return $setAuthAct->set_Auth_Action($this);
    }

}
