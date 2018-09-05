<?php

class Model_PassCode extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'sys_admin';
    }

    public function Admin_Add($data) {
        return $this->getORM()
                        ->insert(array(
                            "admin_name" => $data->name,
                            "admin_passcode" => $data->password,
                            "compid" => $data->compid,
                            "reg_time" => time()
                                )
        );
    }

    public function getPassCode($admin_name) {
        return $this->getORM()->where("admin_name", $admin_name)->fetchrow();
    }

}
