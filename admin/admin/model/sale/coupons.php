<?php
class ModelSaleCoupons extends Model {
    public function addCoupons($data) {
        $this->event->trigger('pre.admin.coupons.add', $data);

        $this->db->query("INSERT INTO " . DB_PREFIX . "coupons SET coupons_name = '" . $this->db->escape($data['coupons_name']) . "', `discount` = '" . (float)$data['discount'] . "', agent_id = '" . $data['agent_id'] . "', `condition` = '" . (float)$data['condition'] . "', agent_percent = '" . $this->db->escape($data['agent_percent']) . "', system_percent = '" . $this->db->escape($data['system_percent']) . "', start_time = '" . $this->db->escape($data['start_time']) . "', over_time = '" . $this->db->escape($data['over_time']) . "'");

//        echo "INSERT INTO " . DB_PREFIX . "coupons SET coupons_name = '" . $this->db->escape($data['coupons_name']) . "', `discount` = '" . (float)$data['discount'] . "', agent_id = '" . $data['agent_id'] . "', `condition` = '" . (float)$data['condition'] . "', agent_percent = '" . $this->db->escape($data['agent_percent']) . "', system_percent = '" . $this->db->escape($data['system_percent']) . "', start_time = '" . $this->db->escape($data['start_time']) . "', over_time = '" . $this->db->escape($data['over_time']) . "'";
        $coupons_id = $this->db->getLastId();

        if (isset($data['product_category'])) {
            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "coupons_product_category SET coupons_id = '" . (int)$coupons_id . "', category_id = '" . (int)$category_id . "'");
            }
        }

        $this->event->trigger('post.admin.coupons.add', $coupons_id);

        return $coupons_id;

    }

    public function editCoupons($coupons_id, $data) {
        $this->event->trigger('pre.admin.coupons.edit', $data);

        $this->db->query("UPDATE " . DB_PREFIX . "coupons SET coupons_name = '" . $this->db->escape($data['coupons_name']) . "', `discount` = '" . (float)$data['discount'] . "', agent_id = '" . $data['agent_id'] . "', `condition` = '" . (float)$data['condition'] . "', agent_percent = '" . $this->db->escape($data['agent_percent']) . "', system_percent = '" . $this->db->escape($data['system_percent']) . "', start_time = '" . $this->db->escape($data['start_time']) . "', over_time = '" . $this->db->escape($data['over_time']) . "' WHERE coupons_id = '" .(int)$coupons_id. "'");

        if (isset($data['product_category'])) {

            $this->db->query("DELETE FROM `" . DB_PREFIX . "coupons_product_category` WHERE coupons_id = '" . $coupons_id . "'");

            foreach ($data['product_category'] as $category_id) {
                $this->db->query("INSERT INTO " . DB_PREFIX . "coupons_product_category SET coupons_id = '" . (int)$coupons_id . "', category_id = '" . (int)$category_id . "'");
            }
        }

        $this->event->trigger('post.admin.coupons.edit', $coupons_id);
    }

    public function deleteCoupons($coupons_id) {
        $this->event->trigger('pre.admin.coupons.delete', $coupons_id);

        $this->db->query("DELETE FROM " . DB_PREFIX . "coupons WHERE coupons_id = '" . (int)$coupons_id . "'");
        $this->db->query("DELETE FROM " . DB_PREFIX . "coupons_code WHERE coupons_id = '" . (int)$coupons_id . "'");

        $this->event->trigger('post.admin.coupons.delete', $coupons_id);
    }

    public function getCoupons($coupons_id) {
        $query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "coupons WHERE coupons_id = '" . (int)$coupons_id . "'");

        return $query->row;
    }

    public function getCouponses($data = array()) {
        $sql = "SELECT coupons_id, coupons_name, oc_coupons.agent_id, `condition`, `discount`, agent_percent, system_percent, start_time, over_time, a.username as agent_name FROM " . DB_PREFIX . "coupons LEFT JOIN `" . DB_PREFIX . "agent` a ON oc_coupons.agent_id = a.agent_id";

        $sort_data = array(
            'coupons_name',
            'agent_id',
            'agent_name',
            'system_percent',
            'condition',
            'discount',
            'start_time',
            'over_time',
            'agent_percent'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY coupons_name";
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

    public function getCouponsCodes($coupons_id) {
        $coupons_code_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "coupons_code WHERE coupons_id = '" . (int)$coupons_id . "'");

        return $query->rows;
    }

    public function getTotalCouponses() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "coupons");

        return $query->row['total'];
    }

    public function getTotalCouponsCodes($coupons_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "coupons_code WHERE coupons_id = '" . (int)$coupons_id . "'");

        return $query->row['total'];
    }


    public function getProductCategories($coupons_id) {
        $product_category_data = array();

        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "coupons_product_category WHERE coupons_id = '" . (int)$coupons_id . "'");

        foreach ($query->rows as $result) {
            $product_category_data[] = $result['category_id'];
        }

        return $product_category_data;
    }


    public function createCoupons($coupons_id, $total) {

        for ($i = 0; $i < $total; $i++) {

            $code = $this->make_coupon_card();

            $this->db->query("INSERT INTO `". DB_PREFIX ."coupons_code` SET coupons_id = '" . $coupons_id . "', code = '" . $code . "'");

            if ($i == $total - 1)
            {
                return true;
            }
        }

    }

    function make_coupon_card() {
        $code = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand = $code[rand(0,25)]
            .strtoupper(dechex(date('m')))
            .date('d').substr(time(),-5)
            .substr(microtime(),2,5)
            .sprintf('%02d',rand(0,99));
        for(
            $a = md5( $rand, true ),
            $s = '0123456789ABCDEFGHIJKLMNOPQRSTUV',
            $d = '',
            $f = 0;
            $f < 8;
            $g = ord( $a[ $f ] ),
            $d .= $s[ ( $g ^ ord( $a[ $f + 8 ] ) ) - $g & 0x1F ],
            $f++
        );
        return $d;
    }


}