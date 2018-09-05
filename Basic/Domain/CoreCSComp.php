<?php

class Domain_CoreCSComp {

    public function setCompState($data) {
        //get tree of company
        $this->checkCompState($data);
        $this->changeCompState($data);
        $this->refreshAuthWithComp($data->param1);
    }

    public function checkCompState($data) {
        $compState = new Model_CompInfo();
        $compInfo = $compState->getInfoById($data->param1);
        if (!$compInfo) {
            throw new PhalApi_Exception_BadRequest(T('no Comp'), 107);
        }
        if ($compInfo['states'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeCompState($data) {
        //change Comp State
        $changeComp = new Model_CompInfo();
        $changeComp->updateState($data);
        //change Auth Comp State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updateCompState($data);
    }

    public function refreshAuthWithComp($compId) {
        //refresh with Comp Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getCompAuths($compId);
        DI()->logger->info('开始刷新: 公司id->' . $compId);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['org_state'] == "activate" && $value['group_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 公司id->' . $compId . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['group_state'] != "activate" || $value['group_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_group'] != "activate" || $value['rel_group'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate" ) && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 公司id->' . $compId . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 公司id->' . $compId);
    }

}
