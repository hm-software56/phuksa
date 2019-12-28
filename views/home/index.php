<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\alert\Alert;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Homes');
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
<div class="home-index">
    <div align="right">
        <?= Html::a("<il class='fa fa-plus-circle'></il> ". Yii::t('app', 'Create Home'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            [
                'attribute' => 'photo',
                'format' => 'raw',
                'value' => function($data) {
                    $url = \Yii::$app->request->BaseUrl . '/images/' . $data->photo;
                    return Html::img($url, [ 'class' => 'img-responsive img-fluid','style'=>'height:50px;']);
                },
                    'filter' => false,
                ],
            'title',
            'type',

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


</div>