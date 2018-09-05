<?php

class Model_RelOrgGroup extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'rel_org_group';
    }

    public function setRelInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "basic_group_id" => $data->groupId,
                            "basic_organize_id" => $data->orgId,
                            "relation_type" => $data->type,
                            "extra" => $detail
                                )
        );
    }

    public function checkExistState($data) {
        return $this->getORM()->where("basic_group_id", $data->groupId)->where("basic_organize_id", $data->orgId)->fetchrow();
    }

    public function getGroupList($orgId) {
        return $this->getORM()->select('basic_group.group_name , basic_organize.organize_name , basic_group.state AS group_state ,basic_group_id , basic_organize_id , relation_type , rel_state AS rel_state')->where("basic_organize_id", $orgId)->fetchAll();
    }

    public function getRel($orgId) {
        return $this->getORM()->where("basic_organize_id", $orgId)->fetchAll();
    }

    public function getOrgId($groupId) {
        return $this->getORM()->select('basic_organize_id')->where("basic_group_id", $groupId)->fetchRow();
    }

    public function checkRelState($data) {
        return $this->getORM()->where("basic_group_id", $data->param2)->where("basic_organize_id", $data->param1)->fetchrow();
    }

    public function updateRelState($data) {
        return $this->getORM()->where("basic_group_id", $data->param2)->where("basic_organize_id", $data->param1)->update(array("rel_state" => $data->state));
    }

}
