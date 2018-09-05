<?php

class Model_ESUserLogin extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'mrp_user_login';
    }

    /**
     * 添加用户设备
     */
    public function addDivice($data) {
        return $this->getORM()
                        ->insert(array(
                            "user_id" => $data->userId,
                            "post_id" => $data->postId,
                            "compid" => $data->compId,
                            "uuid" => $data->uuid,
                            "time" => time(),
                                )
        );
    }

    /**
     * 上传用户设备标识
     */
    public function activateUser($uuid) {
        return $this->getORM()->where("uuid", $uuid)->update(array("state" => 'activate'));
    }

    /**
     * 获取uuid的对应
     */
    public function getUserbyUUID($uuid) {
        return $this->getORM()->where("uuid", $uuid)->fetchRow();
    }

    /**
     * 获取用户对应
     */
    public function getInfobyuserId($userId) {
        return $this->getORM()->where("user_id", $userId)->fetchRow();
    }

}
