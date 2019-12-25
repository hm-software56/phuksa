<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12 min-vh-100 d-flex flex-column justify-content-center">
    <div class="row">
        <div class="col-lg-6 col-md-8 mx-auto">

            <!-- form card login -->
            <div class="card rounded shadow shadow-sm">
                <div class="card-header">
                    <h3 class="mb-0">Login</h3>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin([
                            'id' => 'login-form',
                        ]); ?>
                    <div class="form-group">
                        <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'password')->passwordInput() ?>
                    </div>
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?php ActiveForm::end(); ?>
                </div>
                <!--/card-block-->
            </div>
            <!-- /form card login -->

        </div>


    </div>
    <!--/row-->

</div>