<?php

class Model_PassLog extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'sys_login_log';
    }

    public function login_Log_Add($id, $token, $level) {
        return $this->getORM()
                        ->insert(array(
                            "admin_id" => $id,
                            "token" => $token,
                            "login_time" => time(),
                            "overdue_time" => time() + 3600,
                            "compid" => $level
                                )
        );
    }

    public function getTokenInfo($id, $token) {
        return $this->getORM()->select("id", "token", "compid")->where("admin_id", $id)->where("token", $token)->fetchAll();
    }

    public function getInfos($id, $token) {
        return $this->getORM()->where("id", $id)->where("token", $token)->fetchRow();
    }

    public function reset_overdue_time($id) {
        return $this->getORM()->where("id", $id)->update(array('overdue_time' => time() + 3600));
    }

}
