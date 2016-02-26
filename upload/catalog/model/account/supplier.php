<?php
class ModelAccountSupplier extends Model {

    public function getSupplier($supplier_id) {
        $supplier_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "product_supplier` WHERE supplier_id = '" . (int)$supplier_id . "'");

        if ($supplier_query->num_rows) {

            return $supplier_query->rows;

        } else {

            return false;
        }
    }
}