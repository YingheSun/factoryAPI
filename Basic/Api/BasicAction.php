<?php

class Api_BasicAction extends PhalApi_Api {

    public function getRules() {
        return array(
            'setActionInfo' => array(
                'name' => array(
                    'name' => 'actionName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '作业名称'),
                'type' => array(
                    'name' => 'actionType',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '作业类型'),
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
            'getActionInfo' => array(
                'id' => array(
                    'name' => 'actionId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '作业id'),
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
     * 设置作业信息
     * @desc 通过该接口可以设置作业信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setActionInfo() {
        $setAction = new Domain_ActionInfo();
        return $setAction->set_Action_Action($this);
    }

    /**
     * 查看作业信息
     * @desc 通过该接口可以设查看作业信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getActionInfo() {
        $setAction = new Domain_ActionInfo();
        return $setAction->get_Action_Action($this);
    }

}
