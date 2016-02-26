<?php
$this->title = '提现';
Yii::$app->session->open();
echo $this->render('@app/views/layouts/_account_header');
?>
    <div class="w-main">
        <div class="cart-listbox">
            <div class="selected_addr clearfix">
                <?php
                if (!empty($cardDatas))
                {
                    $bank_card_id = Yii::$app->user->identity->bank_card_id;

                    foreach ($cardDatas as $cardData)
                    {
                        if ($bank_card_id > 0 && $cardData['bank_card_id'] == $bank_card_id)
                        {
                            echo '<a href="javascript:" data-card="'.$cardData['bank_card_id'].'">';
                            echo '<div class="addr_box f-left">';
                            echo '<p class="bank-name">'.$cardData['bank'].' '.$cardData['subbranch'].'</p>';
                            echo '<p class="bank-number"><script>document.write("'.$cardData['card_number'].'".replace(/(\d{4})(?=\d)/g,"$1"+" "))</script></p>';
                            echo '</div>';
                            echo '<i class="down-ico"></i>';
                            echo '</a>';

                            $_SESSION['bank_card_id'] = $bank_card_id;

                            exit;
                        }
                    }

                    if (empty($_SESSION['bank_card_id']))
                    {
                        echo '<a href="javascript:">';
                        echo '<div class="addr_box f-left">';
                        echo '<p class="bank-name">'.$cardData['bank'].' '.$cardData['subbranch'].'</p>';
                        echo '<p class="bank-number"><script>document.write("'.$cardData['card_number'].'".replace(/(\d{4})(?=\d)/g,"$1"+" "))</script></p>';
                        echo '</div>';
                        echo '<i class="down-ico"></i>';
                        echo '</a>';
                    }
                }
                ?>
                <!--<a href="javascript:">
                    <div class="addr_box f-left">
                        <p class="bank-name">徽商银行  潜山路支行</p>
                        <p class="bank-number">1236  1565  5454  8794  454</p>
                    </div>
                    <i class="down-ico"></i>
                </a>-->
            </div>
            <div class="shipper-bankchecked clearfix">
                <?php
                if (!empty($cardDatas))
                {
                 foreach ($cardDatas as $cardData)
                 {
                     echo '<a href="javascript:">';
                     echo '<div class="addr_box f-left">';
                     echo '<p class="bank-name">'.$cardData['bank'].' '.$cardData['subbranch'].'</p>';
                     echo '<p class="bank-number"><script>document.write("'.$cardData['card_number'].'".replace(/(\d{4})(?=\d)/g,"$1"+" "))</script></p>';
                     echo '</div>';
                     echo '<i class="down-ico"></i>';
                     echo '</a>';
                 }
                }
                ?>
            </div>
            <form id="ti-form" action="" method="post">
                <div class="item item-withzhuan clearfix">
                    <span>可提金额</span><input type="text" value="<?= $cash ?>" name="zhuan-number" placeholder="50" class="txt-input txt-zhuan-number ciphertext" disabled>
                </div>
                <br>
                <div class="item item-withdrawal clearfix">
                    <span>提现金额</span><input type="number" name="drawal-number" placeholder="请输入提现金额" class="txt-input txt-drawal-number ciphertext">
                </div>
                <div class="item item-password clearfix">
                    <span>支付密码</span><input type="password" name="pay-password" placeholder="请输入支付密码" class="txt-input txt-paypassword ciphertext" id="password">
                </div>
                <div class="addrbox-button">
                    <button type="button" class="btn btn-add">确认</button>
                </div>
            </form>
            <script>
                $(document).ready(function() {
                    $(".selected_addr").click(function() {
                        $(".shipper-bankchecked").toggle();
                        $(this).find('i').toggleClass('up');
                    });
                    $(".shipper-bankchecked a").each(function(){
                        $(this).bind('click',function(){
                            $(this).parent().prev().empty().append($(this).clone());
                            $(this).parent().hide();
                            $(this).parent().prev().find('i').removeClass('up');
                        })
                    });




                });
            </script>
        </div>
    </div>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>