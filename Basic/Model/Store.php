<?php

class Model_Store extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'mrp_store_info';
    }

    public function addStore($data) {
        return $this->getORM()
                        ->insert(array(
                            "store_name" => $data->storeName,
                            "basic_comp_id" => $data->compid,
                            "address" => $data->storeAddress,
                            "type" => $data->storeType,
                                )
        );
    }

    public function getcompStoreList($compid) {
        return $this->getORM()->where("basic_comp_id", $compid)->fetchAll();
    }

    public function getStoreList() {
        return $this->getORM()->fetchAll();
    }

    public function makeStoreState($id, $state) {
        return $this->getORM()->where("id", $id)->update(array("state" => $state));
    }
    
    public function updateStoreFS($id, $account) {
        return $this->getORM()->where("id", $id)->update(array("freight_space_account" => $account));
    }

}
