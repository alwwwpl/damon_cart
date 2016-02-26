<?php
if ($_POST) {
    if (count($_POST) > 0) {
        Yii::$app->session->open();
        include_once("../vendor/chinapay/util/common.php");
        include_once("../vendor/chinapay/util/SecssUtil.class.php");

        $secssUtil = new SecssUtil();
        $securityPropFile = $_SERVER['DOCUMENT_ROOT'] . "/../vendor/chinapay/config/security.properties";
        $secssUtil->init($securityPropFile);

        $text = array();
        foreach($_POST as $key=>$value){
            $text[$key] = urldecode($value);
        }

        if ($secssUtil->verify($text)) {
            $_SESSION["VERIFY_KEY"] = "success";
        } else {
            $_SESSION["VERIFY_KEY"] = "fail";
        }
    }
}