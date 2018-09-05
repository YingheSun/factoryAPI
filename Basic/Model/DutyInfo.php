<?php

class Model_DutyInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'basic_duty';
    }

    public function setDutyInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "duty_name" => $data->name,
                            "duty_type" => $data->type,
                            "duty_detail" => $detail
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
