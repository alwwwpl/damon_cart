<?php

/**
 * Created by PhpStorm.
 * User: sucjun
 * Date: 15/12/27
 * Time: 21:41
 */

include_once("../vendor/WxPayPubHelper/log_.php");
include_once("../vendor/WxPayPubHelper/WxPayPubHelper.php");

//使用通用通知接口
$notify = new Notify_pub();

//存储微信的回调
$xml = $GLOBALS['HTTP_RAW_POST_DATA'];
$notify->saveData($xml);



//验证签名，并回应微信。
//对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
//微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
//尽可能提高通知的成功率，但微信不保证通知最终能成功。

if($notify->checkSign() == FALSE){
    $notify->setReturnParameter("return_code","FAIL");//返回状态码
    $notify->setReturnParameter("return_msg","签名失败");//返回信息
}else{
    $notify->setReturnParameter("return_code","SUCCESS");//设置返回码
}
$returnXml = $notify->returnXml();
echo $returnXml;

//以log文件形式记录回调信息
$log_ = new Log_();
$log_name="./notify_url.log";//log文件路径
//$log_name="../vendor/WxpayPubHelper/notify_url.log";//log文件路径
$log_->log_result($log_name,"【接收到的notify通知】:\n".$xml."\n");


//==商户根据实际情况设置相应的处理流程，此处仅作举例=======


if($notify->checkSign() == TRUE)
{
    if ($notify->data["return_code"] == "FAIL") {
        //此处应该更新一下订单状态，商户自行增删操作
                $log_->log_result($log_name,"【通信出错】:\n".$xml."\n");
    }
    elseif($notify->data["result_code"] == "FAIL"){
        //此处应该更新一下订单状态，商户自行增删操作
                $log_->log_result($log_name,"【业务出错】:\n".$xml."\n");
    }
    else{
        //此处应该更新一下订单状态，商户自行增删操作
        $OrderIds = explode('_', substr(substr($notify->data["out_trade_no"], 0, -4),4));
        if (is_array($OrderIds))
        {
            foreach($OrderIds as $OrderId)
            {
                $model = \app\models\Order::find()->andWhere(['order_id' => $OrderId])->one();

                $model->order_status_id = 2;

                $model->save();
            }
        }


                $log_->log_result($log_name,"【支付成功】:\n".$xml."\n");
    }

    //商户自行增加处理流程,
    //例如：更新订单状态
    //例如：数据库操作
    //例如：推送支付完成信息
}