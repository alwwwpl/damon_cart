<div id="totop"><a class="cur"><span></span></a></div>
<div class="com-content">
    <div class="js_lib_content">
        <div class="top">
            <div class="top-area"><a href=""><img src="<?php echo Yii::$app->request->baseUrl;?>/images/top_area.png"></a>
                <div class="loi">合肥</div>
            </div>
            <div class="search">
                <img class="icon_search" src="<?php echo Yii::$app->request->baseUrl;?>/images/top-searchpng.png">
                <form method="get" action="/product/search">
                    <input type="text" maxlength="128" value="<?= Yii::$app->request->get('search') ?>" autocomplete="off" placeholder="至宝母婴" class="search_input input_text" id="search" name="search">
                </form>
            </div>
            <div class="top-info">
                <!--<a href="http://wx99610dc3355e3524.m.weimob.com/Weisite/Home?pid=55681479&bid=1002181&wechatid=fromUsername">-->
                <!-- http://wpa.qq.com/msgrd?v=3&uin=3096669723&site=qq&menu=yes -->
                <a href="#">
                    <img src="<?php echo Yii::$app->request->baseUrl;?>/images/top-custpng.png">
                    <span class="text">客服</span>
                </a>
            </div>
        </div>