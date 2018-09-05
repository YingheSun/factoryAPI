<?php

class Api_BasicGroup extends PhalApi_Api {

    public function getRules() {
        return array(
            'setGroupInfo' => array(
                'name' => array(
                    'name' => 'groupName',
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
                'details' => array(
                    'name' => 'details',
                    'type' => 'array',
                    'format' => 'json',
                    'require' => true,
                    'desc' => '扩展属性,[扩展属性|多维数组]'),
            ),
            'getGroupInfo' => array(
                'id' => array(
                    'name' => 'groupId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '班组id'),
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
     * 设置班组信息
     * @desc 通过该接口可以设置班组的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setGroupInfo() {
        $setGroup = new Domain_GroupInfo();
        return $setGroup->set_Group_Action($this);
    }
    
    /**
     * 获取班组信息
     * @desc 通过该接口可以获取班组的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getGroupInfo() {
        $setGroup = new Domain_GroupInfo();
        return $setGroup->get_Group_info_Action($this);
    }

}
