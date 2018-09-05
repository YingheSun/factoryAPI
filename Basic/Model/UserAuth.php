<?php

class Model_UserAuth extends PhalApi_Model_NotORM {

    protected function getTableName($id) {
        return 'core_user_authority';
    }

    public function setUserAuth($authId, $actionId, $dutyId, $postId, $userId, $groupId, $orgId, $compId) {
        return $this->getORM()
                        ->insert(array(
                            "post_id" => $postId,
                            "auth_id" => $authId,
                            "group_id" => $groupId,
                            "user_id" => $userId,
                            "org_id" => $orgId,
                            "comp_id" => $compId,
                            "duty_id" => $dutyId,
                            "action_id" => $actionId,
                                )
        );
    }

    public function getAuthCheck($authId, $actionId, $dutyId, $postId, $userId, $groupId, $orgId, $compId) {
        return $this->getORM()->where("auth_id", $authId)->where("action_id", $actionId)->where("duty_id", $dutyId)->where("post_id", $postId)->where("user_id", $userId)->where("group_id", $groupId)->where("org_id", $orgId)->where("comp_id", $compId)->fetchrow();
    }

    public function changeCoreStates($id, $state) {
        return $this->getORM()->where("id", $id)->update(array("state" => $state));
    }

    public function getCompAuths($compId) {
        return $this->getORM()->where("comp_id", $compId)->fetchAll();
    }

    public function updateCompState($data) {
        return $this->getORM()->where("comp_id", $data->param1)->update(array("comp_state" => $data->state));
    }

    public function getOrgAuths($orgId) {
        return $this->getORM()->where("org_id", $orgId)->fetchAll();
    }

    public function updateOrgState($data) {
        return $this->getORM()->where("org_id", $data->param1)->update(array("org_state" => $data->state));
    }

    public function getGroupAuths($orgId) {
        return $this->getORM()->where("group_id", $orgId)->fetchAll();
    }

    public function updateGroupState($data) {
        return $this->getORM()->where("group_id", $data->param1)->update(array("group_state" => $data->state));
    }

    public function getPostAuths($postId) {
        return $this->getORM()->where("post_id", $postId)->fetchAll();
    }

    public function updatePostState($data) {
        return $this->getORM()->where("post_id", $data->param1)->update(array("post_state" => $data->state));
    }

    public function getActionAuths($actionId) {
        return $this->getORM()->where("action_id", $actionId)->fetchAll();
    }

    public function updateActionState($data) {
        return $this->getORM()->where("action_id", $data->param1)->update(array("action_state" => $data->state));
    }

    public function getDutyAuths($dutyid) {
        return $this->getORM()->where("duty_id", $dutyid)->fetchAll();
    }

    public function updateDutyState($data) {
        return $this->getORM()->where("duty_id", $data->param1)->update(array("duty_state" => $data->state));
    }

    public function getAuthAuths($actionId) {
        return $this->getORM()->where("auth_id", $actionId)->fetchAll();
    }

    public function getUserAuths($userId) {
        return $this->getORM()->where("user_id", $userId)->fetchAll();
    }

    public function updateAuthState($data) {
        return $this->getORM()->where("auth_id", $data->param1)->update(array("auth_state" => $data->state));
    }

    public function getOrgRelAuth($data) {
        return $this->getORM()->where("comp_id", $data->param1)->where("org_id", $data->param2)->fetchAll();
    }

    public function updateOrgRelState($data) {
        return $this->getORM()->where("comp_id", $data->param1)->where("org_id", $data->param2)->update(array("rel_org" => $data->state));
    }

    public function getGroupRelAuth($data) {
        return $this->getORM()->where("group_id", $data->param2)->where("org_id", $data->param1)->fetchAll();
    }

    public function updateGroupRelState($data) {
        return $this->getORM()->where("group_id", $data->param2)->where("org_id", $data->param1)->update(array("rel_group" => $data->state));
    }

    public function getPostRelAuth($data) {
        return $this->getORM()->where("group_id", $data->param1)->where("post_id", $data->param2)->fetchAll();
    }

    public function updatePostRelState($data) {
        return $this->getORM()->where("group_id", $data->param1)->where("post_id", $data->param2)->update(array("rel_post" => $data->state));
    }

    public function getDutyRelAuth($data) {
        return $this->getORM()->where("duty_id", $data->param2)->where("post_id", $data->param1)->fetchAll();
    }

    public function updateDutyRelState($data) {
        return $this->getORM()->where("duty_id", $data->param2)->where("post_id", $data->param1)->update(array("rel_duty" => $data->state));
    }

    public function getActionRelAuth($data) {
        return $this->getORM()->where("duty_id", $data->param1)->where("action_id", $data->param2)->fetchAll();
    }

    public function updateActionRelState($data) {
        return $this->getORM()->where("duty_id", $data->param1)->where("action_id", $data->param2)->update(array("rel_action" => $data->state));
    }

    public function getAuthRelAuth($data) {
        return $this->getORM()->where("action_id", $data->param1)->where("auth_id", $data->param2)->fetchAll();
    }

    public function updateAuthRelState($data) {
        return $this->getORM()->where("action_id", $data->param1)->where("auth_id", $data->param2)->update(array("rel_auth" => $data->state));
    }

    public function updateUserState($data) {
        return $this->getORM()->where("post_id", $data->param1)->where("user_id", $data->param2)->update(array("user_state" => $data->state));
    }

    public function updateUserState1($data) {
        return $this->getORM()->where("user_id", $data->param1)->update(array("user_state" => $data->state));
    }

    public function getusercheck($data) {
        return $this->getORM()->where("user_id", $data->param1)->where("user_state", "activate")->fetchRow();
    }

}
