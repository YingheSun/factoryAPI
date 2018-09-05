<?php

class Model_ESUserCard extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'mrp_user_card';
    }

    /**
     * 用户添加打卡信息
     * @param type $data
     * @return type
     */
    public function addCardIn($userid, $compid, $gpsx, $gpsy) {
        return $this->getORM()
                        ->insert(array(
                            "userid" => $userid,
                            "compid" => $compid,
                            "time" => time(),
                            "gpsx" => $gpsx,
                            "gpsy" => $gpsy,
                            "state" => "updated"
                                )
        );
    }
    
    public function newestCard($userId) {
        return $this->getORM()->where("userid", $userId)->fetchRow();
    }

}
