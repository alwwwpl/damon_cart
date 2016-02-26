<?php

Yii::$app->session->open();

if ($_POST) {

    $dispatchMap = array(
        // 配置个人网银交易转发地址
        "0001" => "/cart/success",
        // 配置退款交易转发地址
        "0401" => "../vendor/chinapay/page/refund/b2cRefundResult.php",
        // 配置查询交易转发地址
        "0502" => "../vendor/chinapay/page/query/b2cQueryResult.php"
    );

    if (count($_POST) > 0) {
        if ($_POST['TranType'] && trim($_POST['TranType']) != "") {
            $dispatchUrl = $dispatchMap[$_POST['TranType']];
        } else {
            $dispatchUrl = $dispatchMap['0001'];
        }


        include_once("../vendor/chinapay/util/common.php");
        include_once("../vendor/chinapay/util/SecssUtil.class.php");

        $secssUtil = new SecssUtil();
        $securityPropFile = $_SERVER['DOCUMENT_ROOT'] . "/../vendor/chinapay/config/security.properties";
        $secssUtil->init($securityPropFile);
        $_SESSION['chinapay'] = $_POST;
        if ($secssUtil->verify($_POST)) {
            $OrderId = $_SESSION['chinapay_'.$_POST['MerOrderNo']];
            $OrderIds = explode('_', substr(substr($OrderId, 0, -4),4));

            if (is_array($OrderIds))
            {
                foreach($OrderIds as $OrderId)
                {
                    $model = \app\models\Order::find()->andWhere(['order_id' => $OrderId])->one();

                    $model->order_status_id = 2;

                    $model->save();
                }
            }
            $_SESSION["VERIFY_KEY"] = "success";
        } else {
            $_SESSION["VERIFY_KEY"] = "fail";
        }
        echo '<script>';
        echo 'location.href = "http://wap.iddmall.com'.$dispatchUrl.'"';
        echo '</script>';
//        header("Location:" . $dispatchUrl);
    }
}