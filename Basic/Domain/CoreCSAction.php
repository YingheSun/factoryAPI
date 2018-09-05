<?php

class Domain_CoreCSAction {

    public function setActionState($data) {
        //get refresh tree of Action
        $this->checkActionState($data);
        $this->changeActionState($data);
        $this->refreshAuthWithAction($data->param1);
    }

    public function checkActionState($data) {
        $actionState = new Model_ActionInfo();
        $actionInfo = $actionState->getInfoById($data->param1);
        if (!$actionInfo) {
            throw new PhalApi_Exception_BadRequest(T('no Action'), 112);
        }
        if ($actionInfo['state'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeActionState($data) {
        //change Action State
        $changeAction = new Model_ActionInfo();
        $changeAction->updateState($data);
        //change Auth Action State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updateActionState($data);
    }

    public function refreshAuthWithAction($actionId) {
        //refresh with Action Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getActionAuths($actionId);
        DI()->logger->info('开始刷新: 作业id->' . $actionId);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['action_state'] == "activate" && $value['action_state'] == "activate" && $value['action_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['rel_action'] == "activate" && $value['rel_action'] == "activate" && $value['rel_action'] == "activate" && $value['rel_duty'] == "activate" && $value['rel_action'] == "activate" && $value['rel_auth'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 作业id->' . $actionId . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['action_state'] != "activate" || $value['action_state'] != "activate" || $value['action_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_action'] != "activate" || $value['rel_action'] != "activate" || $value['rel_action'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate") && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 作业id->' . $actionId . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 作业id->' . $actionId);
    }

}
