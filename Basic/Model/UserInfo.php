<?php

class Model_UserInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'core_user_info';
    }

    public function setUserInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "user_name" => $data->name,
                            "user_info" => $detail,
                                )
        );
    }

    public function updateState($data) {
        return $this->getORM()->where("id", $data->param1)->update(array('state' => $data->state));
    }

    public function getInfoById($id) {
        return $this->getORM()->where("id", $id)->fetchrow();
    }

    public function getInfoByname($name) {
        return $this->getORM()->where("user_name", $name)->fetchrow();
    }

    public function updateInfoById($id, $postid, $compid) {
        return $this->getORM()->where("id", $id)->update(array("basic_post_id" => $postid, "basic_comp_id" => $compid));
    }

    public function getcompUserList($compid) {
        return $this->getORM()->where("basic_comp_id", $compid)->fetchAll();
    }

    public function getpostUserList($postid) {
        return $this->getORM()->where("basic_post_id", $postid)->fetchAll();
    }

}
