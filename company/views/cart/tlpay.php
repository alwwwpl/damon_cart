<?php
/**
 * Created by PhpStorm.
 * User: sucjun
 * Date: 15/12/31
 * Time: 10:57
 */

//如果需要用证书加密，使用phpseclib包

Yii::$app->session->open();

include_once("../vendor/phpseclib/File/X509.php");
include_once("../vendor/phpseclib/Crypt/RSA.php");


$productname = $_SESSION['ProductName'];

$total = $_SESSION['total'];

$orderid = $_SESSION['OrderId'];

//页面编码要与参数inputCharset一致，否则服务器收到参数值中的汉字为乱码而导致验证签名失败。
$data['serverUrl'] = 'https://service.allinpay.com/gateway/index.do';
$data['inputCharset'] = 1;
$data['pickupUrl'] =  'http://wap.iddmall.com/cart/success';
$data['receiveUrl'] = 'http://wap.iddmall.com/cart/tl-receive';
$data['version'] = 'v1.0';
$data['language'] = '';
$data['signType'] = 1;
$data['merchantId'] = '109045511511001';
$data['payerName'] = '';
$data['payerEmail'] = '';
$data['payerTelephone'] = '';
$data['payerIDCard'] = '';
$data['pid'] = '';
$data['orderNo'] = $orderid;
$data['orderAmount'] = $total;
$data['orderDatetime'] = date('YmdHis');
$data['orderCurrency'] = '';
$data['orderExpireDatetime'] = '';
$data['productName'] = $productname;
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
$data['key'] = 'DamonDog2015';


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
    $certfile = file_get_contents("../vendor/phpseclib/TLCert-test.cer");
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

?>

<div class="pull-right">
    <form name="form2" action="<?php echo $data['serverUrl'] ?>" method="post" id="tlpay">
        <input type="hidden" name="inputCharset" id="inputCharset" value="<?php echo $data['inputCharset'] ?>" />
        <input type="hidden" name="pickupUrl" id="pickupUrl" value="<?php echo $data['pickupUrl']?>"/>
        <input type="hidden" name="receiveUrl" id="receiveUrl" value="<?php echo $data['receiveUrl']?>" />
        <input type="hidden" name="version" id="version" value="<?php echo $data['version']?>"/>
        <input type="hidden" name="language" id="language" value="<?php echo $data['language']?>" />
        <input type="hidden" name="signType" id="signType" value="<?php echo $data['signType']?>"/>
        <input type="hidden" name="merchantId" id="merchantId" value="<?php echo $data['merchantId']?>" />
        <input type="hidden" name="payerName" id="payerName" value="<?php echo $data['payerName']?>"/>
        <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $data['payerEmail']?>" />
        <input type="hidden" name="payerTelephone" id="payerTelephone" value="<?php echo $data['payerTelephone'] ?>" />
        <input type="hidden" name="payerIDCard" id="payerIDCard" value="<?php echo $data['payerIDCard'] ?>" />
        <input type="hidden" name="pid" id="pid" value="<?php echo $data['pid']?>"/>
        <input type="hidden" name="orderNo" id="orderNo" value="<?php echo $data['orderNo']?>" />
        <input type="hidden" name="orderAmount" id="orderAmount" value="<?php echo $data['orderAmount'] ?>"/>
        <input type="hidden" name="orderCurrency" id="orderCurrency" value="<?php echo $data['orderCurrency']?>" />
        <input type="hidden" name="orderDatetime" id="orderDatetime" value="<?php echo $data['orderDatetime']?>" />
        <input type="hidden" name="orderExpireDatetime" id="orderExpireDatetime" value="<?php echo $data['orderExpireDatetime'] ?>"/>
        <input type="hidden" name="productName" id="productName" value="<?php echo $data['productName']?>" />
        <input type="hidden" name="productPrice" id="productPrice" value="<?php echo $data['productPrice']?>" />
        <input type="hidden" name="productNum" id="productNum" value="<?php echo $data['productNum']?>"/>
        <input type="hidden" name="productId" id="productId" value="<?php echo $data['productId']?>" />
        <input type="hidden" name="productDesc" id="productDesc" value="<?php echo $data['productDesc']?>" />
        <input type="hidden" name="ext1" id="ext1" value="<?php echo $data['ext1']?>" />
        <input type="hidden" name="ext2" id="ext2" value="<?php echo $data['ext2']?>" />
        <input type="hidden" name="extTL" id="extTL" value="<?php echo $data['extTL']?>" />
        <input type="hidden" name="payType" value="<?php echo $data['payType']?>" />
        <input type="hidden" name="issuerId" value="<?php echo $data['issuerId']?>" />
        <input type="hidden" name="pan" value="<?php echo $data['pan']?>" />
        <input type="hidden" name="tradeNature" value="<?php echo $data['tradeNature']?>" />
        <input type="hidden" name="customsExt" value="<?php echo $data['customsExt']?>" />
        <input type="hidden" name="signMsg" id="signMsg" value="<?php echo $data['signMsg']?>" />
    </form>
</div>
<script type="text/javascript">
    $('#tlpay').submit();
</script>
