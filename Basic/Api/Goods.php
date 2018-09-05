<?php

class Api_Goods extends PhalApi_Api {

    public function getRules() {
        return array(
            'getGoodsList' => array(
                'compid' => array(
                    'name' => 'compId',
                    'type' => 'string',
                    'require' => true,
                    'desc' => '企业id'),
                'checkCode' => array(
                    'name' => 'checkCode',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '用户id'),
                'token' => array(
                    'name' => 'token',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => 'token'),
            ),
        );
    }

    /**
     * 商品列表
     * @desc 接口用于查看商品列表
     * @return array ret为200=>列表
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function getGoodsList() {
        $goodsList = new Domain_Goods();
        return $goodsList->getGoodsList($this);
    }

}
