<?php
class ModelCatalogBidding extends Model {

    public function getBidding($prduct_id) {

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "bidding WHERE product_id = '" . (int)$prduct_id . "' ");

        return $query->row;
    }
}