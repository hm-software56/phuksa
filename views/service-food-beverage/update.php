<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ServiceFoodBeverage */

$this->title = Yii::t('app', 'ເພີ່ມ​ບໍ​ລີ​ການ​ອາ​ຫານ ແລະ ເຄື່ອງ​ດື່ມ: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'ເພີ່ມ​ບໍ​ລີ​ການ​ອາ​ຫານ ແລະ ເຄື່ອງ​ດື່ມ'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', '​ແກ້​ໄຂ');
?>
<div class="service-food-beverage-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
