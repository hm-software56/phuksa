<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceElectricCar */

$this->title = Yii::t('app', 'Update  Electric Car: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Electric Cars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="service-electric-car-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>