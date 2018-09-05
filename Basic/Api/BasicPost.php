<?php

class Api_BasicPost extends PhalApi_Api {

    public function getRules() {
        return array(
            'setPostInfo' => array(
                'name' => array(
                    'name' => 'postName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '岗位名称'),
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
            ),
            'getPostInfo' => array(
                'id' => array(
                    'name' => 'postId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '岗位id'),
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
     * 设置岗位信息
     * @desc 通过该接口可以设置岗位的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setPostInfo() {
        $setPost = new Domain_PostInfo();
        return $setPost->set_Post_Action($this);
    }

    /**
     * 获取岗位信息
     * @desc 通过该接口可以获取岗位的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getPostInfo() {
        $setPost = new Domain_PostInfo();
        return $setPost->get_Post_Action($this);
    }

}
