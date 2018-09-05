<?php

class Domain_RelCompOrg {

    public function set_Rel_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setRelInfo($data);
        }
    }

    public function checkToken($id, $token) {
        $getLogInfo = new Model_PassLog();
        $res = $getLogInfo->getInfos($id, $token);
        if (!$res) {
            throw new PhalApi_Exception_BadRequest(T('no Token'), 104);
        }
        if ($res['overdue_time'] < time()) {
            throw new PhalApi_Exception_BadRequest(T('overdued'), 105);
        }
        $resetLogInfo = new Model_PassLog();
        $resetLogInfo->reset_overdue_time($id);
        return TRUE;
    }

    public function check_rel($data) {
        $check_Rel = new Model_RelCompOrg();
        $rel_state = $check_Rel->checkExistState($data);
        if ($rel_state) {
            throw new PhalApi_Exception_BadRequest(T('has already seted Relation'), 106);
        }
        $check_CompState = new Model_CompInfo();
        $comp_state = $check_CompState->getInfoById($data->compId);
        if (!$comp_state) {
            throw new PhalApi_Exception_BadRequest(T('no Comp'), 107);
        }
        $check_OrgState = new Model_OrgInfo();
        $org_State = $check_OrgState->getInfoById($data->orgId);
        if (!$org_State) {
            throw new PhalApi_Exception_BadRequest(T('no Org'), 108);
        }
    }

    public function setRelInfo($data) {
        $this->check_rel($data);
        $set_Rel = new Model_RelCompOrg();
        $set_Rel->setRelInfo($data);
        return array("设置成功");
    }

}
