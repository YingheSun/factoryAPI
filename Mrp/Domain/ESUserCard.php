<?php

/**
 * 用户注册接口文件
 *
 * @author: YHS 20160603
 * @author: YHS 20160619 重构
 * @author: YHS 20160720 重构
 * @author: YHS 20170112 重构
 */
class Domain_ESUserCard {

    public function cardin($data) {
        $info = $this->cardInCheck($data->uuid);
        $this->card_in_action($info, $data);
        return array("打卡成功");
//        return $info;
    }

    public function cardInCheck($uuid) {
        $UserInfo = new Domain_ESUserLogin();
        $userInfo = $UserInfo->UUIDCheck($uuid);
        $Model_checkCard = new Model_ESUserCard();
        $cardInfo = $Model_checkCard->newestCard($userInfo['user_id']);
        if (!$cardInfo) {
            return $userInfo;
        } else if ((time() - $cardInfo['time']) < 1000) {
            throw new PhalApi_Exception_BadRequest(T("already carded"), 203);
        } else {
            return $userInfo;
        }
    }

    public function card_in_action($info, $data) {
        $Model_AddCard = new Model_ESUserCard();
        DI()->logger->info("用户打卡" . $info['user_id']);
        $Model_AddCard->addCardIn($info['user_id'], $info['compid'], $data->gpsx, $data->gpsy);
    }

}
