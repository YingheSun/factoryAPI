<?php

class Api_ActionList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getActionList' => array(
                'id' => array(
                    'name' => 'dutyId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '职责id'),
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
     * 作业列表
     * @desc 接口用于查看职责的作业列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getActionList() {
        $getList = new Domain_ActionInfo();
        return $getList->get_action_list($this);
    }

}
