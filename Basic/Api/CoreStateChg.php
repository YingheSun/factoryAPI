<?php

class Api_CoreStateChg extends PhalApi_Api {

    public function getRules() {
        return array(
            'setState' => array(
                'type' => array(
                    'name' => 'execType',
                    'type' => 'enum',
                    'range' => array('all', 'comp', 'org', 'rel_org', 'group', 'rel_group', 'post', 'rel_post', 'duty', 'rel_duty', 'user', 'rel_user', 'action', 'rel_action', 'auth', 'rel_auth'),
                    'require' => true,
                    'desc' => '要修改的状态的类型'),
                'state' => array(
                    'name' => 'state',
                    'type' => 'enum',
                    'range' => array('activate', 'not_activated'),
                    'require' => true,
                    'desc' => '要修改的状态的类型'),
                'param1' => array(
                    'name' => 'param1',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '参数1'),
                'param2' => array(
                    'name' => 'param2',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'desc' => '参数2'),
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
     * 设置状态变化
     * @desc 通过该接口可以设置各个组织,关系状态的变化
     * @return array ret为200=>处理成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setState() {
        $setRel = new Domain_CoreCSCheck();
        return $setRel->check_Type_Action($this);
    }

}
