<?php

/**
 * 用户注册接口服务类
 *
 * @author: YHS 20160603
 * @author: YHS 20160620 重构
 * @author: YHS 20160722 重构
 */
class Api_ESLogin extends PhalApi_Api {

    public function getRules() {
        return array(
            //用户快捷登录
            'ESQuickLogin' => array(
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识'),
            ),
        );
    }

    /**
     * 用户快捷登录(使用中,1.3,OK)
     * 20160720 1.0
     * 20160825 1.1
     * @desc 获得用户是否可以登录，以及登录级别 code: 201:登录失败
     * @return string 登录成功
     */
    public function ESQuickLogin() {
        $Domain_User = new Domain_ESUserLogin();
        //获得用户是否可以登录，以及登录级别
        return $Domain_User->quickLogin($this);
    }

}
