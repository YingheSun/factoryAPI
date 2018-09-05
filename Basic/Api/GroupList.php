<?php

class Api_GroupList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getGroupList' => array(
                'id' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'desc' => '公司id'),
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
     * 组织列表
     * @desc 接口用于查看组织列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getGroupList() {
        $getList = new Domain_GroupInfo();
        return $getList->get_Group_Action($this);
    }

}
