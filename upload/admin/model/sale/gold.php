<?php
class ModelSaleGold extends Model {
    public function getGold($gold_id) {
        $gold_query = $this->db->query("SELECT g.*, gc.name as gold_category  FROM " . DB_PREFIX . "gold g LEFT JOIN " . DB_PREFIX . "gold_category gc ON g.gold_category_id = gc.gold_category_id WHERE g.gold_id = '" . (int)$gold_id . "'");

        if ($gold_query->num_rows) {

            return array(
                'gold_id'                 => $gold_query->row['gold_id'],
                'gold_category'           => $gold_query->row['gold_category'],
                'gold_category_id'        => $gold_query->row['gold_category_id'],
                'latest'                  => $gold_query->row['latest'],
                'opening'                 => $gold_query->row['opening'],
                'highest'                 => $gold_query->row['highest'],
                'lowest'                  => $gold_query->row['lowest'],
                'yesterday'               => $gold_query->row['yesterday'],
                'upsdowns'                => $gold_query->row['upsdowns'],
                'datetime'                => $gold_query->row['datetime']
            );
        } else {
            return;
        }
    }

    public function getGolds($data = array()) {
        $sql = "SELECT g.gold_id, g.latest, g.opening, g.highest, g.lowest, g.yesterday, g.upsdowns, g.datetime, gc.name as gold_category  FROM " . DB_PREFIX . "gold g LEFT JOIN " . DB_PREFIX . "gold_category gc ON g.gold_category_id = gc.gold_category_id";

        $sort_data = array(
            'g.gold_id',
            'g.latest',
            'g.opening',
            'g.highest',
            'g.lowest',
            'g.yesterday',
            'g.upsdowns',
            'g.datetime',
            'g.gold_category_id'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY g.gold_id";
        }

        if (isset($data['order']) && ($data['order'] == 'DESC')) {
            $sql .= " DESC";
        } else {
            $sql .= " ASC";
        }

        if (isset($data['start']) || isset($data['limit'])) {
            if ($data['start'] < 0) {
                $data['start'] = 0;
            }

            if ($data['limit'] < 1) {
                $data['limit'] = 20;
            }

            $sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
        }

        $query = $this->db->query($sql);

        return $query->rows;
    }

    public function getTotalGolds() {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "gold WHERE gold_id > '0'";

        $query = $this->db->query($sql);

        return $query->row['total'];
    }

    public function addGold($data){
        $this->db->query("INSERT INTO " . DB_PREFIX . "gold SET gold_category_id = '" . $this->db->escape($data['gold_category_id']) . "', latest = '" . $this->db->escape($data['latest']) . "', opening = '" . $this->db->escape($data['opening']) . "', highest = '" . $this->db->escape($data['highest']) . "', lowest = '" . $this->db->escape($data['lowest']) . "', yesterday = '" . $this->db->escape($data['yesterday']) . "', upsdowns = '" . $this->db->escape($data['upsdowns']) . "', datetime = '" . $this->db->escape($data['datetime']) . "'");

        $gold_id = $this->db->getLastId();

        return $gold_id;
    }

    public function editGold($gold_id,$data){
        $this->db->query("UPDATE " . DB_PREFIX . "gold SET gold_category_id = '" . $this->db->escape($data['gold_category_id']) . "', latest = '" . $this->db->escape($data['latest']) . "', opening = '" . $this->db->escape($data['opening']) . "', highest = '" . $this->db->escape($data['highest']) . "', lowest = '" . $this->db->escape($data['lowest']) . "', yesterday = '" . $this->db->escape($data['yesterday']) . "', upsdowns = '" . $this->db->escape($data['upsdowns']) . "', datetime = '" . $this->db->escape($data['datetime']) . "' WHERE gold_id = '" . $gold_id . "'");

    }

    public function getGoldCategory() {

        $category_query = $this->db->query("SELECT gold_category_id, name  FROM " . DB_PREFIX . "gold_category");

        return $category_query->rows;
    }


    public function deleteGold($gold_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "gold WHERE gold_id = '" . (int)$gold_id . "'");
    }
}