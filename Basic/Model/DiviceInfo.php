<?php

class Model_DiviceInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'mrp_user_login';
    }

    /**
     * 获取uuid的对应
     */
    public function getUserbyUUID($uuid) {
        return $this->getORM()->where("uuid", $uuid)->fetchRow();
    }

}
