<?php
define(transResvered, "trans_");
define(cardResvered, "card_");
define(transResveredKey, "TranReserved");
define(signatureField, "Signature");

include 'util/common.php';
include 'util/SecssUtil.class.php';

session_start();

if ($_POST) {
    $dispatchMap = array(
        // ���ø�����������ת����ַ
        "0001" => "/chinapay_demo/page/pay/b2cPaySend.php",
        "0004" => "/chinapay_demo/page/pay/b2cPaySend.php",
        // �����˿��ת����ַ
        "0401" => "/chinapay_demo/page/refund/b2cRefundSend.php",
        // ���ò�ѯ����ת����ַ
        "0502" => "/chinapay_demo/page/query/b2cQuerySend.php"
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
                // ��װ������չ��
                $key = substr($key, strlen(transResvered));
                $transResvedJson[$key] = $value;
            } else 
                if (startWith($key, cardResvered)) {
                    // ��װ�п�������Ϣ��
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
        
        $securityPropFile = $_SERVER['DOCUMENT_ROOT'] . "/chinapay_demo/config/security.properties";
        $secssUtil->init($securityPropFile);
        $secssUtil->sign($sendMap);
        
        $sendMap[signatureField] = $secssUtil->getSign();
        $_SESSION = $sendMap;
        
        header("Location:" . $dispatchUrl);
    }
}