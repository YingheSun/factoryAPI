<?php

class Model_StoreSet extends PhalApi_Model_NotORM {

    public function addStore($id) {
        $tbname = 'ecs_mrp_freight_space' . $id;
        $sql = 'create table if not exists ' . $tbname . ' like ecs_mrp_freight_space';
        $this->addGoods($id);
        $this->addStorage($id);
        return $this->getORM()->queryAll($sql);
    }
    
    public function addGoods($id) {
        $tbname = 'ecs_mrp_goods' . $id;
        $sql = 'create table if not exists ' . $tbname . ' like ecs_mrp_goods';
        return $this->getORM()->queryAll($sql);
    }
    
    public function addStorage($id) {
        $tbname = 'ecs_mrp_storage' . $id;
        $sql = 'create table if not exists ' . $tbname . ' like ecs_mrp_storage';
        return $this->getORM()->queryAll($sql);
    }

}
