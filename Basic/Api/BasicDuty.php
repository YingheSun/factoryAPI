<?php

class Api_BasicDuty extends PhalApi_Api {

    public function getRules() {
        return array(
            'setDutyInfo' => array(
                'name' => array(
                    'name' => 'dutyName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '职责名称'),
                'type' => array(
                    'name' => 'dutyType',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '职责类型'),
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
            'getDutyInfo' => array(
                'id' => array(
                    'name' => 'dutyId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
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
     * 设置职责信息
     * @desc 通过该接口可以设置岗位职责的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setDutyInfo() {
        $setDuty = new Domain_DutyInfo();
        return $setDuty->set_Duty_Action($this);
    }

    /**
     * 获取职责信息
     * @desc 通过该接口可以获取职责的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getDutyInfo() {
        $setDuty = new Domain_DutyInfo();
        return $setDuty->get_Duty_Action($this);
    }

}
