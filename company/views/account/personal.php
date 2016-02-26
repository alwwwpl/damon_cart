<?php
$this->title = '个人资料';
echo $this->render('@app/views/layouts/_account_header');
?>
    <div class="w-main">
        <div class="eidt-personal">
            <div class="cai-order clearfix per-img">
                <div class="h-title">
                    <a href="">
                        头像<span class="my-img">
                            <img src="<?= $customerData['custom_field'] ? $customerData['custom_field'] : Yii::$app->request->baseUrl.'/data/user_logo.jpg';?>">
                        </span><!-- <span><i class="r-ico"></i></span> -->
                    </a>
                </div>
            </div>
            <div class="cai-order clearfix">
                <div class="h-title">
                    <a>
                        姓名<span><?= $customerData['lastname']; ?></span>
                    </a>
                </div>
            </div>
            <div class="cai-order clearfix">
                <div class="h-title">
                    <a>
                        地区<span><?= $customerData['province'].' '.$customerData['city']; ?></span>
                    </a>
                </div>
            </div>
            <div class="cai-order clearfix">
                <div class="h-title">
                    <a href="/account/address">
                        收货地址管理<span><i class="r-ico"></i></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php
echo $this->render('@app/views/layouts/_account_footer');
?>