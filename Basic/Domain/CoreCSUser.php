<?php

class Domain_CoreCSUser {

    public function setUserState($data) {
        //get refresh tree of User
        $this->checkUserState($data);
        $this->refreshUserAuths($data);
        $this->refreshAuthWithUser($data);
    }

    public function checkUserState($data) {
        $postState = new Model_UserInfo();
        $postInfo = $postState->getInfoById($data->param1);
        if (!$postInfo) {
            throw new PhalApi_Exception_BadRequest(T('no User'), 112);
        }
        if ($postInfo['state'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function refreshUserAuths($data) {
        if ($data->state == "not_activated") {
            //change Comp State
            $changeUserStat = new Model_UserInfo();
            $changeUserStat->updateState($data);
            $changeAuth = new Model_UserAuth();
            $changeAuth->updateUserState1($data);
        } else {
//            throw new PhalApi_Exception_BadRequest(T('not allow to activate user,pls recreate'), 116);
            $this->openrelCheck($data);
            $changeUserStat = new Model_UserInfo();
            $changeUserStat->updateState($data);
//            $changeAuth = new Model_UserAuth();
//            $changeAuth->updateUserState1($data);
        }
    }

    public function openrelCheck($data) {
        $changeAuth = new Model_UserAuth();
        $relstat = $changeAuth->getusercheck($data);
        if (!$relstat) {
            throw new PhalApi_Exception_BadRequest(T('not allow to activate user,no post releated'), 116);
        }
    }

    public function refreshAuthWithUser($data) {
        //refresh with User Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getUserAuths($data->param1);
        DI()->logger->info('开始刷新: 用户id->' . $data->param1);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['post_state'] == "activate" && $value['post_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['rel_post'] == "activate" && $value['rel_post'] == "activate" && $value['rel_post'] == "activate" && $value['rel_duty'] == "activate" && $value['rel_action'] == "activate" && $value['rel_auth'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 用户id->' . $data->param1 . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['post_state'] != "activate" || $value['post_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_post'] != "activate" || $value['rel_post'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate" ) && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 用户id->' . $data->param1 . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 用户id->' . $data->param1);
    }

}
