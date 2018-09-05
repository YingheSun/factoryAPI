<?php

class Domain_CoreCSPost {

    public function setPostState($data) {
        //get refresh tree of Post
        $this->checkPostState($data);
        $this->changePostState($data);
        $this->refreshAuthWithPost($data->param1);
    }

    public function checkPostState($data) {
        $postState = new Model_PostInfo();
        $postInfo = $postState->getInfoById($data->param1);
        if (!$postInfo) {
            throw new PhalApi_Exception_BadRequest(T('no Post'), 110);
        }
        if ($postInfo['state'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changePostState($data) {
        //change Post State
        $changePost = new Model_PostInfo();
        $changePost->updateState($data);
        //change Auth Post State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updatePostState($data);
    }

    public function refreshAuthWithPost($postId) {
        //refresh with Post Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getPostAuths($postId);
        DI()->logger->info('开始刷新: 岗位id->' . $postId);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['post_state'] == "activate" && $value['post_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['rel_post'] == "activate" && $value['rel_post'] == "activate" && $value['rel_post'] == "activate" && $value['rel_duty'] == "activate" && $value['rel_action'] == "activate" && $value['rel_auth'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 岗位id->' . $postId . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['post_state'] != "activate" || $value['post_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_post'] != "activate" || $value['rel_post'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate" ) && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 岗位id->' . $postId . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 岗位id->' . $postId);
    }

}
