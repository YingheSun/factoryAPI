<?php

class Domain_GroupInfo {

    public function set_Group_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->setGroupInfo($data);
        }
    }

    public function get_Group_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $list = $this->getOrgList($data);
            foreach ($list as $key => $value) {
                $getList = new Model_RelOrgGroup();
                $grouplist = $getList->getGroupList($value['basic_organize_id']);
                $list[$key]['groupInfos'] = $grouplist;
            }
            return $list;
        }
    }

    public function get_Group_info_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            $getinfo = new Model_GroupInfo();
            return $getinfo->getInfoById($data->id);
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

    public function setGroupInfo($data) {
        $set_Info = new Model_GroupInfo();
        return $set_Info->setGroupInfo($data);
    }

    public function getOrgList($data) {
        $orgList = new Domain_OrgInfo();
        return $orgList->get_Org_Action($data);
    }

}
