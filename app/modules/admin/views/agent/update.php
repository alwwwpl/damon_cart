<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Agent */

$this->title = Yii::t('app', 'Update') . ': ' . $model->agent_id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agents'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->agent_id, 'url' => ['view', 'id' => $model->agent_id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="agent-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
