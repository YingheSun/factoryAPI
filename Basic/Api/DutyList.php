<?php

class Api_DutyList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getDutyList' => array(
                'id' => array(
                    'name' => 'postId',
                    'type' => 'string',
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
                    'desc' => 'token'),
            )
        );
    }

    /**
     * 责任列表
     * @desc 接口用于查看岗位的责任列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getDutyList() {
        $getList = new Domain_DutyInfo();
        return $getList->get_duty_list($this);
    }

}
