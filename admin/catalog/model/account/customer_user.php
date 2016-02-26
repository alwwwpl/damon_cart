<?php
class ModelAccountCustomerUser extends Model {
    public function addCustomerUser($data) {
        $this->event->trigger('pre.customer_user.add', $data);

        $sql = "INSERT INTO " . DB_PREFIX . "customer_user SET username = '" . $this->db->escape($data['email']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', password = '" . $this->db->escape(sha1(sha1(sha1($data['password'])))) . "', date_added = NOW()";

        $code = $data['code'];
        if($code){
            $customer_id = hexdec($code)-100000;

            $sql .= ", customer_id=".$customer_id;
        }

        $this->db->query($sql);

        $customer_user_id = $this->db->getLastId();

        $this->load->language('mail/customer_user');

        $subject = sprintf($this->language->get('text_subject'), $this->config->get('config_name'));

        $message = sprintf($this->language->get('text_welcome'), $this->config->get('config_name')) . "\n\n";

        $message .= $this->url->link('account/login', '', 'SSL') . "\n\n";
        $message .= $this->language->get('text_services') . "\n\n";
        $message .= $this->language->get('text_thanks') . "\n";
        $message .= $this->config->get('config_name');

        $mail = new Mail($this->config->get('config_mail'));
        $mail->setTo($data['email']);
        $mail->setFrom($this->config->get('config_email'));
        $mail->setSender($this->config->get('config_name'));
        $mail->setSubject($subject);
        $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
        $mail->send();

        // Send to main admin email if new account email is enabled
        if ($this->config->get('config_account_mail')) {
            $message  = $this->language->get('text_signup') . "\n\n";
            $message .= $this->language->get('text_website') . ' ' . $this->config->get('config_name') . "\n";
            $message .= $this->language->get('text_firstname') . ' ' . $data['firstname'] . "\n";
            $message .= $this->language->get('text_lastname') . ' ' . $data['lastname'] . "\n";
            $message .= $this->language->get('text_customer_group') . ' ' . $customer_group_info['name'] . "\n";
            $message .= $this->language->get('text_email') . ' '  .  $data['email'] . "\n";
            $message .= $this->language->get('text_telephone') . ' ' . $data['telephone'] . "\n";

            $mail->setTo($this->config->get('config_email'));
            $mail->setSubject(html_entity_decode($this->language->get('text_new_customer'), ENT_QUOTES, 'UTF-8'));
            $mail->setText(html_entity_decode($message, ENT_QUOTES, 'UTF-8'));
            $mail->send();

            // Send to additional alert emails if new account email is enabled
            $emails = explode(',', $this->config->get('config_mail_alert'));

            foreach ($emails as $email) {
                if (utf8_strlen($email) > 0 && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
                    $mail->setTo($email);
                    $mail->send();
                }
            }
        }

        $this->event->trigger('post.customer_user.add', $customer_id);

        return $customer_id;
    }

    public function getCustomerUserByEmail($email) {
        $query = $this->db->query("SELECT * FROM " . DB_PREFIX . "customer_user WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row;
    }

    public function getTotalCustomerUsersByEmail($email) {
        $query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "customer_user WHERE LOWER(email) = '" . $this->db->escape(utf8_strtolower($email)) . "'");

        return $query->row['total'];
    }
}