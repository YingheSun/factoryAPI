<?php

class Api_RelCompOrg extends PhalApi_Api {

    public function getRules() {
        return array(
            'setCompRel' => array(
                'compId' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '公司名称'),
                'orgId' => array(
                    'name' => 'orgId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '组织名称'),
                'type' => array(
                    'name' => 'relType',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '关系类型'),
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
            )
        );
    }

    /**
     * 设置公司,组织关系
     * @desc 通过该接口可以设置公司,组织关系(不强制使用树形结构关系,激活状态为树形结构,否则无法拓普全部关系)
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setCompRel() {
        $setRel = new Domain_RelCompOrg();
        return $setRel->set_Rel_Action($this);
    }

}
