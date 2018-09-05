<?php

class Domain_TreeCompOrg {

    public function get_Tree_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->getTreeInfo($data);
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
        $check_CompState = new Model_CompInfo();
        $comp_state = $check_CompState->getInfoById($data->compId);
        if (!$comp_state) {
            throw new PhalApi_Exception_BadRequest(T('no Comp'), 107);
        }
    }

    public function getTreeInfo($data) {
        $this->check_rel($data);
        return $this->makeTree($data->compId);
    }

    public function makeTree($compId) {
        //get Company Info
        $compInfo = new Model_CompInfo();
        $retArr['compInfo'] = $compInfo->getInfoById($compId);
        //get Org Relation
        $compRel = new Model_RelCompOrg();
        $orgRel = $compRel->getRel($compId);
        //get All Releated Org Info
        foreach ($orgRel as $key => $value) {
            $orgInfo = new Model_OrgInfo();
            $retArr['orgInfos'][$key] = $orgInfo->getInfoById($value['basic_organize_id']);
            //get Group Relation
            $orgRel = new Model_RelOrgGroup();
            $groupRel = $orgRel->getRel($value['basic_organize_id']);
            //get All Releated Group Info
            foreach ($groupRel as $keyG => $value) {
                $groupInfo = new Model_GroupInfo();
                $retArr['orgInfos'][$key]['groupInfos'][$keyG] = $groupInfo->getInfoById($value['basic_group_id']);
            }
        }
        return $retArr;
    }

}
