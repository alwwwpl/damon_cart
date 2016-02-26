<?php
session_start();

if ($_POST) {
    
    $dispatchMap = array(
        // ���ø�����������ת����ַ
        "0001" => "/chinapay_demo/page/pay/b2cPayResult.php",
        // �����˿��ת����ַ
        "0401" => "/chinapay_demo/page/refund/b2cRefundResult.php",
        // ���ò�ѯ����ת����ַ
        "0502" => "/chinapay_demo/page/query/b2cQueryResult.php"
    );
    
    if (count($_POST) > 0) {
        if ($_POST['TranType'] && trim($_POST['TranType']) != "") {
            $dispatchUrl = $dispatchMap[$_POST['TranType']];
        } else {
            $dispatchUrl = $dispatchMap['0001'];
        }
        
        include 'util/common.php';
        include 'util/SecssUtil.class.php';
        
        $secssUtil = new SecssUtil();
        $securityPropFile = $_SERVER['DOCUMENT_ROOT'] . "/chinapay_demo/config/security.properties";
        $secssUtil->init($securityPropFile);
        $_SESSION = $_POST;
        if ($secssUtil->verify($_POST)) {
            $_SESSION["VERIFY_KEY"] = "success";
        } else {
            $_SESSION["VERIFY_KEY"] = "fail";
        }
        
        header("Location:" . $dispatchUrl);
    }
}