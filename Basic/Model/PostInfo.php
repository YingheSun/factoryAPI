<?php

class Model_PostInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'basic_posts';
    }

    public function setPostInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "post_name" => $data->name,
                            "post_info" => $detail
                                )
        );
    }

    public function getInfoById($id) {
        return $this->getORM()->where("id", $id)->fetchrow();
    }

    public function updateState($data) {
        return $this->getORM()->where("id", $data->param1)->update(array('state' => $data->state));
    }

}
