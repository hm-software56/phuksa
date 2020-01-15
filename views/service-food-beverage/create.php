<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceFoodBeverage */

$this->title = Yii::t('app', 'ເພີ່ມ​ບໍ​ລີ​ການ​ອາ​ຫານ ແລະ ເຄື່ອງ​ດື່ມ');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ບໍ​ລີ​ການ​ອາ​ຫານ ແລະ ເຄື່ອງ​ດື່ມ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-food-beverage-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
