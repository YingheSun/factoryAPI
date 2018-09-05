<?php

class Api_CompList extends PhalApi_Api {

    public function getRules() {
        return array(
            'getCompList' => array(
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
     * 公司列表
     * @desc 接口用于查看公司列表
     * @return array ret为200=>列表(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getCompList() {
        $getList = new Domain_CompInfo();
        return $getList->get_Comps_Action($this);
    }

}
