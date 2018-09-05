<?php

class Api_UserList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getUserList' => array(
                'postid' => array(
                    'name' => 'postId',
                    'type' => 'string',
                    'desc' => '岗位id'),
                'compid' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '企业id'),
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
     * 用户列表
     * @desc 接口用于查看用户列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getUserList() {
        $getList = new Domain_UserInfo();
        return $getList->get_User_List($this);
    }

}
