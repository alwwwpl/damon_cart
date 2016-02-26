<div class="pull-right">
    <form name="form2" action="<?php echo $serverUrl ?>" method="post">
        <input type="hidden" name="inputCharset" id="inputCharset" value="<?php echo $inputCharset ?>" />
        <input type="hidden" name="pickupUrl" id="pickupUrl" value="<?php echo $pickupUrl?>"/>
        <input type="hidden" name="receiveUrl" id="receiveUrl" value="<?php echo $receiveUrl?>" />
        <input type="hidden" name="version" id="version" value="<?php echo $version?>"/>
        <input type="hidden" name="language" id="language" value="<?php echo $language?>" />
        <input type="hidden" name="signType" id="signType" value="<?php echo $signType?>"/>
        <input type="hidden" name="merchantId" id="merchantId" value="<?php echo $merchantId?>" />
        <input type="hidden" name="payerName" id="payerName" value="<?php echo $payerName?>"/>
        <input type="hidden" name="payerEmail" id="payerEmail" value="<?php echo $payerEmail?>" />
        <input type="hidden" name="payerTelephone" id="payerTelephone" value="<?php echo $payerTelephone ?>" />
        <input type="hidden" name="payerIDCard" id="payerIDCard" value="<?php echo $payerIDCard ?>" />
        <input type="hidden" name="pid" id="pid" value="<?php echo $pid?>"/>
        <input type="hidden" name="orderNo" id="orderNo" value="<?php echo $orderNo?>" />
        <input type="hidden" name="orderAmount" id="orderAmount" value="<?php echo $orderAmount ?>"/>
        <input type="hidden" name="orderCurrency" id="orderCurrency" value="<?php echo $orderCurrency?>" />
        <input type="hidden" name="orderDatetime" id="orderDatetime" value="<?php echo $orderDatetime?>" />
        <input type="hidden" name="orderExpireDatetime" id="orderExpireDatetime" value="<?php echo $orderExpireDatetime ?>"/>
        <input type="hidden" name="productName" id="productName" value="<?php echo $productName?>" />
        <input type="hidden" name="productPrice" id="productPrice" value="<?php echo $productPrice?>" />
        <input type="hidden" name="productNum" id="productNum" value="<?php echo $productNum?>"/>
        <input type="hidden" name="productId" id="productId" value="<?php echo $productId?>" />
        <input type="hidden" name="productDesc" id="productDesc" value="<?php echo $productDesc?>" />
        <input type="hidden" name="ext1" id="ext1" value="<?php echo $ext1?>" />
        <input type="hidden" name="ext2" id="ext2" value="<?php echo $ext2?>" />
        <input type="hidden" name="extTL" id="extTL" value="<?php echo $extTL?>" />
        <input type="hidden" name="payType" value="<?php echo $payType?>" />
        <input type="hidden" name="issuerId" value="<?php echo $issuerId?>" />
        <input type="hidden" name="pan" value="<?php echo $pan?>" />
        <input type="hidden" name="tradeNature" value="<?php echo $tradeNature?>" />
        <input type="hidden" name="customsExt" value="<?php echo $customsExt?>" />
        <input type="hidden" name="signMsg" id="signMsg" value="<?php echo $signMsg?>" />
        <div align="center">
            <input type="submit" value="确认付款，到通联支付去啦" class="btn btn-primary"/>
        </div>
        <!--================= post 方式提交支付请求 end =====================-->
    </form>

</div>
