<?php

/**
 * 用户注册接口文件
 *
 * @author: YHS 20160603
 * @author: YHS 20160619 重构
 * @author: YHS 20160720 重构
 * @author: YHS 20170112 重构
 */
class Domain_ESUserLogin {

    public function quickLogin($data) {
        return $this->UUIDCheck($data->uuid);
//        return array('登录成功');
    }

    public function UUIDCheck($uuid) {
        $Model_User = new Model_ESUserLogin();
        $userInfo = $Model_User->getUserbyUUID($uuid);
        if (!$userInfo) {
            throw new PhalApi_Exception_BadRequest(T("login failed"), 201);
        }
        if ($userInfo['state'] == 'new_user') {
            $Model_User = new Model_ESUserLogin();
            $Model_User->activateUser($uuid);
        }
        if ($userInfo['state'] != 'activate' && $userInfo['state'] != 'new_user') {
            throw new PhalApi_Exception_BadRequest(T("divice not activated"), 202);
        }
        DI()->logger->info('用户快捷登录:', $uuid);
        
        return $userInfo;
    }

}
