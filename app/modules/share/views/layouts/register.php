<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => Html::img('/images/logo.png'),
                'brandUrl' => ['/admin/default/index'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            // echo Nav::widget([
            //     'options' => ['class' => 'navbar-nav pull-right'],
            //     'items' => [
            //         Yii::$app->admin->isGuest ?
            //             ['label' => '登录', 'url' => ['/account/login']] :
            //             ['label' => '注销 (' . Yii::$app->admin->identity->user_name . ')',
            //                 'url' => ['account/logout'],
            //                 'linkOptions' => ['data-method' => 'post']],
            //     ],
            // ]);
            NavBar::end();
        ?>

        <div class="container">
            <?php
            foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
                $key = $key == 'error' ? 'danger' : $key;
                echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
            }
            ?>

            <?= $content ?>
        </div>

    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; 安徽达蒙狗科技有限公司 <?= date('Y') ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
