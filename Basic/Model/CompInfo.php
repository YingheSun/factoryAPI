<?php

class Model_CompInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'basic_company';
    }

    public function setCompInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "company_name" => $data->name,
                            "company_level" => $data->level,
                            "company_info" => $detail
                                )
        );
    }

    public function getInfoById($id) {
        return $this->getORM()->where("id", $id)->fetchrow();
    }

    public function getCompLists($page = 0) {
//        return $this->getORM()->fetchAll()->limit($page * 30, 30);
        return $this->getORM()->fetchAll();
    }

    public function updateState($data) {
        return $this->getORM()->where("id", $data->param1)->update(array('states' => $data->state));
    }

}
