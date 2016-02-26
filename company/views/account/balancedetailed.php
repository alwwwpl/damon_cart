<?php
$this->title = '收支明细';
echo $this->render('@app/views/layouts/_account_header');
?>
    <div class="js_lib_content">
        <div class="payment-details">
            <ul class="payment-details-all">
                <?php
                if (!empty($transactionDatas))
                {
                    foreach ($transactionDatas as $transaction)
                    {
                        if ($transaction['amount'] >= 0)
                        {
                ?>
                            <li>
                                <div class="left_number">
                                    <p>流水号:  <?= date('YmdHis', strtotime($transaction['date_added'])).$transaction['customer_transaction_id'] ?></p>
                                    <p>订单号:  <?= $transaction['order_id'] + 131311921 .date('YmdHis', strtotime($transaction['date_added'])) ?></p>
                                </div>
                                <img style="width: 100px;" src="<?php echo Yii::$app->request->baseUrl; ?>/images/goubuypng.png">
                                <div class="right_content">
                                    <p><?= $transaction['description'] ?></p>
                                    <p class="g-number"><?= round($transaction['amount'], 2) ?></p>
                                    <p><?= date('m月d日',strtotime($transaction['date_added'])) ?></p>
                                </div>
                            </li>
                <?php
                        }
                        else
                        {
                ?>
                            <li>
                                <div class="left_number">
                                    <p>流水号:  <?= date('YmdHis', strtotime($transaction['date_added'])).$transaction['customer_transaction_id'] ?></p>
                                    <p>订单号:  <?= $transaction['order_id'] + 131311921 .date('YmdHis', strtotime($transaction['date_added'])) ?></p>
                                </div>
                                <img style="width: 100px;" src="<?php echo Yii::$app->request->baseUrl; ?>/images/tixianpng.png">
                                <div class="right_content">
                                    <p><?= $transaction['description'] ?></p>
                                    <p class="g-number"><?= round($transaction['amount'], 2) ?></p>
                                    <p><?= date('m月d日',strtotime($transaction['date_added'])) ?></p>
                                </div>
                            </li>
                <?php
                        }
                    }
                }
                ?>
                <!--<li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/tixianpng.png">
                    <div class="right_content">
                        <p>提现</p>
                        <p class="total-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>
                <li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/goubuypng.png">
                    <div class="right_content">
                        <p>购买</p>
                        <p class="g-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>
                <li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/tixianpng.png">
                    <div class="right_content">
                        <p>提现</p>
                        <p class="total-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>
                <li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/goubuypng.png">
                    <div class="right_content">
                        <p>购买</p>
                        <p class="g-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>
                <li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/tixianpng.png">
                    <div class="right_content">
                        <p>提现</p>
                        <p class="total-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>
                <li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/goubuypng.png">
                    <div class="right_content">
                        <p>购买</p>
                        <p class="g-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>
                <li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/tixianpng.png">
                    <div class="right_content">
                        <p>提现</p>
                        <p class="total-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>
                <li>
                    <div class="left_number">
                        <p>流水号:  31234165413131313131</p>
                        <p>订单号:  12345678901234567890</p>
                    </div>
                    <img src="<?php echo Yii::$app->request->baseUrl; ?>/images/goubuypng.png">
                    <div class="right_content">
                        <p>购买</p>
                        <p class="g-number">799.00</p>
                        <p>12月05日</p>
                    </div>
                </li>-->
            </ul>
        </div>
    </div>
<script>
    $(document).ready(function() {
        $(".h-title").each(function(){
            $(this).bind('click',function(){
                $(this).next().toggle();
                $(this).find('i').toggleClass('up');
            })
        })
    })
</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>