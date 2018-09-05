<?php

class Domain_MobileTopology {

    public function get_Topology_Action($data) {
        require_once dirname(__FILE__) . '/PhalApiClient.php';

//        $requestBase = "http://127.0.0.1/factory_api/Public/basic/";
//local
        $requestBase = "http://www.esclouds.cn/ESAPI/PhalApi/Public/basic/";
//server

        $client = PhalApiClient::create()
                ->withHost($requestBase);

        $rs = $client->reset()
                ->withService('PostTopology.GetTopology')
                ->withParams('uuid', $data->uuid)
                ->withTimeout(3000)
                ->request();

        $datas = $rs->getData();
        $retarr = array();
        foreach ($datas as $key => $value) {
            $retarr[$key] = $value[0];
        }
        return $retarr;
    }

}
