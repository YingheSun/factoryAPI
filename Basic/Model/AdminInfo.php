<?php

class Model_AdminInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'sys_admin';
    }

    public function getAdminInfo($admin_id) {
        return $this->getORM()->where("id", $admin_id)->fetchrow();
    }

    public function getAdminInfos($page = 0) {
//        return $this->getORM()->fetchAll()->limit($page * 30, 30);
        return $this->getORM()->fetchAll();
    }

    public function chgState($id, $state) {
        return $this->getORM()->where("id", $id)->update(array('state' => $state));
    }

    public function chgPassCode($id, $passCode) {
        return $this->getORM()->where("id", $id)->update(array('admin_passcode' => $passCode));
    }

}
