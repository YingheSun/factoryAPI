<?php

class Model_RelCompOrg extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'rel_comp_organize';
    }

    public function setRelInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "basic_company_id" => $data->compId,
                            "basic_organize_id" => $data->orgId,
                            "relation_type" => $data->type,
                            "extra" => $detail
                                )
        );
    }

    public function checkExistState($data) {
        return $this->getORM()->where("basic_company_id", $data->compId)->where("basic_organize_id", $data->orgId)->fetchrow();
    }

    public function getOrgList() {
        return $this->getORM()->select('basic_company.company_name ,basic_company.states AS comp_state , basic_organize.organize_name ,basic_organize.state AS org_state, basic_company_id , basic_organize_id , relation_type , rel_state AS rel_state')->fetchAll();
    }

    public function getOrgListWithCompId($compId) {
        return $this->getORM()->select('basic_company.company_name ,basic_company.states AS comp_state, basic_organize.organize_name ,basic_organize.state AS org_state, basic_company_id , basic_organize_id , relation_type, rel_state AS rel_state')->where("basic_company_id", $compId)->fetchAll();
    }

    public function getRel($compId) {
        return $this->getORM()->where("basic_company_id", $compId)->fetchAll();
    }

    public function getCompId($orgId) {
        return $this->getORM()->select('basic_company_id')->where("basic_organize_id", $orgId)->fetchRow();
    }

    public function checkRelState($data) {
        return $this->getORM()->where("basic_company_id", $data->param1)->where("basic_organize_id", $data->param2)->fetchrow();
    }

    public function updateRelState($data) {
        return $this->getORM()->where("basic_company_id", $data->param1)->where("basic_organize_id", $data->param2)->update(array("rel_state" => $data->state));
    }

}
