<?php
class ModelAccountMessage extends Model {

    public function getMessages($customised_id) {
        $message_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "message` WHERE customised_id = '" . (int)$customised_id . "'");

        if ($message_query->num_rows) {

            return $message_query->rows;

        } else {

            return false;
        }
    }

    public function addMessage($data){
//      $this->event->trigger('pre.customer.add.customised', $data);

        $this->db->query("INSERT INTO " . DB_PREFIX . "message SET send_customer_id = '" . (int)$this->customer->getId() . "', title = '" . $this->db->escape($data['title']) . "', content = '" . $this->db->escape($data['content']) . "', customised_id = '" . $this->db->escape($data['customised_id']) . "'");

        $message_id = $this->db->getLastId();

        return $message_id;
    }

}