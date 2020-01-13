<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ProductOrder */

$this->title = Yii::t('app', 'Create Product Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Product Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-order-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>