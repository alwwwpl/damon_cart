<?php
class ModelLocalisationArea extends Model {
    public function getProvinces() {

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "area` WHERE level = 1 AND parent_id = 1");

        return $query->rows;
    }

    public function getCitysByProvince($province_id) {

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "area` WHERE level = 2 AND parent_id = '" . $province_id . "'");

        return $query->rows;

    }
}