<?php
use app\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login')
{
    echo $this->render(
        'main-login',
        [
            'content' => $content
        ]
    );
}
else
{

    AppAsset::register($this);
    $this->beginPage();
?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <style>
        input { height: 35px !important; line-height: 35px !important;}
    </style>
    <body class="skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php'
        ) ?>

        <?= $this->render(
            'left.php'
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
