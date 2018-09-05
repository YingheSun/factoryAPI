<?php

class Domain_CoreCSGroup {

    public function setGroupState($data) {
        //get refresh tree of Group
        $this->checkGroupState($data);
        $this->changeGroupState($data);
        $this->refreshAuthWithGroup($data->param1);
    }

    public function checkGroupState($data) {
        $groupState = new Model_GroupInfo();
        $groupInfo = $groupState->getInfoById($data->param1);
        if (!$groupInfo) {
            throw new PhalApi_Exception_BadRequest(T('no Group'), 109);
        }
        if ($groupInfo['state'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeGroupState($data) {
        //change Group State
        $changeGroup = new Model_GroupInfo();
        $changeGroup->updateState($data);
        //change Auth Group State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updateGroupState($data);
    }

    public function refreshAuthWithGroup($groupId) {
        //refresh with Group Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getGroupAuths($groupId);
        DI()->logger->info('开始刷新: 班组id->' . $groupId);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['group_state'] == "activate" && $value['group_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['rel_group'] == "activate" && $value['rel_group'] == "activate" && $value['rel_post'] == "activate" && $value['rel_duty'] == "activate" && $value['rel_action'] == "activate" && $value['rel_auth'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 班组id->' . $groupId . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['group_state'] != "activate" || $value['group_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_group'] != "activate" || $value['rel_group'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate") && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 班组id->' . $groupId . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 班组id->' . $groupId);
    }

}
