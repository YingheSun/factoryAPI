<?php

class Api_TreeCompOrg extends PhalApi_Api {

    public function getRules() {
        return array(
            'getTreeComp' => array(
                'compId' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '公司名称'),
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
     * 获取公司,组织,班组拓扑
     * @desc 通过该接口获取公司,组织,班组拓扑
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getTreeComp() {
        $getTree = new Domain_TreeCompOrg();
        return $getTree->get_Tree_Action($this);
    }

}
