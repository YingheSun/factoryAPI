<?php

class Model_GroupInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'basic_group';
    }

    public function setGroupInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "group_name" => $data->name,
                            "group_info" => $detail
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
