<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\Alert;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ServiceFoodBeverageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Service Food Beverages');
$this->params['breadcrumbs'][] = $this->title;
if(Yii::$app->session->hasFlash('yes')){
    echo Alert::widget([
        'type' =>Alert::TYPE_SUCCESS,
        'title' => Yii::t('app','Well done!'),
        'icon' => 'fas fa-ok-circle',
        'body' =>Yii::$app->session->getFlash('yes'),
        'showSeparator' => true,
        'delay' => 2000
    ]);
}
?>
<div class="service-food-beverage-index">

    <div align="right">
        <?= Html::a("<il class='fa fa-plus-circle'></il> ". Yii::t('app', 'ເພີ່ມ​ບໍ​ລີ​ການ​ອາ​ຫານ ແລະ ເຄື່ອງ​ດື່ມ'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'summary'=>'',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function($data) {
                    $url = \Yii::$app->request->BaseUrl . '/images/' . $data->photo;
                    return Html::img($url, [ 'class' => 'img-responsive img-fluid','style'=>'height:50px;']);
                },
                    'filter' => false,
            ],
            'name',
            [
                'attribute' => 'buy_price',
                'label'=>Yii::t('app','ລາ​ຄາ​ຊື້/​ກີບ'),
                'format' => 'raw',
                'value' => function($data) {
                   return number_format($data->buy_price);
                 },
                    'filter' => false,
            ],
            [
                'attribute' => 'sale_price',
                'label'=>Yii::t('app','ລາ​ຄາຂາຍ/​ກີບ'),
                'format' => 'raw',
                'value' => function($data) {
                   return number_format($data->sale_price);
                 },
                    'filter' => false,
            ],
            [
                'attribute' => 'status',
                'label'=>Yii::t('app','ສະ​ຖາ​​ນະ'),
                'format' => 'raw',
                'value' => function($data) {
                   if($data->status==1)
                   {
                    return Yii::t('app',"ເປິດ");
                   }else{
                    return Yii::t('app',"ປິດ");
                   }
                 },
                    'filter' => [ 1 => Yii::t('app','ເປິດ'), 0 => Yii::t('app','​ປິດ')],
            ],
            [
                'attribute' => 'type',
                'label'=>Yii::t('app','ປະ​ເພດ'),
                'format' => 'raw',
                'value' => function($data) {
                   if($data->type=='Food')
                   {
                    return Yii::t('app',"ອາ​ຫານ");
                   }else{
                    return Yii::t('app',"​ເ​ຄືອງ​ດື່ມ");
                   }
                 },
                    'filter' => [ 'Food' => Yii::t('app','ອາ​ຫານ'), 'Beverage' => Yii::t('app','​ເ​ຄືອງ​ດື່ມ') ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-edit"></span>', $url, [
                                    'class' => 'btn btn-success btn-xs',
                                    ]
                        );
                    },
                    'delete' => function ($url, $model) {
                        return Html::a(
                                    '<span class="glyphicon glyphicon-remove"></span>', $url, [
                                    'data-method' => "post",
                                    'data-confirm' => Yii::t('app', 'Are you want to delete this item.?'),
                                    'class' => 'btn btn-danger btn-xs',
                                    ]
                        );
                    },
                ],
                'contentOptions' => ['style' => 'width: 120px'],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
