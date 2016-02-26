<?php
use app\assets\AppAsset;
use yii\helpers\Html;

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
<body class="login-bg">

<?php $this->beginBody() ?>
<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    $key = $key == 'error' ? 'danger' : $key;
    echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
}
?>
    <?= $content ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
