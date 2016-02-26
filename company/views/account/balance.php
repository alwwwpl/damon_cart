<?php
$this->title = '帐户余额';
echo $this->render('@app/views/layouts/_account_header');
?>
    <div class="js_lib_content">
        <div class="balance-ac clearfix">
            <div class="h-title">
                <a href="">
                    <em></em>余额转出<span>提现<i class="r-ico"></i></span>
                </a>
            </div>
            <div class="h-title">
                <a href="">
                    <em></em>收支明细<span><i class="r-ico"></i></span>
                </a>
            </div>
        </div>
    </div>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>