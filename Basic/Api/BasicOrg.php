<?php

class Api_BasicOrg extends PhalApi_Api {

    public function getRules() {
        return array(
            'setOrgInfo' => array(
                'name' => array(
                    'name' => 'orgName',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '组织名称'),
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
            'getOrgInfo' => array(
                'id' => array(
                    'name' => 'orgId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '组织id'),
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
     * 设置组织信息
     * @desc 通过该接口可以设置组织的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setOrgInfo() {
        $setOrg = new Domain_OrgInfo();
        return $setOrg->set_Org_Action($this);
    }
    
    /**
     * 获取组织信息
     * @desc 通过该接口可以获取组织的基本信息
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getOrgInfo() {
        $setOrg = new Domain_OrgInfo();
        return $setOrg->get_Org_info_Action($this);
    }

}
