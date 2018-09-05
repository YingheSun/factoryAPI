<?php

class Api_BasicUser extends PhalApi_Api {

    public function getRules() {
        return array(
            'setUserInfo' => array(
                'name' => array(
                    'name' => 'userName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '用户名称'),
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
     * 设置用户信息
     * @desc 通过该接口可以设置用户的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setUserInfo() {
        $setPost = new Domain_UserInfo();
        return $setPost->set_User_Action($this);
    }

}
