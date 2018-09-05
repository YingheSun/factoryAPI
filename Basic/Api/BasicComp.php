<?php

class Api_BasicComp extends PhalApi_Api {

    public function getRules() {
        return array(
            'setCompInfo' => array(
                'name' => array(
                    'name' => 'compName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '公司名称'),
                'level' => array(
                    'name' => 'level',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '公司级别'),
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
                    'desc' => '扩展属性,[扩展属性|多维数组]'),
            ),
            'getCompInfo' => array(
                'id' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
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
     * 设置公司信息
     * @desc 通过该接口可以设置公司的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setCompInfo() {
        $setComp = new Domain_CompInfo();
        return $setComp->set_Comp_Action($this);
    }

    /**
     * 查看公司信息
     * @desc 通过该接口可以设置公司的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getCompInfo() {
        $setComp = new Domain_CompInfo();
        return $setComp->get_Comp_Action($this);
    }

}
