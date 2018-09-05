<?php

class Domain_CoreCSRelAction {

    public function setActionRel($data) {
        $this->checkRelState($data);
        $this->changeRelState($data);
        $this->refreshAuthWithRelAction($data);
    }

    public function checkRelState($data) {
        $relState = new Model_RelDutyAction();
        $actionRelState = $relState->checkRelState($data);
        if (!$actionRelState) {
            throw new PhalApi_Exception_BadRequest(T('no Relation'), 115);
        }
        if ($actionRelState['states'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeRelState($data) {
        //change Comp State
        $changeDutyRel = new Model_RelDutyAction();
        $changeDutyRel->updateRelState($data);
        //change Auth Comp State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updateActionRelState($data);
    }

    public function refreshAuthWithRelAction($data) {
        //refresh with Action Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getActionRelAuth($data);
        DI()->logger->info('开始刷新: 职责id->' . $data->param1 . '作业id->' . $data->param2);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['org_state'] == "activate" && $value['group_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 职责id->' . $data->param1 . '作业id->' . $data->param2 . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['group_state'] != "activate" || $value['group_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_group'] != "activate" || $value['rel_group'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate" ) && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 职责id->' . $data->param1 . '作业id->' . $data->param2 . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 职责id->' . $data->param1 . '作业id->' . $data->param2);
    }

}
