<?php

class Api_AdminManage extends PhalApi_Api {

    public function getRules() {
        return array(
            'adminSataChg' => array(
                'id' => array(
                    'name' => 'id',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '管理圆id'),
                'state' => array(
                    'name' => 'state',
                    'type' => 'enum',
                    'range' => array('activate', 'not_activated'),
                    'require' => true,
                    'desc' => '状态[activate|not activated(默认)]'),
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
     * 管理员状态管理
     * @desc 通过该接口可以进行管理员状态的管理
     * @return array ret为200=>返回state(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function adminSataChg() {
        $chgAdmin = new Domain_AdminStatChg();
        return $chgAdmin->AdminStatChg($this);
    }

}
