<?php

class Model_AuthInfo extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'basic_authority';
    }

    public function setAuthInfo($data) {
        $detail = json_encode($data->details);
        return $this->getORM()
                        ->insert(array(
                            "authority_name" => $data->name,
                            "authority_type" => $data->type,
                            "authority_detail" => $detail
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
