<?php

use yii\helpers\Html;
use kartik\grid\GridView;

use app\models\ProductSupplier;
use yii\widgets\LinkPager;

/* @var $this yii\web\View */
/* @var $searchModel app\models\search\AgentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agent-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php /* echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'hover'=>true,
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
                'attribute' => 'supplier_id',
                'headerOptions' => ['width' => '50'],
            ],
            [
                'attribute' => 'image',
                'format' => 'raw',
                'value' => function($model){
                        return Html::img('http://iddmall.com/image/'.$model->image,
                            ['class' => 'img-circle', 'width' => 80, 'height' => 80]
                        );
                    },
            ],
            'agent_product_name',
            'agent_product_stock',
            'agent_product_model',
            'cost_price',
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    */?>

</div>

<div class="container-fluid">
    <div class="users-list" id="pad-wrapper" style="margin-top:25px;">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h3><i class="con-shopping-cart"></i>产品管理</h3>
                </div>
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            产品编号
                        </th>
                        <th>
                            <span class="line"></span>产品名称
                        </th>
                        <th>
                            <span class="line"></span>产品库存
                        </th>
                        <th>
                            <span class="line"></span>供货价
                        </th>
                        <th class="align-right">
                            <span class="line"></span>操作
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (!empty($productData))
                    {
                        $i = 0;
                        foreach($productData as $val)
                        {
                            $first = '';
                            if ($i == 0){$first = 'class="first"';}else{$first = '';}
                            ?>
                            <tr <?php echo $first;?> >
                                <td><?php echo $val['product_id'];?></td>
                                <td>
                                    <img src="http://iddmall.com/image/<?php echo $val['image'] ?>" class="img-circle avatar hidden-phone">
                                    <a href="user-profile.html" class="name"><?php echo $val['agent_product_name'];?></a>
                                    <span class="subtext"><?php echo $val['agent_product_model'];?></span>
                                </td>
                                <td><?php echo $val['agent_product_stock'];?></td>
                                <td><?php echo $val['cost_price'];?></td>
                                <td class="align-right">
                                    <a href="#"><i class="icon-eye-open"></i></a>
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
