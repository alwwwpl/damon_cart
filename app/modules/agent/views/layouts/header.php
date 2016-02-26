<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<!--<header class="main-header">

    <?php // Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Html::img('/images/logo.png') . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="<?php // $directoryAsset ?>/img/user2-160x160.jpg" class="user-image hide" alt="User Image"/>
                        <span class="hidden-xs"><?php // Yii::$app->agent->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php// Url::to(['user/update']); ?>" class="btn btn-default btn-flat">个人信息</a>
                            </div>
                            <div class="pull-right">
                                <?php// Html::a('注销',['/agent/account/logout'],['data-method' => 'post', 'class' => 'btn btn-default btn-flat']) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
-->
<div class="navbar navbar-inverse">
    <div class="navbar-inner">
        <button type="button" class="btn btn-navbar visible-phone" id="menu-toggler">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="brand" href="./">
            <img src="http://agent.iddmall.com/images/logo.png"/>
        </a>
        <ul class="nav pull-right">
            <li class="settings hidden-phone" style="float: left;">
                <a href="javascript:void(0);" role="button">
                    <?php echo Yii::$app->agent->identity->username; ?>
                </a>
            </li>
            <li class="settings hidden-phone" style="float: left;">
                <a href="/agent/user/change-password" role="button">
                    <i class="icon-cog"></i>
                </a>
            </li>
            <li class="settings hidden-phone" style="float: left;">
                <a href="/agent/account/logout" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
