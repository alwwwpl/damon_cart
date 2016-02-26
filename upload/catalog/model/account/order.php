<?php
class ModelAccountOrder extends Model {
	public function getOrder($order_id) {
		$order_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "' AND customer_id = '" . (int)$this->customer->getId() . "' AND order_status_id > '0'");

		if ($order_query->num_rows) {
			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");

			if ($country_query->num_rows) {
				$payment_iso_code_2 = $country_query->row['iso_code_2'];
				$payment_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$payment_iso_code_2 = '';
				$payment_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$payment_zone_code = $zone_query->row['code'];
			} else {
				$payment_zone_code = '';
			}

			$country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");

			if ($country_query->num_rows) {
				$shipping_iso_code_2 = $country_query->row['iso_code_2'];
				$shipping_iso_code_3 = $country_query->row['iso_code_3'];
			} else {
				$shipping_iso_code_2 = '';
				$shipping_iso_code_3 = '';
			}

			$zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");

			if ($zone_query->num_rows) {
				$shipping_zone_code = $zone_query->row['code'];
			} else {
				$shipping_zone_code = '';
			}

			return array(
				'order_id'                => $order_query->row['order_id'],
				'invoice_no'              => $order_query->row['invoice_no'],
				'invoice_prefix'          => $order_query->row['invoice_prefix'],
				'store_id'                => $order_query->row['store_id'],
				'store_name'              => $order_query->row['store_name'],
				'store_url'               => $order_query->row['store_url'],
				'customer_id'             => $order_query->row['customer_id'],
				'firstname'               => $order_query->row['firstname'],
				'lastname'                => $order_query->row['lastname'],
				'telephone'               => $order_query->row['telephone'],
				'fax'                     => $order_query->row['fax'],
				'email'                   => $order_query->row['email'],
				'payment_firstname'       => $order_query->row['payment_firstname'],
				'payment_lastname'        => $order_query->row['payment_lastname'],
				'payment_company'         => $order_query->row['payment_company'],
				'payment_address_1'       => $order_query->row['payment_address_1'],
				'payment_address_2'       => $order_query->row['payment_address_2'],
				'payment_postcode'        => $order_query->row['payment_postcode'],
				'payment_city'            => $order_query->row['payment_city'],
				'payment_zone_id'         => $order_query->row['payment_zone_id'],
				'payment_zone'            => $order_query->row['payment_zone'],
				'payment_zone_code'       => $payment_zone_code,
				'payment_country_id'      => $order_query->row['payment_country_id'],
				'payment_country'         => $order_query->row['payment_country'],
				'payment_iso_code_2'      => $payment_iso_code_2,
				'payment_iso_code_3'      => $payment_iso_code_3,
				'payment_address_format'  => $order_query->row['payment_address_format'],
				'payment_method'          => $order_query->row['payment_method'],
				'shipping_firstname'      => $order_query->row['shipping_firstname'],
				'shipping_lastname'       => $order_query->row['shipping_lastname'],
				'shipping_company'        => $order_query->row['shipping_company'],
				'shipping_address_1'      => $order_query->row['shipping_address_1'],
				'shipping_address_2'      => $order_query->row['shipping_address_2'],
				'shipping_postcode'       => $order_query->row['shipping_postcode'],
				'shipping_city'           => $order_query->row['shipping_city'],
				'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
				'shipping_zone'           => $order_query->row['shipping_zone'],
				'shipping_zone_code'      => $shipping_zone_code,
				'shipping_country_id'     => $order_query->row['shipping_country_id'],
				'shipping_country'        => $order_query->row['shipping_country'],
				'shipping_iso_code_2'     => $shipping_iso_code_2,
				'shipping_iso_code_3'     => $shipping_iso_code_3,
				'shipping_address_format' => $order_query->row['shipping_address_format'],
				'shipping_method'         => $order_query->row['shipping_method'],
				'comment'                 => $order_query->row['comment'],
				'total'                   => $order_query->row['total'],
				'order_status_id'         => $order_query->row['order_status_id'],
				'language_id'             => $order_query->row['language_id'],
				'currency_id'             => $order_query->row['currency_id'],
				'currency_code'           => $order_query->row['currency_code'],
				'currency_value'          => $order_query->row['currency_value'],
				'date_modified'           => $order_query->row['date_modified'],
				'date_added'              => $order_query->row['date_added'],
				'ip'                      => $order_query->row['ip']
			);
		} else {
			return false;
		}
	}

	public function getOrders($start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 1;
		}

		$query = $this->db->query("SELECT o.order_id, o.distribute_id, o.firstname, o.lastname, os.name as status, o.date_added, o.total, o.currency_code, o.currency_value FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_status os ON (o.order_status_id = os.order_status_id) WHERE o.customer_id = '" . (int)$this->customer->getId() . "' AND o.order_status_id > '0' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.order_id DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getOrderProduct($order_id, $order_product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product_id . "'");

		return $query->row;
	}

	public function getOrderProducts($order_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->rows;
	}

	public function getOrderOptions($order_id, $order_product_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_option WHERE order_id = '" . (int)$order_id . "' AND order_product_id = '" . (int)$order_product_id . "'");

		return $query->rows;
	}

	public function getOrderVouchers($order_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_voucher` WHERE order_id = '" . (int)$order_id . "'");

		return $query->rows;
	}

	public function getOrderTotals($order_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "order_total WHERE order_id = '" . (int)$order_id . "' ORDER BY sort_order");

		return $query->rows;
	}

	public function getOrderHistories($order_id) {
		$query = $this->db->query("SELECT date_added, os.name AS status, oh.comment, oh.notify FROM " . DB_PREFIX . "order_history oh LEFT JOIN " . DB_PREFIX . "order_status os ON oh.order_status_id = os.order_status_id WHERE oh.order_id = '" . (int)$order_id . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY oh.date_added");

		return $query->rows;
	}

	public function getTotalOrders() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` o WHERE customer_id = '" . (int)$this->customer->getId() . "' AND o.order_status_id > '0' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "'");

		return $query->row['total'];
	}

	public function getTotalOrderProductsByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
	}

	public function getTotalOrderVouchersByOrderId($order_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order_voucher` WHERE order_id = '" . (int)$order_id . "'");

		return $query->row['total'];
	}

    public function getTotalDistributeOrders() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "order` o WHERE o.distribute_id = '" . (int)$this->customer->getId() . "' AND o.order_status_id > '0' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "'");

        return $query->row['total'];
    }

    public function getDistributeOrders($start = 0, $limit = 20) {
        if ($start < 0) {
            $start = 0;
        }

        if ($limit < 1) {
            $limit = 1;
        }

        $query = $this->db->query("SELECT o.order_id, o.firstname, o.lastname, o.express, o.order_status_id, o.distribute_status, os.name as status, o.date_added, (SELECT SUM(op.total) FROM `" . DB_PREFIX . "order_product` op WHERE op.order_id = o.order_id AND op.customer_id = '" . (int)$this->customer->getId() . "' ) as total, o.currency_code, o.currency_value FROM `" . DB_PREFIX . "order` o LEFT JOIN " . DB_PREFIX . "order_status os ON (o.order_status_id = os.order_status_id) WHERE o.distribute_id = '" . (int)$this->customer->getId() . "' AND o.order_status_id > '0' AND o.store_id = '" . (int)$this->config->get('config_store_id') . "' AND os.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.order_id DESC LIMIT " . (int)$start . "," . (int)$limit);

        return $query->rows;
    }

    public function getTotalDistributeOrderProductsByOrderId($order_id) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "order_product WHERE order_id = '" . (int)$order_id . "' AND distribute_id = '" . (int)$this->customer->getId() . "'");

        return $query->row['total'];
    }

    public function getDistributeOrder($order_id) {
        $order_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order` WHERE order_id = '" . (int)$order_id . "' AND distribute_id = '" . (int)$this->customer->getId() . "' AND order_status_id > '0'");

        if ($order_query->num_rows) {
            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['payment_country_id'] . "'");

            if ($country_query->num_rows) {
                $payment_iso_code_2 = $country_query->row['iso_code_2'];
                $payment_iso_code_3 = $country_query->row['iso_code_3'];
            } else {
                $payment_iso_code_2 = '';
                $payment_iso_code_3 = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['payment_zone_id'] . "'");

            if ($zone_query->num_rows) {
                $payment_zone_code = $zone_query->row['code'];
            } else {
                $payment_zone_code = '';
            }

            $country_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "country` WHERE country_id = '" . (int)$order_query->row['shipping_country_id'] . "'");

            if ($country_query->num_rows) {
                $shipping_iso_code_2 = $country_query->row['iso_code_2'];
                $shipping_iso_code_3 = $country_query->row['iso_code_3'];
            } else {
                $shipping_iso_code_2 = '';
                $shipping_iso_code_3 = '';
            }

            $zone_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "zone` WHERE zone_id = '" . (int)$order_query->row['shipping_zone_id'] . "'");

            if ($zone_query->num_rows) {
                $shipping_zone_code = $zone_query->row['code'];
            } else {
                $shipping_zone_code = '';
            }

            return array(
                'order_id'                => $order_query->row['order_id'],
                'invoice_no'              => $order_query->row['invoice_no'],
                'invoice_prefix'          => $order_query->row['invoice_prefix'],
                'store_id'                => $order_query->row['store_id'],
                'store_name'              => $order_query->row['store_name'],
                'store_url'               => $order_query->row['store_url'],
                'customer_id'             => $order_query->row['customer_id'],
                'firstname'               => $order_query->row['firstname'],
                'lastname'                => $order_query->row['lastname'],
                'telephone'               => $order_query->row['telephone'],
                'fax'                     => $order_query->row['fax'],
                'email'                   => $order_query->row['email'],
                'payment_firstname'       => $order_query->row['payment_firstname'],
                'payment_lastname'        => $order_query->row['payment_lastname'],
                'payment_company'         => $order_query->row['payment_company'],
                'payment_address_1'       => $order_query->row['payment_address_1'],
                'payment_address_2'       => $order_query->row['payment_address_2'],
                'payment_postcode'        => $order_query->row['payment_postcode'],
                'payment_city'            => $order_query->row['payment_city'],
                'payment_zone_id'         => $order_query->row['payment_zone_id'],
                'payment_zone'            => $order_query->row['payment_zone'],
                'payment_zone_code'       => $payment_zone_code,
                'payment_country_id'      => $order_query->row['payment_country_id'],
                'payment_country'         => $order_query->row['payment_country'],
                'payment_iso_code_2'      => $payment_iso_code_2,
                'payment_iso_code_3'      => $payment_iso_code_3,
                'payment_address_format'  => $order_query->row['payment_address_format'],
                'payment_method'          => $order_query->row['payment_method'],
                'shipping_firstname'      => $order_query->row['shipping_firstname'],
                'shipping_lastname'       => $order_query->row['shipping_lastname'],
                'shipping_company'        => $order_query->row['shipping_company'],
                'shipping_address_1'      => $order_query->row['shipping_address_1'],
                'shipping_address_2'      => $order_query->row['shipping_address_2'],
                'shipping_postcode'       => $order_query->row['shipping_postcode'],
                'shipping_city'           => $order_query->row['shipping_city'],
                'shipping_zone_id'        => $order_query->row['shipping_zone_id'],
                'shipping_zone'           => $order_query->row['shipping_zone'],
                'shipping_zone_code'      => $shipping_zone_code,
                'shipping_country_id'     => $order_query->row['shipping_country_id'],
                'shipping_country'        => $order_query->row['shipping_country'],
                'shipping_iso_code_2'     => $shipping_iso_code_2,
                'shipping_iso_code_3'     => $shipping_iso_code_3,
                'shipping_address_format' => $order_query->row['shipping_address_format'],
                'shipping_method'         => $order_query->row['shipping_method'],
                'comment'                 => $order_query->row['comment'],
                'total'                   => $order_query->row['total'],
                'order_status_id'         => $order_query->row['order_status_id'],
                'language_id'             => $order_query->row['language_id'],
                'currency_id'             => $order_query->row['currency_id'],
                'currency_code'           => $order_query->row['currency_code'],
                'currency_value'          => $order_query->row['currency_value'],
                'date_modified'           => $order_query->row['date_modified'],
                'date_added'              => $order_query->row['date_added'],
                'ip'                      => $order_query->row['ip']
            );
        } else {
            return false;
        }
    }

    public function getDistributeOrderProducts($order_id,$customer_id=null) {
        if (empty($customer_id)){
            $customer_id = $this->customer->getId();
        }
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "' AND customer_id = '" . (int)$customer_id . "'");

        return $query->rows;
    }

    public function getDistributeOrderPrice($order_id) {
        $query = $this->db->query("SELECT SUM(total) as total FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "' AND distribute_id = '" . (int)$this->customer->getId() . "'");

        return $query->row['total'];
    }

    public function getDistributeOrderTotals($order_id) {
        $query = $this->db->query("SELECT o.*, (SELECT SUM(op.total) FROM `" . DB_PREFIX . "order_product` op WHERE op.order_id = o.order_id AND op.distribute_id = '" . (int)$this->customer->getId() . "' ) as total FROM " . DB_PREFIX . "order_total o WHERE o.order_id = '" . (int)$order_id . "' ORDER BY o.sort_order");

        return $query->rows;
    }

    public function updateOrderStatus($order_id,$status,$distribute_id=null,$status_id=null)
    {
        if (empty($distribute_id))
        {
            $distribute_id = $this->customer->getId();
        }
        if (!empty($status_id))
        {
            $status_id = " , order_status_id = ".$status_id;
        }
        else
        {
            $status_id = "";
        }
        $this->db->query("UPDATE `" . DB_PREFIX . "order_product` SET status = '" . $status . "' " . $status_id . " WHERE order_id = '" . $order_id . "' AND distribute_id = '" . (int)$distribute_id . "'");
        $this->db->query("UPDATE `" . DB_PREFIX . "order` SET distribute_status = '" . $status . "' " . $status_id . "  WHERE order_id = '" . $order_id . "' AND distribute_id = '" . (int)$distribute_id . "'");
    }

    public function getDistributeProductTotal($order_id) {
        $total = 0;
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . (int)$order_id . "' AND customer_id = '" . (int)$this->customer->getId() . "'");
        $products = $query->rows;
        if($products) {
            foreach ($products as $product){
//                $result = $this->db->query("SELECT p.price, ps.price as supplier_price FROM `" . DB_PREFIX . "product` p LEFT JOIN `" . DB_PREFIX . "product_supplier` ps ON p.product_id = ps.product_id WHERE p.product_id = '" . (int)$product['product_id'] . "' AND ps.supplier_id = (SELECT pd.supplier_id FROM `" . DB_PREFIX . "product_distribute` pd WHERE pd.product_distribute_id = '" . (int)$product['distribute_id'] . "')");
                $result = $this->db->query("SELECT p.price, ps.price as supplier_price FROM `" . DB_PREFIX . "product` p LEFT JOIN `" . DB_PREFIX . "product_supplier` ps ON p.product_id = ps.product_id WHERE p.product_id = '" . (int)$product['product_id'] . "' AND ps.supplier_id = '" . (int)$product['supplier_id'] . "'");

//                $result = $this->db->query("SELECT price FROM `" . DB_PREFIX . "product` p LEFT JOIN `" . DB_PREFIX . "product_supplier` ps ON  WHERE product_id = '" . (int)$product['product_id'] . "'");
                $total += $product['quantity'] * isset($result->row['supplier_price']) ? $result->row['supplier_price'] : $result->row['price'];
            }
        }
        return $total;
    }


    public function changeOrderProductStatus($order_id, $product_id, $status)
    {
        $query = $this->db->query("SELECT supplier_id FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . $order_id . "' AND product_id = '" . $product_id . "'");
        if ($query->rows)
        {
            $this->db->query("UPDATE `" . DB_PREFIX . "order_product` SET status = '" . $status . "' WHERE order_id = '" . $order_id . "' AND product_id = '" . $product_id . "'");

            if ($status == '已完成')
            {
                $query_e = $this->db->query("SELECT e.extensioner_id, e.parent_id FROM `" . DB_PREFIX . "extensioner_customer` ec LEFT JOIN `" . DB_PREFIX . "extensioner` e ON ec.extensioner_id = e.extensioner_id WHERE ec.customer_id = '" . (int)$this->customer->getId() . "'");

                $query_p = $this->db->query("SELECT quantity, price, total FROM `" . DB_PREFIX . "order_product` WHERE order_id = '" . $order_id . "' AND product_id = '" . $product_id . "'");
                //有上级推广人
                if ($query_e->row['parent_id'])
                {
                    $query_a = $this->db->query("SELECT * FROM `"  . DB_PREFIX .  "extensioner_accounting` WHERE extensioner_id = '" . $query_e->row['parent_id'] . "'");

                    foreach ($query_a->rows as $val)
                    {
                        $query_c = $this->db->query("SELECT category_id FROM `"  . DB_PREFIX .  "product_to_category` WHERE product_id = '" . $product_id . "'");

                        foreach ($query_c->rows as $value)
                        {
                            if ($value['category_id'] == $val['type'])
                            {
                                //分帐按%比
                                if ($val['each'] == '%')
                                {
                                    $amount = $query_p->row['total'] * ($val['price'] / 100);
                                }
                                //分帐按G
                                elseif ($val['each'] == 'g')
                                {
                                    $amount = $query_p->row['quantity'] * ($val['price'] / 100);
                                }

                                $date_added = date('Y-m-d H:i:s');

                                $query_parent = $this->db->query("SELECT percent FROM `"  . DB_PREFIX .  "extensioner` WHERE extensioner_id = '" . $query_e->row['extensioner_id'] . "'");

                                $amount_parent = $amount * $query_parent->row['percent'];

                                $amount = $amount - $amount_parent;

                                $this->db->query("INSERT INTO `" . DB_PREFIX . "extensioner_transaction` SET extensioner_id = '" . $query_e->row['extensioner_id'] . "', order_id = '" . $order_id . "', description = '订单分帐', amount = '" . $amount_parent . "', cash = '" . $amount_parent . "', date_added = '" . $date_added . "'");

                                $this->db->query("INSERT INTO `" . DB_PREFIX . "extensioner_transaction` SET extensioner_id = '" . $query_e->row['parent_id'] . "', order_id = '" . $order_id . "', description = '订单分帐', amount = '" . $amount . "', cash = '" . $amount . "', date_added = '" . $date_added . "'");

                            }
                        }
                    }

                }
                //无上级推广人
                else
                {
                    $query_a = $this->db->query("SELECT * FROM `"  . DB_PREFIX .  "extensioner_accounting` WHERE extensioner_id = '" . $query_e->row['extensioner_id'] . "'");

                    foreach ($query_a->rows as $val)
                    {
                        $query_c = $this->db->query("SELECT category_id FROM `"  . DB_PREFIX .  "product_to_category` WHERE product_id = '" . $product_id . "'");

                        foreach ($query_c->rows as $value)
                        {
                            if ($value['category_id'] == $val['type'])
                            {
                                //分帐按%比
                                if ($val['each'] == '%')
                                {
                                    $amount = $query_p->row['total'] * ($val['price'] / 100);
                                }
                                //分帐按G
                                elseif ($val['each'] == 'g')
                                {
                                    $amount = $query_p->row['quantity'] * ($val['price'] / 100);
                                }

                                $date_added = date('Y-m-d H:i:s');

                                $this->db->query("INSERT INTO `" . DB_PREFIX . "extensioner_transaction` SET extensioner_id = '" . $query_e->row['extensioner_id'] . "', order_id = '" . $order_id . "', description = '订单分帐', amount = '" . $amount . "', cash = '" . $amount . "', date_added = '" . $date_added . "'");

                            }
                        }
                    }
                }
            }


            return $query->row['supplier_id'];
        }
    }


    public function updateOrderExpress($data){
        $query = $this->db->query("UPDATE `" . DB_PREFIX . "order` SET order_status_id = '" . $data['order_status_id'] . "', express = '" . $data['express'] . "', distribute_status = '" . $data['distribute_status'] . "' WHERE order_id = '" . $data['order_id'] . "'");
        return true;
    }
}