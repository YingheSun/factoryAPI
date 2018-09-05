<?php

class Api_GetGroupPosts extends PhalApi_Api {

    public function getRules() {
        return array(
            'getPosts' => array(
                'groupId' => array(
                    'name' => 'groupId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '班组名称'),
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
     * 获取岗位拓扑列表
     * @desc 通过该接口获取岗位拓扑列表
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getPosts() {
        $getTree = new Domain_GetGroupPosts();
        return $getTree->get_Tree_Action($this);
    }

}
