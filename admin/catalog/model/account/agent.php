<?php
class ModelAccountAgent extends Model {

    public function getAgentCity($agent_id) {
        $agent_query = $this->db->query("SELECT r.area_name FROM `" . DB_PREFIX . "agent` a LEFT JOIN `" . DB_PREFIX . "area` r ON a.agent_city_id = r.area_id WHERE agent_id = '" . (int)$agent_id . "'");

        if ($agent_query->num_rows) {

            return $agent_query->row['area_name'];

        } else {

            return false;
        }
    }

    public function getAgentProvince($agent_id) {
        $agent_query = $this->db->query("SELECT r.area_name FROM `" . DB_PREFIX . "agent` a LEFT JOIN `" . DB_PREFIX . "area` r ON a.agent_province_id = r.area_id WHERE agent_id = '" . (int)$agent_id . "'");

        if ($agent_query->num_rows) {

            return $agent_query->row['area_name'];

        } else {

            return false;
        }
    }


    public function getExtensionerCity($extensioner_id) {
        $agent_query = $this->db->query("SELECT r.area_name FROM `" . DB_PREFIX . "extensioner` a LEFT JOIN `" . DB_PREFIX . "area` r ON a.city_id = r.area_id WHERE extensioner_id = '" . (int)$extensioner_id . "'");

        if ($agent_query->num_rows) {

            return $agent_query->row['area_name'];

        } else {

            return false;
        }
    }


    public function getExtensionerProvince($extensioner_id) {
        $agent_query = $this->db->query("SELECT r.area_name FROM `" . DB_PREFIX . "extensioner` a LEFT JOIN `" . DB_PREFIX . "area` r ON a.province_id = r.area_id WHERE extensioner_id = '" . (int)$extensioner_id . "'");

        if ($agent_query->num_rows) {

            return $agent_query->row['area_name'];

        } else {

            return false;
        }
    }

}