<?php

class Domain_OrgInfo {

    public function set_Org_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setOrgInfo($data);
        }
    }

    public function get_Org_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            if ($data->id == "") {
                $get_Info = new Model_RelCompOrg();
                return $get_Info->getOrgList();
            } else {
                $get_Info = new Model_RelCompOrg();
                return $get_Info->getOrgListWithCompId($data->id);
            }
        }
    }

    public function get_Org_info_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $get_Info = new Model_OrgInfo();
            return $get_Info->getInfoById($data->id);
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

    public function setOrgInfo($data) {
        $set_Info = new Model_OrgInfo();
        return $set_Info->setOrgInfo($data);
    }

}
