<?php
class ModelAccountTransaction extends Model {
	public function getTransactions($data = array()) {
		$sql = "SELECT * FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$this->customer->getId() . "'";

		$sort_data = array(
			'amount',
			'description',
			'date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY date_added";
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

	public function getTotalTransactions() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$this->customer->getId() . "'");

		return $query->row['total'];
	}

	public function getTotalAmount() {
		$query = $this->db->query("SELECT SUM(amount) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$this->customer->getId() . "' GROUP BY customer_id");

		if ($query->num_rows) {
			return $query->row['total'];
		} else {
			return 0;
		}
	}

    public function getTotalCash() {
        $query = $this->db->query("SELECT SUM(cash) AS total FROM `" . DB_PREFIX . "customer_transaction` WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        if ($query->num_rows) {
            return $query->row['total'];
        } else {
            return 0;
        }
    }

    public function addTransaction($order_id,$desc,$amount,$cash,$customer_id=null) {
        if (empty($customer_id))
        {
            $customer_id = $this->customer->getId();
        }
        $this->db->query("INSERT INTO `" . DB_PREFIX . "customer_transaction` SET customer_id = '" . (int)$customer_id . "', order_id = '" . (int)$order_id . "', description = '" . $desc . "', amount = '" . $amount . "', cash = '" . $cash . "', date_added = NOW()");
    }

    public function addAgentTransaction($order_id,$desc,$amount,$cash,$agent_id=null) {
        $this->db->query("INSERT INTO `" . DB_PREFIX . "agent_transaction` SET agent_id = '" . (int)$agent_id . "', order_id = '" . (int)$order_id . "', description = '" . $desc . "', amount = '" . $amount . "', cash = '" . $cash . "', date_added = NOW()");
    }

}