<?php

class Api_RelUserPost extends PhalApi_Api {

    public function getRules() {
        return array(
            'setUserRel' => array(
                'postId' => array(
                    'name' => 'postId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '岗位id'),
                'userId' => array(
                    'name' => 'userId',
                    'type' => 'string',
                    'min' => 1,
                    'max' => 100,
                    'require' => true,
                    'desc' => '用户id'),
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
            )
        );
    }

    /**
     * 设置用户所属岗位
     * @desc 通过该接口可以设置用户所属岗位
     * @return array ret为200=>设置成功(production)
     * @return array ret不为200=>查看msg的内容(production)
     */
    public function setUserRel() {
        $setRel = new Domain_RelUserPost();
        return $setRel->set_Rel_Action($this);
    }

}
