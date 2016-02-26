<?php
class ModelSaleAgent extends Model {

    public function getAgents() {

        $query = $this->db->query("SELECT agent_id, username FROM " . DB_PREFIX . "agent WHERE status = 1");

        return $query->rows;
    }

}