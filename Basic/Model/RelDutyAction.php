<?php

class Model_RelDutyAction extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'rel_duty_action';
    }

    public function setRelInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "basic_action_id" => $data->actionId,
                            "basic_duty_id" => $data->dutyId,
                            "relation_type" => $data->type,
                            "extra" => $detail
                                )
        );
    }

    public function checkExistState($data) {
        return $this->getORM()->where("basic_action_id", $data->actionId)->where("basic_duty_id", $data->dutyId)->fetchrow();
    }

    public function getRel($dutyId) {
        return $this->getORM()->where("basic_duty_id", $dutyId)->fetchAll();
    }

    public function getActionList($dutyId) {
        return $this->getORM()->select('basic_action.action_name, basic_action.action_type, basic_duty.duty_type , basic_duty.duty_name , basic_action.state AS action_state ,basic_action_id , basic_duty_id , relation_type , rel_state AS rel_state')->where("basic_duty_id", $dutyId)->fetchAll();
    }

    public function getActionIds($dutyId) {
        return $this->getORM()->select('basic_action_id,basic_duty_id')->where("basic_duty_id", $dutyId)->fetchAll();
    }

    public function checkRelState($data) {
        return $this->getORM()->where("basic_duty_id", $data->param1)->where("basic_action_id", $data->param2)->fetchrow();
    }

    public function updateRelState($data) {
        return $this->getORM()->where("basic_duty_id", $data->param1)->where("basic_action_id", $data->param2)->update(array("rel_state" => $data->state));
    }

}
