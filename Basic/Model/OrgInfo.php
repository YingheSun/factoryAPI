<?php

class Model_OrgInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'basic_organize';
    }

    public function setOrgInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "organize_name" => $data->name,
                            "organize_info" => $detail
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
