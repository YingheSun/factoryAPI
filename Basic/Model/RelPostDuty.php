<?php

class Model_RelPostDuty extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'rel_post_duty';
    }

    public function setRelInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "basic_posts_id" => $data->postId,
                            "basic_duty_id" => $data->dutyId,
                            "relation_type" => $data->type,
                            "extra" => $detail
                                )
        );
    }

    public function checkExistState($data) {
        return $this->getORM()->where("basic_posts_id", $data->postId)->where("basic_duty_id", $data->dutyId)->fetchrow();
    }

    public function getRel($postId) {
        return $this->getORM()->where("basic_posts_id", $postId)->fetchAll();
    }

    public function getDutyList($postId) {
        return $this->getORM()->select('basic_posts.post_name, basic_duty.duty_type , basic_duty.duty_name , basic_duty.state AS duty_state ,basic_posts_id , basic_duty_id , relation_type , rel_state AS rel_state')->where("basic_posts_id", $postId)->fetchAll();
    }

    public function checkRelState($data) {
        return $this->getORM()->where("basic_duty_id", $data->param2)->where("basic_posts_id", $data->param1)->fetchrow();
    }

    public function updateRelState($data) {
        return $this->getORM()->where("basic_duty_id", $data->param2)->where("basic_posts_id", $data->param1)->update(array("rel_state" => $data->state));
    }

}
