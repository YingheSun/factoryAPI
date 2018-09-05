<?php

class Domain_UserInfo {

    public function set_User_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        $this->checkUserInfo($data);
        if ($chkCode) {
            return $this->setUserInfo($data);
        }
    }

    public function get_User_List($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getUserList($data);
        }
    }

    public function checkToken($id, $token) {
        $getLogInfo = new Model_PassLog();
        $res = $getLogInfo->getInfos($id, $token);
        if (!$res) {
            throw new PhalApi_Exception_BadRequest(T('no Token'), 104);
        }
        if ($res['overdue_time'] < time()) {
            throw new PhalApi_Exception_BadRequest(T('overdued'), 105);
        }
        $resetLogInfo = new Model_PassLog();
        $resetLogInfo->reset_overdue_time($id);
        return TRUE;
    }

    public function setUserInfo($data) {
        $set_Info = new Model_UserInfo();
        return $set_Info->setUserInfo($data);
    }

    public function getUserList($data) {
        if (isset($data->postid)) {
            $get_Info = new Model_UserInfo();
            return $this->getrelstate($get_Info->getpostUserList($data->postid));
        } else {
            $get_Info = new Model_UserInfo();
            return $this->getrelstate($get_Info->getcompUserList($data->compid));
        }
    }

    public function getrelstate($listInfo) {
        $getRel = new Model_RelUserPost();
        $getName = new Model_PostInfo();
        foreach ($listInfo as $key => $value) {
            $relstat = $getRel->getRelState($value['basic_post_id'], $value['id']);
            $listInfo[$key]['rel_state'] = $relstat['state'];
            $postname = $getName->getInfoById($value['basic_post_id']);
            $listInfo[$key]['postname'] = $postname['post_name'];
        }
        return $listInfo;
    }

    public function checkUserInfo($data) {
        $set_Info = new Model_UserInfo();
        $chkName = $set_Info->getInfoByname($data->name);
        if ($chkName) {
            throw new PhalApi_Exception_BadRequest(T('same name,not allow to create user'), 117);
        }
    }

}
