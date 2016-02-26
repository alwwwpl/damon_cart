<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

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
                    <?php echo Yii::$app->extensioner->identity->username; ?>
                </a>
            </li>
            <li class="settings hidden-phone" style="float: left;">
                <a href="/share/user/change-password" role="button">
                    <i class="icon-cog"></i>
                </a>
            </li>
            <li class="settings hidden-phone" style="float: left;">
                <a href="/share/account/logout" role="button">
                    <i class="icon-share-alt"></i>
                </a>
            </li>
        </ul>
    </div>
</div>
