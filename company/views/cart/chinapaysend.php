<?php
header('Content-Type:text/html;charset=utf-8 ');
Yii::$app->session->open();
include_once("../vendor/chinapay/util/Settings_INI.php");
$settings = new Settings_INI();
$settings->load($_SERVER['DOCUMENT_ROOT'] . "/../vendor/chinapay/config/security.properties");
$pay_url = $settings->get("pay_url");
?>
    <form name="payment" action="https://payment.chinapay.com/CTITS/service/rest/page/nref/000000000017/0/0/0/0/0" method="POST" style="display: none;">
        <table border="1" cellpadding="2" cellspacing="0"
               style="border-collapse: collapse" bordercolor="#111111">
            <tr>
                <td width="200px"><font color=red>*</font>商户号</td>

                <td width="800px">
                    <?php echo isset($_SESSION['MerId']) ? $_SESSION['MerId'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red>*</font>订单号</td>

                <td>
                    <?php echo isset($_SESSION['MerOrderNo']) ? $_SESSION['MerOrderNo'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red>*</font>订单金额</td>

                <td>
                    <?php echo isset($_SESSION['OrderAmt']) ? $_SESSION['OrderAmt'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red>*</font>交易日期</td>

                <td>
                    <?php echo isset($_SESSION['TranDate']) ? $_SESSION['TranDate'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red>*</font>交易时间</td>

                <td>
                    <?php echo isset($_SESSION['TranTime']) ? $_SESSION['TranTime'] : '';?>
                </td>
            </tr>
            <tr>
                <td>交易类型</td>

                <td>
                    <?php echo isset($_SESSION['TranType']) ? $_SESSION['TranType'] : '';?>
                </td>
            </tr>

            <tr>
                <td><font color=red>*</font>业务类型</td>

                <td>
                    <?php echo isset($_SESSION['BusiType']) ? $_SESSION['BusiType'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red>*</font>版本号</td>

                <td>
                    <?php echo isset($_SESSION['Version']) ? $_SESSION['Version'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red></font>支付超时时间</td>

                <td>
                    <?php echo isset($_SESSION['PayTimeOut']) ? $_SESSION['PayTimeOut'] : ''; ?>
                </td>
            </tr>

            <tr>
                <td>分账类型</td>

                <td>
                    <?php echo isset($_SESSION['SplitType']) ? $_SESSION['SplitType'] : '';?>
                </td>
            </tr>
            <tr>
                <td>分账方式</td>

                <td>
                    <?php echo isset($_SESSION['SplitMethod']) ? $_SESSION['SplitMethod'] : '';?>
                </td>
            </tr>
            <tr>
                <td>分账公式</td>

                <td>
                    <?php echo isset($_SESSION['MerSplitMsg']) ? $_SESSION['MerSplitMsg'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red></font>支付机构号</td>

                <td>
                    <?php echo isset($_SESSION['BankInstNo']) ? $_SESSION['BankInstNo'] : '';?>
                </td>
            </tr>

            <tr>
                <td><font color=red></font>商户系统时间戳</td>

                <td>
                    <?php echo isset($_SESSION['TimeStamp']) ? $_SESSION['TimeStamp'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red></font>商户客户端IP</td>

                <td>
                    <?php echo isset($_SESSION['RemoteAddr']) ? $_SESSION['RemoteAddr'] : '';?>
                </td>
            </tr>

            <tr>
                <td><font color=red></font>交易币种</td>

                <td>
                    <?php echo isset($_SESSION['CurryNo']) ? $_SESSION['CurryNo'] : '';?>
                </td>
            </tr>

            <tr>
                <td>接入类型</td>

                <td>
                    <?php echo isset($_SESSION['AccessType']) ? $_SESSION['AccessType'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red></font>收单机构号</td>

                <td>
                    <?php echo isset($_SESSION['AcqCode']) ? $_SESSION['AcqCode'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red></font>商品信息描述</td>

                <td>
                    <?php echo isset($_SESSION['CommodityMsg']) ? $_SESSION['CommodityMsg'] : '';?>
                </td>
            </tr>

            <tr>
                <td>页面应答接收URL</td>

                <td>
                    <?php echo isset($_SESSION['MerPageUrl']) ? $_SESSION['MerPageUrl'] : '';?>
                </td>
            </tr>
            <tr>
                <td><font color=red></font>后台应答接收URL</td>

                <td>
                    <?php echo isset($_SESSION['MerBgUrl']) ? $_SESSION['MerBgUrl'] : '';?>
                </td>
            </tr>
            <tr>
                <td>商户私有域</td>

                <td>
                    <?php echo isset($_SESSION['MerResv']) ? $_SESSION['MerResv'] : '';?>
                </td>
            </tr>
            <tr>
                <td>交易扩展域</td>

                <td>
                    <?php echo isset($_SESSION['TranReserved']) ? $_SESSION['TranReserved'] : '';?>
                </td>
            </tr>
            <tr>
                <td>有卡交易信息域</td>

                <td>
                    <?php echo isset($_SESSION['CardTranData']) ? $_SESSION['CardTranData'] : '';?>
                </td>
            </tr>
            <tr>
                <td>签名信息</td>

                <td>
                    <?php echo isset($_SESSION['Signature']) ? $_SESSION['Signature'] : '';?>
                </td>
            </tr>
        </table>
        <hr>
        <?php
        $params = "TranReserved;MerId;MerOrderNo;OrderAmt;CurryNo;TranDate;SplitMethod;BusiType;MerPageUrl;MerBgUrl;SplitType;MerSplitMsg;PayTimeOut;MerResv;Version;BankInstNo;CommodityMsg;Signature;AccessType;AcqCode;OrderExpiryTime;TranType;RemoteAddr;Referred;TranTime;TimeStamp;CardTranData";
        foreach ($_SESSION['chinapay'] as $k => $v) {
            if (strstr($params, $k)) {
                echo "<input type='hidden' name = '" . $k . "' value ='" . $v . "'/>";
            }
        }
        ?>
    </form>
    <script language=JavaScript>
        document.payment.submit();
    </script>
<?php
unset($_SESSION['chinapay']);
//session_destroy();
?>