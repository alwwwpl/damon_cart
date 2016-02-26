<?php
class ModelAccountBankcard extends Model {
    public function getBankcards($data = array()) {
        $sql = "SELECT * FROM `" . DB_PREFIX . "bank_card` WHERE customer_id = '" . (int)$this->customer->getId() . "'";

        $sort_data = array(
            'create_time'
        );

        if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
            $sql .= " ORDER BY " . $data['sort'];
        } else {
            $sql .= " ORDER BY create_time";
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

    public function getTotalBankcards() {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM `" . DB_PREFIX . "bank_card` WHERE customer_id = '" . (int)$this->customer->getId() . "'");

        return $query->row['total'];
    }


    public function addBankcard($data){

        $this->db->query("INSERT INTO " . DB_PREFIX . "bank_card SET customer_id = '" . (int)$this->customer->getId() . "', username = '" . $this->db->escape($data['username']) . "', card_number = '" . $this->db->escape($data['card_number']) . "', bank = '" . $this->db->escape($data['bank']) . "'");

        $bankcard_id = $this->db->getLastId();

        return $bankcard_id;
    }

    public function addCashRecord($data)
    {
        if ($this->customer->getPaymentPassword() == md5($data['payment_password']))
        {
            $this->db->query("INSERT INTO `" . DB_PREFIX . "cash_record` SET customer_id = '" . (int)$this->customer->getId() . "', username = '" . $this->db->escape($data['username']) . "', bank_card = '" . $this->db->escape($data['bank_card']) . "', bank_card_id = '" . $this->db->escape($data['card_id']) . "', bank = '" . $this->db->escape($data['bank']) . "', amount = '" . $this->db->escape($data['amount']) . "', note = '" . $this->db->escape($data['note']) . "'");

            $cashrecord_id = $this->db->getLastId();

            $date = date('Y-m-d H:i:s');

            $this->db->query("INSERT INTO `" . DB_PREFIX . "customer_transaction` SET customer_id = '" . (int)$this->customer->getId() . "', order_id = 0, description = '余额提现', amount = '-". $this->db->escape($data['amount']) ."', cash = '-". $this->db->escape($data['amount']) ."', date_added = '" . $date . "'");

            return $cashrecord_id;

        }
        else
        {
            return false;
        }


    }

}