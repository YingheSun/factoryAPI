<?php

class Model_ActionInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'basic_action';
    }

    public function setActionInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "action_name" => $data->name,
                            "action_type" => $data->type,
                            "action_detail" => $detail
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
