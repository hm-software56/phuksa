<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\alert\Alert;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductOrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Product Orders');
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
<div class="product-order-index">

    <div align="right">
        <?= Html::a("<il class='fa fa-plus-circle'></il> ". Yii::t('app', 'ສັ່ງ​ຊື້​ສີນ​ຄ້າ'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'order_code',
            'status',
            'order_date',
            'done_date',
            //'user_id',

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