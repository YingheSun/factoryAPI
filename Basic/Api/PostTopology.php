<?php

class Api_PostTopology extends PhalApi_Api {

    public function getRules() {
        return array(
            'getTopology' => array(
                'uuid' => array(
                    'name' => 'uuid',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '设备标识'),
            )
        );
    }

    /**
     * 获取公司,组织,班组拓扑
     * @desc 通过该接口获取公司,组织,班组拓扑
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getTopology() {
        $getTree = new Domain_PostTopology();
        return $getTree->get_Topology_Action($this);
    }

}
