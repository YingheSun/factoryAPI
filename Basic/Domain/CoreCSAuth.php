<?php

class Domain_CoreCSAuth {

    public function setAuthState($data) {
        //get refresh tree of Auth
        $this->checkAuthState($data);
        $this->changeAuthState($data);
        $this->refreshAuthWithAuth($data->param1);
    }

    public function checkAuthState($data) {
        $authState = new Model_AuthInfo();
        $authInfo = $authState->getInfoById($data->param1);
        if (!$authInfo) {
            throw new PhalApi_Exception_BadRequest(T('no Auth'), 112);
        }
        if ($authInfo['state'] == $data->state) {
            throw new PhalApi_Exception_BadRequest(T('same State,no need to change'), 114);
        }
    }

    public function changeAuthState($data) {
        //change Auth State
        $changeAuth = new Model_AuthInfo();
        $changeAuth->updateState($data);
        //change Auth Auth State
        $changeAuths = new Model_UserAuth();
        $changeAuths->updateAuthState($data);
    }

    public function refreshAuthWithAuth($authId) {
        //refresh with Auth Level
        $getAuth = new Model_UserAuth();
        $AllAuths = $getAuth->getAuthAuths($authId);
        DI()->logger->info('开始刷新: 权限id->' . $authId);
        foreach ($AllAuths as $key => $value) {
            if ($value['user_state'] == "activate" && $value['comp_state'] == "activate" && $value['auth_state'] == "activate" && $value['auth_state'] == "activate" && $value['auth_state'] == "activate" && $value['duty_state'] == "activate" && $value['auth_state'] == "activate" && $value['auth_state'] == "activate" && $value['rel_auth'] == "activate" && $value['rel_auth'] == "activate" && $value['rel_auth'] == "activate" && $value['rel_duty'] == "activate" && $value['rel_auth'] == "activate" && $value['rel_auth'] == "activate" && $value['state'] != "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 权限id->' . $authId . '权限id->' . $value['id'] . '状态->activate');
                $updateCoreAuth->changeCoreStates($value['id'], "activate");
            } else if (($value['user_state'] != "activate" || $value['comp_state'] != "activate" || $value['auth_state'] != "activate" || $value['auth_state'] != "activate" || $value['auth_state'] != "activate" || $value['duty_state'] != "activate" || $value['auth_state'] != "activate" || $value['auth_state'] != "activate" || $value['rel_auth'] != "activate" || $value['rel_auth'] != "activate" || $value['rel_auth'] != "activate" || $value['rel_duty'] != "activate" || $value['rel_auth'] != "activate" || $value['rel_auth'] != "activate") && $value['state'] == "activate") {
                $updateCoreAuth = new Model_UserAuth();
                DI()->logger->info('刷新: 权限id->' . $authId . '权限id->' . $value['id'] . '状态->not_activated');
                $updateCoreAuth->changeCoreStates($value['id'], "not_activated");
            }
        }
        DI()->logger->info('结束刷新: 权限id->' . $authId);
    }

}
