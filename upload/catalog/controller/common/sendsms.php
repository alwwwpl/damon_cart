<?php
include_once("./restsdk/CCPRestSDK.php");
class ControllerCommonSendsms extends Controller {

    public function index() {
        $this->sendTemplateSMS('13916749985',null,1);
    }

    /**
     * 发送模板短信
     * @param to 手机号码集合,用英文逗号分开
     * @param datas 内容数据 格式为数组 例如：array('Marry','Alon')，如不需替换请填 null
     * @param $tempId 模板Id
     */
    public function sendTemplateSMS($to,$datas,$tempId)
    {
        $accountSid = 'aaf98f89506fc2f001507e08f7de0ab8';

        $accountToken = '4bf16fef5d80423cbef177c54ce3a37e';

        $appId = '8a48b551506fd26f01507e095f291f3b';

        $serverIP ='sandboxapp.cloopen.com';

        $serverPort ='8883';

        $softVersion ='2013-12-26';

        // 初始化REST SDK
        //global $accountSid,$accountToken,$appId,$serverIP,$serverPort,$softVersion;
        $rest = new REST($serverIP,$serverPort,$softVersion);
        $rest->setAccount($accountSid,$accountToken);
        $rest->setAppId($appId);

        // 发送模板短信
        echo "Sending TemplateSMS to $to <br/>";
        $result = $rest->sendTemplateSMS($to,$datas,$tempId);
        if($result == NULL ) {
            echo "result error!";
            break;
        }
        if($result->statusCode!=0) {
            echo "error code :" . $result->statusCode . "<br>";
            echo "error msg :" . $result->statusMsg . "<br>";
            //TODO 添加错误处理逻辑
        }else{
            echo "Sendind TemplateSMS success!<br/>";
            // 获取返回信息
            $smsmessage = $result->TemplateSMS;
            echo "dateCreated:".$smsmessage->dateCreated."<br/>";
            echo "smsMessageSid:".$smsmessage->smsMessageSid."<br/>";
            //TODO 添加成功处理逻辑
        }
    }
}

//Demo调用,参数填入正确后，放开注释可以调用
//sendTemplateSMS("手机号码","内容数据","模板Id");
?>
