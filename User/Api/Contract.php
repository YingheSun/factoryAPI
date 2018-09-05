<?php

class Api_Contract extends PhalApi_Api {

    public function getRules() {
        return array(
            'contract' => array(
                'name' => array(
                    'name' => 'name',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '名称'),
                'email' => array(
                    'name' => 'email',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '电子邮件'),
                'phone' => array(
                    'name' => 'phone',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '手机'),
                'comment' => array(
                    'name' => 'comment',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '留言'),
            )
        );
    }

    /**
     * 联络
     * @desc 接口接受联络,并发送邮件
     * @return array ret为200=>已受理成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function contract() {
        $addContract = new Domain_Contract();
        $addContract->set_Contract($this);
    }

}
