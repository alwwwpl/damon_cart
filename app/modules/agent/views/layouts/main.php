<?php
use app\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */


if (Yii::$app->controller->action->id === 'login') { 
/**
 * Do not use this code in your template. Remove it. 
 * Instead, use the code  $this->layout = '//main-login'; in your controller.
 */
    echo $this->render(
        'main-login',
        ['content' => $content]
    );
} else {

//    if (class_exists('backend\assets\AppAsset')) {
//        backend\assets\AppAsset::register($this);
//    } else {
//        app\assets\AppAsset::register($this);
//    }

//    dmstr\web\AdminLteAsset::register($this);

    AppAsset::register($this);

    $directoryAsset = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');
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
    <body class="skin-blue sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?= $this->render(
            'header.php',
            ['directoryAsset' => $directoryAsset]
        ) ?>

        <?= $this->render(
            'left.php',
            ['directoryAsset' => $directoryAsset]
        )
        ?>

        <?= $this->render(
            'content.php',
            ['content' => $content, 'directoryAsset' => $directoryAsset]
        ) ?>

    </div>

    <?php $this->endBody() ?>
    <script>
        $('.deliver').on('click',function(){
            var order_id = $(this).attr('data-id');
            $('#myModal').attr('data-id',order_id);
        });

        $('#deliver-submit').on('click',function(){
            var order_id = $('#myModal').attr('data-id');
            var express = $('#express_name').val()+' '+$('#express').val();
            if ($('#express').val())
            {
                $.post('./deliver',{order_id:order_id,express:express},function(data){
                    $('#myModal').modal('toggle');
                    $('#order-id'+order_id+' .order-status').html('<span class="label label-success">已发货</span>');
                    $('#order-id'+order_id+' .order-action').html('<a href="./info?order_id='+ order_id +'"><i class="icon-eye-open"></i></a>');
                });
            }
            else {
                alert('请输入物流信息!');
            }

        });

        function changestatus(status,agent_id){
            $.post('./changestatus',{agent_id:agent_id,status:status},function(data){
                if (data.status == 'success'){
                    if (data.num == 2){
                        $('#agent-id'+agent_id+' .agent-status').html('<span class="label label-gray" onclick="changestatus(\'1\','+agent_id+')">已拒绝</span>');
                    }
                    else if (data.num == 1){
                        $('#agent-id'+agent_id+' .agent-status').html('<span class="label label-success" onclick="changestatus(\'2\','+agent_id+')">已通过</span>');
                    }
                }
                else {
                    alert('操作失败!');
                }
            },'json');
        }

    </script>
    </body>
    </html>
    <?php $this->endPage() ?>
<?php } ?>
