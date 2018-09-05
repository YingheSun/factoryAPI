<?php

/**
 * 用户注册接口服务类
 *
 * @author: YHS 20160603
 * @author: YHS 20160620 重构
 * @author: YHS 20160722 重构
 */
class Api_ESUserCard extends PhalApi_Api {

    public function getRules() {
        return array(
            //用户登录
            'UserCard' => array(
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识'),
                'gpsx' => array(
                    'name' => 'gpsx',
                    'type' => 'string',
                    'max' => 50,
                    'desc' => '定位x，没值默认传0'),
                'gpsy' => array(
                    'name' => 'gpsy',
                    'type' => 'string',
                    'max' => 50,
                    'desc' => '定位y,没值默认传0'),
            ),
        );
    }

    /**
     * 打卡功能(使用,1.0,OK)
     * 20160619
     * @desc code:108 打卡码与系统绑定不相符  进入出去都算打卡，系统自定计算每天的打卡最早最晚时间
     * @return string userid 用户id
     * @return string cardshop 对应商店
     * @return string gpsx 定位
     * @return string gpsy 定位
     * @return string state 打卡处理状态
     * @return string time 打卡时间
     */
    public function UserCard() {
        $Domain_UserCard = new Domain_ESUserCard();
        return $Domain_UserCard->cardin($this);
    }

}
