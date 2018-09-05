<?php

class Domain_RelPostDuty {

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
        $check_Rel = new Model_RelPostDuty();
        $rel_state = $check_Rel->checkExistState($data);
        if ($rel_state) {
            throw new PhalApi_Exception_BadRequest(T('has already seted Relation'), 106);
        }
        $check_PostState = new Model_PostInfo();
        $post_state = $check_PostState->getInfoById($data->postId);
        if (!$post_state) {
            throw new PhalApi_Exception_BadRequest(T('no Post'), 110);
        }
        $check_DutyState = new Model_DutyInfo();
        $duty_State = $check_DutyState->getInfoById($data->dutyId);
        if (!$duty_State) {
            throw new PhalApi_Exception_BadRequest(T('no Duty'), 111);
        }
    }

    public function setRelInfo($data) {
        $this->check_rel($data);
        $set_Rel = new Model_RelPostDuty();
        $set_Rel->setRelInfo($data);
        return array("设置成功");
    }

}
