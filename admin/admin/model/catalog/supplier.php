<?php
class ModelCatalogSupplier extends Model {

    public function getAgents() {

        $query = $this->db->query("SELECT a.agent_id, a.username, a.agent_province_id, a.agent_city_id, 0 as area_name
            FROM `" . DB_PREFIX . "agent` a LEFT JOIN `" . DB_PREFIX . "area` ar ON a.agent_city_id = ar.area_id WHERE a.status = 1 ");
        $agents = $query->rows;
        if ($agents){
            foreach ($agents as &$val){
                if ($val['agent_city_id']){
                    $val['area_name'] = $this->getAreaName($val['agent_city_id']);
                }
                elseif ($val['agent_province_id']){
                    $val['area_name'] = $this->getAreaName($val['agent_province_id']);
                }
            }
        }

        return $agents;
    }

    public function getAreaName($area_id){
        $query = $this->db->query("SELECT area_name FROM oc_area WHERE area_id = '".$area_id."'");

        return $query->row['area_name'];
    }
}