<?php
use yii\helpers\Html;
use kartik\grid\GridView;

use app\models\InviteCode;
use yii\widgets\LinkPager;

$this->title = "分享链接";
?>
    <?php if($count<=0){ ?>

    <div class="container-fluid">
        <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <h3><i class="con-shopping-cart"></i>推广管理</h3>
                        <div style="float: right;"><a class="btn btn-success" href="./gen-codes">生成推广链接</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--<div class="jumbotron">
        <?php //Html::a('生成推广码', ['share/gen-codes'], ['class' => 'btn btn-default']) ?>
    </div>-->
    <? }else{ ?>
    <?php /*GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive'=>true,
        'hover'=>true,
        'toolbar'=>[
            '{export}',
            '{toggleData}'
        ],
        'autoXlFormat'=>true,
        'export'=>[
            // 'fontAwesome'=>true,
            'showConfirmAlert'=>false,
            'target'=>GridView::TARGET_BLANK
        ],
        'panel'=>[
            'type'=>'primary',
        ],
        'columns' => [
            [
                'attribute' => 'code',
                'format' => 'text'
            ],
            [
                'attribute' => 'url',
                'format' => 'raw',
                'value' => function($model){
                    $url = $model->getUrl(Yii::$app->agent->identity);
                    return Html::a($url, $url, ['target' => '_blank']);
                }
            ],
            [
                'attribute' => 'status',
                'format' => 'text',
                'filter' => Html::activeDropDownList($searchModel, 'status', InviteCode::$statuses, ['class' => 'form-control','prompt' => '请选择']),
                'value' => function($model){
                    return $model->statusText;
                }
            ],
            [
                'attribute' => 'date_added',
                'format' => 'text'
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>


    <div class="container-fluid">
        <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <h3><i class="con-shopping-cart"></i>推广管理</h3>
                    </div>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>
                                推广码
                            </th>
                            <th>
                                <span class="line"></span>推广链接
                            </th>
                            <th>
                                <span class="line"></span>添加时间
                            </th>
                            <th>
                                <span class="line"></span>状态
                            </th>
                            <th class="align-right">
                                <span class="line"></span>操作
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (!empty($dataProvider))
                        {
                            $i = 0;
                            foreach($dataProvider as $val)
                            {
                                $first = '';
                                if ($i == 0){$first = 'class="first"';}else{$first = '';}
                                ?>
                                <tr <?php echo $first;?> >
                                    <td><?php echo $val['code'];?></td>
                                    <td><a href="<?php echo $model->getUrl(Yii::$app->agent->identity).$val['code'];?>" target="_blank"><?php echo $model->getUrl(Yii::$app->agent->identity).$val['code'];?></a></td>
                                    <td><?php echo $val['date_added'];?></td>
                                    <td>
                                        <?php
                                        if ($val['status'] == '1')
                                        {
                                            echo '<span class="label label-gray">已使用</span>';
                                        }
                                        else {
                                            echo '<span class="label label-success">未使用</span>';
                                        }
                                        ?>
                                    </td>
                                    <td class="align-right">
                                        <a href="./delete?invite_code_id=<?php echo $val['invite_code_id'];?>"><i class="icon-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php echo LinkPager::widget(['pagination' => $pages]); ?>
                </div>
            </div>
        </div>
    </div>




    <?php } ?>
<?php 
$this->registerJsFile('/js/jquery.clipboard.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('/js/admin/share.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>