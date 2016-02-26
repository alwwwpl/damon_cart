<?php
$this->title = '银行卡管理';
echo $this->render('@app/views/layouts/_account_header');
?>
    <div class="w-main">
        <div class="cart-listbox">
            <?php
            if (!empty($bankCardDatas))
            {
                foreach ($bankCardDatas as $bankCard)
                {
            ?>
                    <div class="selected_addr clearfix">
                        <a href="">
                            <div class="addr_box">
                                <p class="bank-name"><?= $bankCard['bank'] ?></p>
                                <p class="bank-number"><script>document.write("<?= $bankCard['card_number'] ?>".replace(/(\d{4})(?=\d)/g,"$1"+" "))</script></p>
                            </div>
                        </a>
                        <div class="addr_list clearfix">
                            <div class="sele_addr">
                                <span class="sele_list <?= isset(Yii::$app->user->identity->bankcard_id) && Yii::$app->user->identity->bankcard_id == $bankCard['bank_card_id'] ? 'checked' : '' ?>"><input type="hidden"></span>默认银行卡
                            </div>
                            <div class="addr_ope">
                                <a href=""><span class="delete"></span>删除</a>
                                <a href="/account/bank-edit?id=<?= $bankCard['bank_card_id'] ?>"><span class="edi"></span>编辑</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
            <div class="addrbox-button">
                <a href="/account/bank-add"><button type="button" class="btn btn-add">新增</button></a>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function(){
        $(".sele_addr .sele_list").each(function() {
            $(this).bind('click',function() {
                if (!$(this).hasClass("checked")) {
                    $(this).siblings().removeClass("checked");
                    $(this).addClass("checked");
                } else {
                    $(this).removeClass("checked");
                }
            });
        });

    });
</script>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>