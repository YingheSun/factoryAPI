<?php

class Model_FreightSpace extends PhalApi_Model_NotORM {

    protected function getTableName($compid) {
        return 'mrp_freight_space' . $compid;
    }

    public function setFreightSpaceInfo($data, $fsname) {
        return $this->getORM($data->compId)
                        ->insert(array(
                            "basic_comp_id" => $data->compId,
                            "mrp_store_info_id" => $data->storeId,
                            "name" => $fsname,
                            "type" => $data->type
                                )
        );
    }

    public function getPrefixExistState($data) {
        return $this->getORM($data->compId)->where("name", $data->name)->where("type", "Prefix")->fetchAll();
    }

    public function addPrefixExistState($data) {
        return $this->getORM($data->compId)
                        ->insert(array(
                            "basic_comp_id" => $data->compId,
                            "mrp_store_info_id" => $data->storeId,
                            "name" => $data->name,
                            "type" => "Prefix"
                                )
        );
    }

    public function getList($data) {
        return $this->getORM($data->compId)->where("mrp_store_info_id", $data->storeId)->where("type != ?", 'Prefix')->fetchAll();
    }

    public function makeFreightSpaceState($data) {
        return $this->getORM($data->compId)->where("id", $data->fsId)->update(array("state" => $data->state));
    }

    public function getStoreFSAccount($data) {
        return $this->getORM($data->compId)->select('COUNT(*) AS FSaccount')->where("mrp_store_info_id", $data->storeId)->where("type != ?", 'Prefix')->fetchAll();
    }

}
