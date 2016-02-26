<?php
class ModelCheckoutCoupons extends Model {
    public function getCoupons($code) {
        $status = true;

        $date = date('Y-m-d H:i:s');

        $coupons_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "coupons_code` cc LEFT JOIN `" . DB_PREFIX . "coupons` c ON cc.coupons_id = c.coupons_id WHERE cc.code = '" . $this->db->escape($code) . "' AND c.start_time < '" . $date . "' AND c.over_time > '" . $date . "' AND cc.status = 0");

        if ($coupons_query->num_rows) {

            $total = 0;

            //遍历购物车产品
            foreach ($this->cart->getProducts() as $product) {

                //购物车产品代理商ID == 优惠券代理商ID
                if (!empty($product['agent_id']) && $product['agent_id'] == $coupons_query->row['agent_id'])
                {
                    $category_query = $this->db->query("SELECT category_id FROM `" . DB_PREFIX . "product_to_category` WHERE product_id = '". $product['product_id'] ."'");

                    $coupons_category_query = $this->db->query("SELECT category_id FROM `" . DB_PREFIX . "coupons_product_category` WHERE coupons_id = '" . $coupons_query->row['coupons_id'] . "'");

                    foreach ($category_query->rows as $category)
                    {
                        foreach ($coupons_category_query->rows as $coupons_category)
                        {
                            if ($coupons_category['category_id'] == $category['category_id'])
                            {
                                $category_status = true;
                            }
                        }
                    }

                    if ($category_status)
                    {
                        $total += $product['total'];
                    }

                }

            }

            if ($total < $coupons_query->row['condition'])
            {
                $status = false;
            }

        } else {
            $status = false;
        }

        if ($status) {
            return array(
                'coupons_code_id'    => $coupons_query->row['coupons_code_id'],
                'coupons_id'         => $coupons_query->row['coupons_id'],
                'code'               => $coupons_query->row['code'],
                'coupons_name'       => $coupons_query->row['coupons_name'],
                'condition'          => $coupons_query->row['condition'],
                'discount'           => $coupons_query->row['discount'],
                'total'              => $total
            );
        }
    }

    public function getPriceByOrderid($order_id)
    {
        $priceData = $this->db->query("SELECT c.discount, c.agent_percent FROM `" . DB_PREFIX . "coupons_code` cc LEFT JOIN `" . DB_PREFIX . "coupons` c ON cc.coupons_id = c.coupons_id WHERE cc.order_id = '" . $order_id . "'");

        if ($priceData->rows)
        {
            return $price = $priceData->row['discount'] * $priceData->row['agent_percent'];
        }
        else
        {
            return false;
        }

    }
}