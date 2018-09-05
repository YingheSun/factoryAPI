<?php

class Domain_CoreCSRelUser {

    public function setUserRel($data) {
        $this->checkRelState($data);
        $this->changeRelState($data);
        $this->refreshAuthWithRelUser($data);
    }

    public function checkRelState($data) {
        $relState = new Model_RelUserPost();
        $groupRelState = $relState->checkRelState($data);
        if (!$groupRelState) {
            throw new PhalApi_Exception_BadRequest(T('no Relation'), 115);
        }
        if ($groupRelState['state'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeRelState($data) {
        //change Comp State
        $changePostRel = new Model_RelUserPost();
        $changePostRel->updateRelState($data);
        //change Auth Comp State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updateUserState($data);
    }

    public function refreshAuthWithRelUser($data) {
        //refresh with User Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getUserAuths($data->param2);
        DI()->logger->info('开始刷新: 岗位id->' . $data->param1 . '用户id->' . $data->param2);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['org_state'] == "activate" && $value['group_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 岗位id->' . $data->param1 . '用户id->' . $data->param2 . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['group_state'] != "activate" || $value['group_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_group'] != "activate" || $value['rel_group'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate" ) && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 岗位id->' . $data->param1 . '用户id->' . $data->param2 . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 岗位id->' . $data->param1 . '用户id->' . $data->param2);
    }

}
