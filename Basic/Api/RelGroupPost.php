<?php

class Api_RelGroupPost extends PhalApi_Api {

    public function getRules() {
        return array(
            'setGroupRel' => array(
                'groupId' => array(
                    'name' => 'groupId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '班组名称'),
                'postId' => array(
                    'name' => 'postId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '岗位名称'),
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
     * 设置班组,岗位关系
     * @desc 通过该接口可以设置班组,岗位关系(不强制使用树形结构关系,激活状态为树形结构,否则无法拓普全部关系)
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setGroupRel() {
        $setRel = new Domain_RelGroupPost();
        return $setRel->set_Rel_Action($this);
    }

}
