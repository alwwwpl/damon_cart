<?php
class ModelSaleCustomised extends Model {
    public function getCustomised($customised_id) {
        $customised_query = $this->db->query("SELECT c.*, cc.firstname, cc.lastname  FROM " . DB_PREFIX . "customised c LEFT JOIN " . DB_PREFIX . "customer cc ON c.customer_id = cc.customer_id WHERE c.customised_id = '" . (int)$customised_id . "'");

        if ($customised_query->num_rows) {
            return array(
                'customised_id'        => $customised_query->row['customised_id'],
                'customer_id'          => $customised_query->row['customer_id'],
                'firstname'            => $customised_query->row['firstname'],
                'lastname'             => $customised_query->row['lastname'],
                'product_name'         => $customised_query->row['product_name'],
                'product_type'         => $customised_query->row['product_type'],
                'product_brand'        => $customised_query->row['product_brand'],
                'number'               => $customised_query->row['number'],
                'description'          => $customised_query->row['description'],
                'image'                => $customised_query->row['image'],
                'status'               => $customised_query->row['status'],
                'datetime'             => $customised_query->row['datetime']
            );
        } else {
            return;
        }
    }

    public function getCustomiseds($data = array()) {
        $sql = "SELECT c.*, cc.firstname, cc.lastname  FROM " . DB_PREFIX . "customised c LEFT JOIN " . DB_PREFIX . "customer cc ON c.customer_id = cc.customer_id";

        $sort_data = array(
            'c.customised_id',
            'cc.firstname',
            'cc.lastname',
            'c.product_name',
            'c.product_type',
            'c.product_brand',
            'c.number',
            'c.description',
            'c.image',
            'c.status',
            'c.datetime',
            'c.customer_id'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY c.customised_id";
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

    public function getTotalCustomiseds() {
        $sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customised WHERE customised_id > '0'";

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

    public function getMessages($customised_id) {
        $message_query = $this->db->query("SELECT m.*, (SELECT CONCAT(lastname,firstname) FROM oc_customer WHERE customer_id = m.send_customer_id) as name FROM `" . DB_PREFIX . "message` m WHERE customised_id = '" . (int)$customised_id . "'");

        if ($message_query->num_rows) {

            return $message_query->rows;

        } else {

            return false;
        }
    }

    public function addMessage($data){
//      $this->event->trigger('pre.customer.add.customised', $data);

        $this->db->query("INSERT INTO " . DB_PREFIX . "message SET send_customer_id = '0', title = '" . $this->db->escape($data['title']) . "', content = '" . $this->db->escape($data['content']) . "', customised_id = '" . $this->db->escape($data['customised_id']) . "'");

        $message_id = $this->db->getLastId();

        return $message_id;
    }

    public function deleteCustomised($customised_id) {
        $this->db->query("DELETE FROM " . DB_PREFIX . "customised WHERE customised_id = '" . (int)$customised_id . "'");
    }
}