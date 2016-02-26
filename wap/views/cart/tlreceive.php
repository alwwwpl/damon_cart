<?php
/**
 * Created by PhpStorm.
 * User: sucjun
 * Date: 15/12/31
 * Time: 11:16
 */
Yii::$app->session->open();
//如果需要用证书加密，使用phpseclib包
include_once("../vendor/phpseclib/File/X509.php");
include_once("../vendor/phpseclib/Crypt/RSA.php");

//测试商户的key! 请修改。
$md5key = "DamonDog2015";

$merchantId = $_POST["merchantId"];

$version = $_POST['version'];

$language = $_POST['language'];

$signType = $_POST['signType'];

$payType = $_POST['payType'];

$issuerId = $_POST['issuerId'];

$paymentOrderId = $_POST['paymentOrderId'];

$orderNo = $_POST['orderNo'];

$orderDatetime = $_POST['orderDatetime'];

$orderAmount = $_POST['orderAmount'];

$payDatetime = $_POST['payDatetime'];

$payAmount = $_POST['payAmount'];

$ext1 = $_POST['ext1'];

$ext2 = $_POST['ext2'];

$payResult = $_POST['payResult'];

$errorCode = $_POST['errorCode'];

$returnDatetime = $_POST['returnDatetime'];

$signMsg = $_POST["signMsg"];


$bufSignSrc="";

if($merchantId != "")
{
    $bufSignSrc = $bufSignSrc."merchantId=".$merchantId."&";
}
if($version != "")
{
    $bufSignSrc = $bufSignSrc."version=".$version."&";
}
if($language != "")
{
    $bufSignSrc = $bufSignSrc."language=".$language."&";
}
if($signType != "")
{
    $bufSignSrc = $bufSignSrc."signType=".$signType."&";
}
if($payType != "")
{
    $bufSignSrc = $bufSignSrc."payType=".$payType."&";
}
if($issuerId != "")
{
    $bufSignSrc = $bufSignSrc."issuerId=".$issuerId."&";
}
if($paymentOrderId != "")
{
    $bufSignSrc = $bufSignSrc."paymentOrderId=".$paymentOrderId."&";
}
if($orderNo != "")
{
    $bufSignSrc = $bufSignSrc."orderNo=".$orderNo."&";
}
if($orderDatetime != "")
{
    $bufSignSrc = $bufSignSrc."orderDatetime=".$orderDatetime."&";
}
if($orderAmount != "")
{
    $bufSignSrc = $bufSignSrc."orderAmount=".$orderAmount."&";
}
if($payDatetime != "")
{
    $bufSignSrc = $bufSignSrc."payDatetime=".$payDatetime."&";
}
if($payAmount != "")
{
    $bufSignSrc = $bufSignSrc."payAmount=".$payAmount."&";
}
if($ext1 != "")
{
    $bufSignSrc = $bufSignSrc."ext1=".$ext1."&";
}
if($ext2 != "")
{
    $bufSignSrc = $bufSignSrc."ext2=".$ext2."&";
}
if($payResult != "")
{
    $bufSignSrc = $bufSignSrc."payResult=".$payResult."&";
}
if($errorCode != "")
{
    $bufSignSrc = $bufSignSrc."errorCode=".$errorCode."&";
}
if($returnDatetime != "")
{
    $bufSignSrc = $bufSignSrc."returnDatetime=".$returnDatetime;
}

//
////解析证书方式
//$certfile = file_get_contents("../vendor/phpseclib/TLCert-test.cer");
//
//$x509 = new File_X509();
//
//$cert = $x509->loadX509($certfile);
//
//$pubkey = $x509->getPublicKey();
//
//$rsa = new Crypt_RSA();
//
//$rsa->loadKey($pubkey); // public key
//
//$rsa->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
//
//$verifyResult = $rsa->verify($bufSignSrc, base64_decode(trim($signMsg)));
//
//
//$value = null;
//
//if($verifyResult)
//{
//    $value = "报文验签成功！";
//}
//else
//{
//    $value = "报文验签失败！";
//}

//验签成功，还需要判断订单状态，为"1"表示支付成功。
$payvalue = null;

$pay_result = false;

//if($verifyResult and $payResult == 1)
if($payResult == 1)
{
    $pay_result = true;
    $payvalue = "报文验签成功，且订单支付成功";


    $OrderIds = explode('_', substr(substr($orderNo, 0, -4),4));
    if (is_array($OrderIds))
    {
        foreach($OrderIds as $OrderId)
        {
            $model = \app\models\Order::find()->andWhere(['order_id' => $OrderId])->one();

            $model->order_status_id = 2;

            $model->save();
        }
    }
}
else
{
    $payvalue = "报文验签成功，但订单支付失败";
}