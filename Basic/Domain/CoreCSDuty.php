<?php

class Domain_CoreCSDuty {

    public function setDutyState($data) {
        //get refresh tree of Duty
        $this->checkDutyState($data);
        $this->changeDutyState($data);
        $this->refreshAuthWithDuty($data->param1);
    }

    public function checkDutyState($data) {
        $postState = new Model_DutyInfo();
        $postInfo = $postState->getInfoById($data->param1);
        if (!$postInfo) {
            throw new PhalApi_Exception_BadRequest(T('no Duty'), 110);
        }
        if ($postInfo['state'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeDutyState($data) {
        //change Duty State
        $changeDuty = new Model_DutyInfo();
        $changeDuty->updateState($data);
        //change Auth Duty State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updateDutyState($data);
    }

    public function refreshAuthWithDuty($postId) {
        //refresh with Duty Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getDutyAuths($postId);
        DI()->logger->info('开始刷新: 岗位id->' . $postId);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['post_state'] == "activate" && $value['post_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['rel_post'] == "activate" && $value['rel_post'] == "activate" && $value['rel_post'] == "activate" && $value['rel_duty'] == "activate" && $value['rel_action'] == "activate" && $value['rel_auth'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 岗位id->' . $postId . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['post_state'] != "activate" || $value['post_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_post'] != "activate" || $value['rel_post'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate") && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 岗位id->' . $postId . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 岗位id->' . $postId);
    }

}
