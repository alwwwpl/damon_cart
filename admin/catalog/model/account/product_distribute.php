<?php
class ModelAccountProductDistribute extends Model {
    public function getProductDistributes(){
        $query = $this->db->query("SELECT DISTINCT p.product_id, ps.price as supplier_price, p.price, d.distribute_price, d.product_distribute_id, pd.name FROM " . DB_PREFIX . "product_distribute AS d LEFT JOIN " . DB_PREFIX . "product AS p ON d.product_id=p.product_id  LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) LEFT JOIN " . DB_PREFIX . "product_supplier ps ON d.supplier_id = ps.supplier_id WHERE customer_id = " . (int)$this->customer->getId() . " AND pd.language_id =" . (int)$this->config->get('config_language_id'));
        $results = $query->rows;
        $results = $results ? $results : array();
        return $results;
    }

    public function addProductDistribute($data){
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "product_distribute WHERE customer_id = '" . (int)$this->customer->getId() . "' AND product_id = '" . intval($data['product_id']) . "' AND supplier_id = '" . intval($data['supplier_id']) . "'");
        if ($query->num_rows){

            return false;

        }else{
            $this->event->trigger('pre.customer.add.product_distribute', $data);

            $this->db->query("INSERT INTO " . DB_PREFIX . "product_distribute SET customer_id = '" . (int)$this->customer->getId() . "', distribute_price = '" . floatval($data['price']) . "', supplier_id = '" . intval($data['supplier_id']) . "', product_id = " . intval($data['product_id']) . ", date_added = '" . date('Y-m-d H:i:s') . "'");

            $product_distribute_id = $this->db->getLastId();

            $this->event->trigger('post.customer.add.product_distribute', $product_distribute_id);

            return $product_distribute_id;
        }

    }

    public function editProductDistribute($product_distribute_id, $data){
        $this->event->trigger('pre.customer.edit.product_distribute', $data);

        $this->db->query("UPDATE " . DB_PREFIX . "product_distribute SET distribute_price = '" . floatval($data['price']) . "', date_modified = '" . date('Y-m-d H:i:s') . "' WHERE product_distribute_id  = '" . (int)$product_distribute_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");

        $this->event->trigger('post.customer.edit.product_distribute', $product_distribute_id);
    }

    public function deleteProductDistribute($product_distribute_id){
        $this->event->trigger('pre.customer.delete.product_distribute', $product_distribute_id);

        $this->db->query("DELETE FROM " . DB_PREFIX . "product_distribute WHERE product_distribute_id = '" . (int)$product_distribute_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");

        $this->event->trigger('post.customer.delete.product_distribute', $product_distribute_id);
    }

    public function getTotalProductDistibutes() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "product_distribute WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        return $query->row['total'];
    }


    public function getProductPrice($product_id){
        $query = $this->db->query("SELECT price FROM " . DB_PREFIX . "product WHERE product_id = '" . $product_id . "'");

        return $query->row['price'];
    }


}