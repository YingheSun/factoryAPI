<?php

class Model_RelActionAuth extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'rel_action_authority';
    }

    public function setRelInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "basic_action_id" => $data->actionId,
                            "basic_authority_id" => $data->authId,
                            "relation_type" => $data->type,
                            "extra" => $detail
                                )
        );
    }

    public function checkExistState($data) {
        return $this->getORM()->where("basic_action_id", $data->actionId)->where("basic_authority_id", $data->authId)->fetchrow();
    }

    public function getRel($actionId) {
        return $this->getORM()->where("basic_action_id", $actionId)->fetchAll();
    }

    public function getAuthList($actionId) {
        return $this->getORM()->select('basic_action.action_name, basic_action.action_type, basic_authority.authority_type , basic_authority.authority_name , basic_authority.state AS auth_state ,basic_action_id , basic_authority_id , relation_type , rel_state AS rel_state')->where("basic_action_id", $actionId)->fetchAll();
    }

    public function getAuthIds($actionId) {
        return $this->getORM()->select('basic_authority_id')->where("basic_action_id", $actionId)->fetchAll();
    }

    public function checkRelState($data) {
        return $this->getORM()->where("basic_action_id", $data->param1)->where("basic_authority_id", $data->param2)->fetchrow();
    }

    public function updateRelState($data) {
        return $this->getORM()->where("basic_action_id", $data->param1)->where("basic_authority_id", $data->param2)->update(array("rel_state" => $data->state));
    }

}
