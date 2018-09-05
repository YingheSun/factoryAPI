<?php

class Model_RelGroupPost extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'rel_group_posts';
    }

    public function setRelInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "group_id" => $data->groupId,
                            "posts_id" => $data->postId,
                            "relation_type" => $data->type,
                            "extra" => $detail
                                )
        );
    }

    public function checkExistState($data) {
        return $this->getORM()->where("group_id", $data->groupId)->where("posts_id", $data->postId)->fetchrow();
    }

    public function getRel($groupId) {
        return $this->getORM()->where("group_id", $groupId)->fetchAll();
    }

    public function getGroupId($postId) {
        return $this->getORM()->select('group_id')->where("posts_id", $postId)->fetchRow();
    }

    public function checkRelState($data) {
        return $this->getORM()->where("group_id", $data->param1)->where("posts_id", $data->param2)->fetchrow();
    }

    public function updateRelState($data) {
        return $this->getORM()->where("group_id", $data->param1)->where("posts_id", $data->param2)->update(array("state" => $data->state));
    }

}
