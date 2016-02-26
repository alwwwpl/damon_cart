<?php
class ModelAccountInviteCode extends Model {
    public function getInviteCode($code) {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "invite_code` WHERE code='" . $this->db->escape($code) . "'");

        return $query->row;
    }
}