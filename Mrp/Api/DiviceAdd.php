<?php

class Api_DiviceAdd extends PhalApi_Api {

    public function getRules() {
        return array(
            //用户登录
            'scanAddDivice' => array(
                'userId' => array(
                    'name' => 'userId',
                    'type' => 'string',
                    'min' => 1,
                    'require' => true,
                    'desc' => '用户Id'),
                'compId' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'min' => 1,
                    'require' => true,
                    'desc' => '企业Id'),
                'postId' => array(
                    'name' => 'postId',
                    'type' => 'string',
                    'min' => 1,
                    'require' => true,
                    'desc' => '岗位Id'),
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识'),
            ),
        );
    }

    /**
     * 用户设备注册绑定
     */
    public function scanAddDivice() {
        $Domain_UserReg = new Domain_DiviceRegist();
        return $Domain_UserReg->diviceReg($this);
    }

}
