<?php

class Model_RelUserPost extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'rel_user_post';
    }

    public function setRelInfo($data) {
        return $this->getORM()
                        ->insert(array(
                            "post_id" => $data->postId,
                            "user_id" => $data->userId,
                                )
        );
    }

    public function checkExistState($data) {
        return $this->getORM()->where("post_id", $data->postId)->where("user_id", $data->userId)->fetchrow();
    }

    public function checkRelState($data) {
        return $this->getORM()->where("user_id", $data->param2)->where("post_id", $data->param1)->fetchrow();
    }

    public function getRelState($postid, $userid) {
        return $this->getORM()->where("user_id", $userid)->where("post_id", $postid)->fetchrow();
    }

    public function updateRelState($data) {
        return $this->getORM()->where("user_id", $data->param2)->where("post_id", $data->param1)->update(array("state" => $data->state));
    }

}
