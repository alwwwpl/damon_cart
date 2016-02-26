<?php
class ModelAccountCustomised extends Model {

    public function getCustomised($customised_id) {
        $customised_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customised` WHERE customised_id = '" . (int)$customised_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");

        if ($customised_query->num_rows) {

            return array(
                'customised_id'       => $customised_query->row['customised_id'],
                'product_name'        => $customised_query->row['product_name'],
                'product_type'        => $customised_query->row['product_type'],
                'product_brand'       => $customised_query->row['product_brand'],
                'number'              => $customised_query->row['number'],
                'description'         => $customised_query->row['description'],
                'image'               => $customised_query->row['image'],
                'status'              => $customised_query->row['status'],
                'datetime'            => $customised_query->row['datetime']
            );
        } else {
            return false;
        }
    }

    public function addCustomised($data){
//        $this->event->trigger('pre.customer.add.customised', $data);

        $this->db->query("INSERT INTO " . DB_PREFIX . "customised SET customer_id = '" . (int)$this->customer->getId() . "', product_name = '" . $this->db->escape($data['product_name']) . "', product_type = '" . $this->db->escape($data['product_type']) . "', product_brand = '" . $this->db->escape($data['product_brand']) . "', number = '" . $this->db->escape($data['number']) . "', description = '" . $this->db->escape($data['desc']) . "', image = '" . $this->db->escape($data['image']) . "'");

        $customised_id = $this->db->getLastId();

        return $customised_id;
    }

    public function getCustomiseds($start = 0, $limit = 20) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 1;
        }

        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customised` c  WHERE c.customer_id = '" . (int)$this->customer->getId() . "'  ORDER BY c.customer_id DESC LIMIT " . (int)$start . "," . (int)$limit);

        return $query->rows;
    }

    public function getTotalCustomiseds() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customised` o WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        return $query->row['total'];
    }

}