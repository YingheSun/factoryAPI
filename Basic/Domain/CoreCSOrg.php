<?php

class Domain_CoreCSOrg {

    public function setOrgState($data) {
        //get refresh tree of Org
        $this->checkOrgState($data);
        $this->changeOrgState($data);
        $this->refreshAuthWithOrg($data->param1);
    }

    public function checkOrgState($data) {
        $orgState = new Model_OrgInfo();
        $orgInfo = $orgState->getInfoById($data->param1);
        if (!$orgInfo) {
            throw new PhalApi_Exception_BadRequest(T('no Org'), 108);
        }
        if ($orgInfo['states'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeOrgState($data) {
        //change Org State
        $changeOrg = new Model_OrgInfo();
        $changeOrg->updateState($data);
        //change Auth Org State
        $changeAuth = new Model_UserAuth();
        $changeAuth->updateOrgState($data);
    }

    public function refreshAuthWithOrg($orgId) {
        //refresh with Org Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getOrgAuths($orgId);
        DI()->logger->info('开始刷新: 组织id->' . $orgId);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['org_state'] == "activate" && $value['group_state'] == "activate" && $value['post_state'] == "activate" && $value['duty_state'] == "activate" && $value['action_state'] == "activate" && $value['auth_state'] == "activate" && $value['rel_org'] == "activate" && $value['rel_group'] == "activate" && $value['rel_post'] == "activate" && $value['rel_duty'] == "activate" && $value['rel_action'] == "activate" && $value['rel_auth'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 组织id->' . $orgId . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['group_state'] != "activate" || $value['group_state'] != "activate" || $value['post_state'] != "activate" || $value['duty_state'] != "activate" || $value['action_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_group'] != "activate" || $value['rel_group'] != "activate" || $value['rel_post'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_action'] != "activate" || $value['rel_auth'] != "activate" ) && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 组织id->' . $orgId . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 组织id->' . $orgId);
    }

}
