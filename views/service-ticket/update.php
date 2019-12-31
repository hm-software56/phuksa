<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceTicket */

$this->title = Yii::t('app', 'Update Ticket: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="service-ticket-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>