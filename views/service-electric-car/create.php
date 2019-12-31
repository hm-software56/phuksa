<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceElectricCar */

$this->title = Yii::t('app', 'Create Electric Car');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Electric Cars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-electric-car-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>