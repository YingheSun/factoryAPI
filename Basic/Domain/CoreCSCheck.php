<?php

class Domain_CoreCSCheck {

    public function check_Type_Action($data) {
        $chkCode = $this->checkToken($data->checkCode, $data->token);
        if ($chkCode) {
            return $this->runChgCheck($data);
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

    public function runChgCheck($data) {
        DI()->logger->info('修改: 类型->' . $data->type . '转换到状态->' . $data->state . '参数1->' . $data->param1 . '参数2->' . $data->param2);
        switch ($data->type) {
            case 'all':
                //todo
                break;
            case 'comp':
                //change company's state
                $this->chgComp($data);
                break;
            case 'org':
                //change orgination's state
                $this->chgOrg($data);
                break;
            case 'group':
                //change Group's state
                $this->chgGroup($data);
                break;
            case 'post':
                //change Post's state
                $this->chgPost($data);
                break;
            case 'duty':
                //change Duty's state
                $this->chgDuty($data);
                break;
            case 'action':
                //change Action's state
                $this->chgAction($data);
                break;
            case 'auth':
                //change Auth's state
                $this->chgAuth($data);
                break;
            case 'user':
                //
                $this->chgUser($data);
                break;
            case 'rel_org':
                //change Rel Comp_Org state
                $this->chgRelOrg($data);
                break;
            case 'rel_group':
                //change Rel Org_Group state
                $this->chgRelGroup($data);
                break;
            case 'rel_post':
                //change Rel Group_Post state
                $this->chgRelPost($data);
                break;
            case 'rel_duty':
                //change Rel Post_Duty state
                $this->chgRelDuty($data);
                break;
            case 'rel_post':
                //change Rel Group_Post state
                $this->chgRelPost($data);
                break;
            case 'rel_action':
                //change Rel Post_Action state
                $this->chgRelAction($data);
                break;
            case 'rel_auth':
                $this->chgRelAuth($data);
                break;
            case 'rel_user':
                $this->ChgRelUser($data);
                break;
            default:
                break;
        }
        return array("修改成功");
    }

    public function chgComp($data) {
        $changeComp = new Domain_CoreCSComp();
        $changeComp->setCompState($data);
    }

    public function chgOrg($data) {
        $changeOrg = new Domain_CoreCSOrg();
        $changeOrg->setOrgState($data);
    }

    public function chgGroup($data) {
        $changeGroup = new Domain_CoreCSGroup();
        $changeGroup->setGroupState($data);
    }

    public function chgPost($data) {
        $changePost = new Domain_CoreCSPost();
        $changePost->setPostState($data);
    }

    public function chgDuty($data) {
        $changeDuty = new Domain_CoreCSDuty();
        $changeDuty->setDutyState($data);
    }

    public function chgAction($data) {
        $changeDuty = new Domain_CoreCSAction();
        $changeDuty->setActionState($data);
    }

    public function chgAuth($data) {
        $changeDuty = new Domain_CoreCSAuth();
        $changeDuty->setAuthState($data);
    }

    public function chgRelOrg($data) {
        $changeRelOrg = new Domain_CoreCSRelOrg();
        $changeRelOrg->setOrgRel($data);
    }

    public function chgRelGroup($data) {
        $changeRelGroup = new Domain_CoreCSRelGroup();
        $changeRelGroup->setGroupRel($data);
    }

    public function chgRelPost($data) {
        $changeRelPost = new Domain_CoreCSRelPost();
        $changeRelPost->setPostRel($data);
    }

    public function chgRelDuty($data) {
        $changeRelDuty = new Domain_CoreCSRelDuty();
        $changeRelDuty->setDutyRel($data);
    }

    public function chgRelAction($data) {
        $changeRelAction = new Domain_CoreCSRelAction();
        $changeRelAction->setActionRel($data);
    }

    public function chgRelAuth($data) {
        $changeRelAction = new Domain_CoreCSRelAuth();
        $changeRelAction->setAuthRel($data);
    }

    public function chgUser($data) {
        $changeUser = new Domain_CoreCSUser();
        $changeUser->setUserState($data);
    }

    public function ChgRelUser($data) {
        $changeRelUser = new Domain_CoreCSRelUser();
        $changeRelUser->setUserRel($data);
    }

}
