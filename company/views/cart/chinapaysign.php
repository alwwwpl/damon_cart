<?php
defined('transResvered') or define('transResvered', 'trans_');
defined('cardResvered') or define('cardResvered', 'card_');
defined('transResveredKey') or define('transResveredKey', 'TranReserved');
defined('signatureField') or define('signatureField', 'Signature');

include_once("../vendor/chinapay/util/common.php");
include_once("../vendor/chinapay/util/SecssUtil.class.php");

Yii::$app->session->open();

if ($_POST) {
    $dispatchMap = array(
        // 配置个人网银交易转发地址
        "0001" => "/cart/china-pay-send",
        "0004" => "/cart/china-pay-send",
        // 配置退款交易转发地址
        "0401" => "../vendor/chinapay/page/refund/b2cRefundSend.php",
        // 配置查询交易转发地址
        "0502" => "../vendor/chinapay/page/query/b2cQuerySend.php"
    );
    if (count($_POST) > 0) {
        if ($_POST['TranType'] && trim($_POST['TranType']) != "") {
            $dispatchUrl = $dispatchMap[$_POST['TranType']];
        } else {
            $dispatchUrl = $dispatchMap['0001'];
        }
        $transResvedJson = array();
        $cardInfoJson = array();
        $sendMap = array();
        foreach ($_POST as $key => $value) {
            if (isEmpty($value)) {
                continue;
            }
            if (startWith($key, transResvered)) {
                // 组装交易扩展域
                $key = substr($key, strlen(transResvered));
                $transResvedJson[$key] = $value;
            } else
                if (startWith($key, cardResvered)) {
                    // 组装有卡交易信息域
                    $key = substr($key, strlen(cardResvered));
                    $cardInfoJson[$key] = $value;
                } else {
                    $sendMap[$key] = $value;
                }
        }
        $transResvedStr = null;
        $cardResvedStr = null;
        if (count($transResvedJson) > 0) {
            $transResvedStr = json_encode($transResvedJson);
        }
        if (count($cardInfoJson) > 0) {
            $cardResvedStr = json_encode($cardInfoJson);
        }

        $secssUtil = new SecssUtil();

        if (! isEmpty($transResvedStr)) {
            $transResvedStr = $secssUtil->decryptData($transResvedStr);
            $sendMap[transResveredKey] = $transResvedStr;
        }
        if (! isEmpty($cardResvedStr)) {
            $cardResvedStr = $secssUtil->decryptData($cardResvedStr);
            $sendMap[cardResveredKey] = $cardResvedStr;
        }

        $securityPropFile = $_SERVER['DOCUMENT_ROOT'] . "/../vendor/chinapay/config/security.properties";
        $secssUtil->init($securityPropFile);
        $secssUtil->sign($sendMap);

        $sendMap[signatureField] = $secssUtil->getSign();
        $_SESSION['chinapay'] = $sendMap;
        echo '<script>';
        echo 'location.href = "http://wap.iddmall.com'.$dispatchUrl.'"';
        echo '</script>';
//        header("Location:" . $dispatchUrl);
    }
}