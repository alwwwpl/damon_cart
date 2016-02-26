<?php
class ControllerPaymentTonglianpay extends Controller {
    public function index() {

        //如果需要用证书加密，使用phpseclib包
        require_once(DIR_APPLICATION."controller/payment/phpseclib/File/X509.php");
        require_once(DIR_APPLICATION."controller/payment/phpseclib/Crypt/RSA.php");
        //require_once(DIR_APPLICATION."controller/payment/phpseclib/php_rsa.php");

        $this->load->model('checkout/order');

        $order_id = $this->session->data['order_id'];

        $order_info = $this->model_checkout_order->getOrder($order_id);

        $total = $order_info['total'];

        $amount = $this->currency->format($total, $order_info['currency_code'], false, false);

        $amount = $amount * 100;

        //页面编码要与参数inputCharset一致，否则服务器收到参数值中的汉字为乱码而导致验证签名失败。
        $data['serverUrl'] = 'https://service.allinpay.com/gateway/index.do';
        $data['inputCharset'] = 1;
        $data['pickupUrl'] =  HTTPS_SERVER . 'index.php?route=checkout/success';
        $data['receiveUrl'] = HTTPS_SERVER . 'index.php?route=payment/tonglianpay/receive';
        $data['version'] = 'v1.0';
        $data['language'] = '';
        $data['signType'] = 1;
        $data['merchantId'] = $this->config->get('tonglianpay_account');
        $data['payerName'] = '';
        $data['payerEmail'] = '';
        $data['payerTelephone'] = '';
        $data['payerIDCard'] = '';
        $data['pid'] = '';
        $data['orderNo'] = $order_info['order_id'];
        $data['orderAmount'] = $amount;
        $data['orderDatetime'] = date('YmdHis');
        $data['orderCurrency'] = '';
        $data['orderExpireDatetime'] = '';
        $data['productName'] = $order_info['store_name'];
        $data['productId'] = '';
        $data['productPrice'] = '';
        $data['productNum'] = '';
        $data['productDesc'] = '';
        $data['ext1'] = '';
        $data['ext2'] = '';
        $data['extTL'] = '';
        $data['payType'] = 0; //payType   不能为空，必须放在表单中提交。
        $data['issuerId'] = ''; //issueId 直联时不为空，必须放在表单中提交。
        $data['pan'] = '';
        $data['tradeNature'] = 'GOODS';
        $data['customsExt'] = '';
        $data['key'] = $this->config->get('tonglianpay_md5key');


        // 生成签名字符串。
        $bufSignSrc = "";
        if($data['inputCharset'] != "")
            $bufSignSrc = $bufSignSrc."inputCharset=".$data['inputCharset']."&";
        if($data['pickupUrl'] != "")
            $bufSignSrc = $bufSignSrc."pickupUrl=".$data['pickupUrl']."&";
        if($data['receiveUrl'] != "")
            $bufSignSrc = $bufSignSrc."receiveUrl=".$data['receiveUrl']."&";
        if($data['version'] != "")
            $bufSignSrc = $bufSignSrc."version=".$data['version']."&";
        if($data['language'] != "")
            $bufSignSrc = $bufSignSrc."language=".$data['language']."&";
        if($data['signType'] != "")
            $bufSignSrc = $bufSignSrc."signType=".$data['signType']."&";
        if($data['merchantId'] != "")
            $bufSignSrc = $bufSignSrc."merchantId=".$data['merchantId']."&";
        if($data['payerName'] != "")
            $bufSignSrc = $bufSignSrc."payerName=".$data['payerName']."&";
        if($data['payerEmail'] != "")
            $bufSignSrc = $bufSignSrc."payerEmail=".$data['payerEmail']."&";
        if($data['payerTelephone'] != "")
            $bufSignSrc = $bufSignSrc."payerTelephone=".$data['payerTelephone']."&";

        //需要加密付款人身份证信息
        if($data['payerIDCard'] != "")
        {
            /*
            //测身份证信息认证使用商户号：20150513442
            //加密函数从php_rsa.php 调用


            $publickeyfile = './publickey.txt';
            $publickeycontent = file_get_contents($publickeyfile);

            $publickeyarray = explode(PHP_EOL, $publickeycontent);
            $publickey_arr = explode('=',$publickeyarray[0]);
            $modulus_arr = explode('=',$publickeyarray[1]);
            $publickey = trim($publickey_arr[1]);
            $modulus = trim($modulus_arr[1]);
            $keylength = 1024;
            $ciphertext = base64_encode(rsa_encrypt($payerIDCard, $publickey, $modulus, $keylength));
            */


            //测身份证信息认证使用商户号：20150513442
            //加密函数从phpseclib调用
            $certfile = file_get_contents(DIR_APPLICATION."controller/payment/phpseclib/TLCert-test.cer");
            $x509 = new File_X509();
            $cert = $x509->loadX509($certfile);
            $pubkey = $x509->getPublicKey();

            $rsa = new Crypt_RSA();
            $rsa->loadKey($pubkey);
            $rsa->setPublicKey();
            $rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
            $ciphertext = $rsa->encrypt($data['payerIDCard']);
            $ciphertext = base64_encode($ciphertext);


            $payerIDCard = $ciphertext;
            $bufSignSrc = $bufSignSrc."payerIDCard=".$payerIDCard."&";

        }

        if($data['pid'] != "")
            $bufSignSrc = $bufSignSrc."pid=".$data['pid']."&";
        if($data['orderNo'] != "")
            $bufSignSrc = $bufSignSrc."orderNo=".$data['orderNo']."&";
        if($data['orderAmount'] != "")
            $bufSignSrc = $bufSignSrc."orderAmount=".$data['orderAmount']."&";
        if($data['orderCurrency'] != "")
            $bufSignSrc = $bufSignSrc."orderCurrency=".$data['orderCurrency']."&";
        if($data['orderDatetime'] != "")
            $bufSignSrc = $bufSignSrc."orderDatetime=".$data['orderDatetime']."&";
        if($data['orderExpireDatetime'] != "")
            $bufSignSrc = $bufSignSrc."orderExpireDatetime=".$data['orderExpireDatetime']."&";
        if($data['productName'] != "")
            $bufSignSrc = $bufSignSrc."productName=".$data['productName']."&";
        if($data['productPrice'] != "")
            $bufSignSrc = $bufSignSrc."productPrice=".$data['productPrice']."&";
        if($data['productNum'] != "")
            $bufSignSrc = $bufSignSrc."productNum=".$data['productNum']."&";
        if($data['productId'] != "")
            $bufSignSrc = $bufSignSrc."productId=".$data['productId']."&";
        if($data['productDesc'] != "")
            $bufSignSrc = $bufSignSrc."productDesc=".$data['productDesc']."&";
        if($data['ext1'] != "")
            $bufSignSrc = $bufSignSrc."ext1=".$data['ext1']."&";

        //如果海关扩展字段不为空，需要做个MD5填写到ext2里
        if($data['ext2'] == "" && $data['customsExt'] != "")
        {
            $ext2 = strtoupper(md5($data['customsExt']));
            $bufSignSrc = $bufSignSrc."ext2=".$ext2."&";
        }
        else if($data['ext2'] != "")
        {
            $bufSignSrc = $bufSignSrc."ext2=".$data['ext2']."&";
        }

        if($data['extTL'] != "")
            $bufSignSrc = $bufSignSrc."extTL".$data['extTL']."&";
//        if($data['payType'] != "")
            $bufSignSrc = $bufSignSrc."payType=".$data['payType']."&";
        if($data['issuerId'] != "")
            $bufSignSrc = $bufSignSrc."issuerId=".$data['issuerId']."&";
        if($data['pan'] != "")
            $bufSignSrc = $bufSignSrc."pan=".$data['pan']."&";
        if($data['tradeNature'] != "")
            $bufSignSrc = $bufSignSrc."tradeNature=".$data['tradeNature']."&";
        $bufSignSrc = $bufSignSrc."key=".$data['key']; //key为MD5密钥，密钥是在通联支付网关商户服务网站上设置。

        //签名，设为signMsg字段值。
        $data['signMsg'] = strtoupper(md5($bufSignSrc));

        $data['bufSignSrc'] = $bufSignSrc;

        $data['button_confirm'] = $this->language->get('button_confirm');


        if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/tonglianpay.tpl')) {
            return $this->load->view($this->config->get('config_template') . '/template/payment/tonglianpay.tpl', $data);
        } else {
            return $this->load->view('default/template/payment/tonglianpay.tpl', $data);
        }

    }


    public function receive() {
        //如果需要用证书加密，使用phpseclib包
        require_once(DIR_APPLICATION."controller/payment/phpseclib/File/X509.php");
        require_once(DIR_APPLICATION."controller/payment/phpseclib/Crypt/RSA.php");

        //测试商户的key! 请修改。
        $md5key = "DamonDog2015";

        $merchantId=$_POST["merchantId"];
        $version=$_POST['version'];
        $language=$_POST['language'];
        $signType=$_POST['signType'];
        $payType=$_POST['payType'];
        $issuerId=$_POST['issuerId'];
        $paymentOrderId=$_POST['paymentOrderId'];
        $orderNo=$_POST['orderNo'];
        $orderDatetime=$_POST['orderDatetime'];
        $orderAmount=$_POST['orderAmount'];
        $payDatetime=$_POST['payDatetime'];
        $payAmount=$_POST['payAmount'];
        $ext1=$_POST['ext1'];
        $ext2=$_POST['ext2'];
        $payResult=$_POST['payResult'];
        $errorCode=$_POST['errorCode'];
        $returnDatetime=$_POST['returnDatetime'];
        $signMsg=$_POST["signMsg"];


        $bufSignSrc="";
        if($merchantId != "")
            $bufSignSrc=$bufSignSrc."merchantId=".$merchantId."&";
        if($version != "")
            $bufSignSrc=$bufSignSrc."version=".$version."&";
        if($language != "")
            $bufSignSrc=$bufSignSrc."language=".$language."&";
        if($signType != "")
            $bufSignSrc=$bufSignSrc."signType=".$signType."&";
        if($payType != "")
            $bufSignSrc=$bufSignSrc."payType=".$payType."&";
        if($issuerId != "")
            $bufSignSrc=$bufSignSrc."issuerId=".$issuerId."&";
        if($paymentOrderId != "")
            $bufSignSrc=$bufSignSrc."paymentOrderId=".$paymentOrderId."&";
        if($orderNo != "")
            $bufSignSrc=$bufSignSrc."orderNo=".$orderNo."&";
        if($orderDatetime != "")
            $bufSignSrc=$bufSignSrc."orderDatetime=".$orderDatetime."&";
        if($orderAmount != "")
            $bufSignSrc=$bufSignSrc."orderAmount=".$orderAmount."&";
        if($payDatetime != "")
            $bufSignSrc=$bufSignSrc."payDatetime=".$payDatetime."&";
        if($payAmount != "")
            $bufSignSrc=$bufSignSrc."payAmount=".$payAmount."&";
        if($ext1 != "")
            $bufSignSrc=$bufSignSrc."ext1=".$ext1."&";
        if($ext2 != "")
            $bufSignSrc=$bufSignSrc."ext2=".$ext2."&";
        if($payResult != "")
            $bufSignSrc=$bufSignSrc."payResult=".$payResult."&";
        if($errorCode != "")
            $bufSignSrc=$bufSignSrc."errorCode=".$errorCode."&";
        if($returnDatetime != "")
            $bufSignSrc=$bufSignSrc."returnDatetime=".$returnDatetime;


        //解析证书方式
        $certfile = file_get_contents(DIR_APPLICATION."controller/payment/phpseclib/TLCert-test.cer");
        $x509 = new File_X509();
        $cert = $x509->loadX509($certfile);
        $pubkey = $x509->getPublicKey();
        $rsa = new Crypt_RSA();
        $rsa->loadKey($pubkey); // public key
        $rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
        $verifyResult = $rsa->verify($bufSignSrc, base64_decode(trim($signMsg)));


        $value = null;
        if($verifyResult){
            $value = "报文验签成功！";
        }
        else{
            $value = "报文验签失败！";
        }

        //验签成功，还需要判断订单状态，为"1"表示支付成功。
        $payvalue = null;
        $pay_result = false;
        if($verifyResult and $payResult == 1){
            $pay_result = true;
            $payvalue = "报文验签成功，且订单支付成功";

            $order_info = $this->model_checkout_order->getOrder($orderNo);
            if ($order_info) {
                $order_status_id = $order_info["order_status_id"];
                // 确定订单没有重复支付
                //if ($order_status_id != $this->config->get('qrcodeweipay_order_status_id')) {
//					if (!$order_status_id) {
                if ($order_status_id <= 1) {
                    if (isset($this->session->data['bidding']) && !empty($this->session->data['bidding']))
                    {
                        $this->load->model('bidding/product');
                        $bidding = '';
                        foreach ($this->session->data['bidding'] as $key => $values)
                        {
                            $this->model_bidding_product->updateBidding($key);
                        }
                    }
                    //此处需要设置订单状态为“已付款”或“待处理”，根据具体情况定
                    $this->model_checkout_order->addOrderHistory($orderNo, $this->config->get('qrcodeweipay_order_status_id'));
                    $this->model_checkout_order->addTransaction($orderNo);
                }
            }
        }else{
            $payvalue = "报文验签成功，但订单支付失败";
        }
    }



}
?>