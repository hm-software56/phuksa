<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\UserProfile;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
<?php
if(Yii::$app->user->identity->type=="Admin")
{
?>
    <div align="right">
        <?= Html::a("<il class='fa fa-plus-circle'></il> ". Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </div>
<?php
}
?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'id',
                'label'=>Yii::t('app','ຊີ່ ແລະ ນາມສະກຸນ'),
                'value'=>function($model)
                    {
                        $emp=UserProfile::find()->where(['user_id'=>$model->id])->one();
                        if($emp)
                        {
                            return $emp->first_name. " ". $emp->last_name;
                        }
                    }
            ],
            [
                'attribute'=>'username',
                'label'=>Yii::t('app','ຊີ່ເຂົ້າລະບົບ'),
                'value'=>function($model)
                    {
                        return $model->username;
                    }
            ],
            #'type',
            [
                'attribute'=>'type',
                'value'=>function($model)
                {
                    if($model->type=='Admin')
                    {
                        return "ຜູ້​ດຄຸ້ມ​ຄອງລະ​ບົບ";
                    }elseif($model->type=='User'){
                        return "​ພະ​ນັ​ກ​ງານ​ຂາຍ";
                    }else{
                        return "ພະ​ນັ​ກ​ງານ​ຫ​້ອງ​ຄົວ";
                    }
                }
            ],
            [
                'attribute'=>'status',
                'value'=>function($model)
                {
                    if($model->status==1)
                    {
                        return "ໃຊ້​ງານ";
                    }else{
                        return "ປິດໃຊ້​ງານ";
                    }
                }
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template'=>'{update} {delete}',
                'visibleButtons' => [
                    'delete' => function ($model, $key, $index) {
                        $user = Yii::$app->session["currentUser"];
                        return (Yii::$app->user->identity->type=="Admin") ? true : false;
                    },
                ],
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