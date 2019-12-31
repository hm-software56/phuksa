<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceTicket */

$this->title = Yii::t('app', 'Create Ticket');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Tickets'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-ticket-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>