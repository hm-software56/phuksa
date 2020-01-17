<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
echo Yii::$app->getUrlManager()->getBaseUrl();
$this->registerCssFile(Yii::$app->getUrlManager()->getBaseUrl()."/css/login.css");
$this->title =Yii::t('app','ເຂົ້າ​ລະ​ບົບ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
    <img src="<?=Yii::$app->request->baseUrl?>/images/logo.jpg" class="img-circle" width="60" />
    </div>

    <!-- Login Form -->
    <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
        <div class="form-group">
            <?= $form->field($model, 'username')->textInput(['id'=>"login",'class'=>'fadeIn second','placeholder'=>Yii::t('app','Username')])->label(false) ?>
        </div>
        <div class="form-group">
            <?= $form->field($model, 'password')->passwordInput(['class'=>'fadeIn third','id'=>"password",'placeholder'=>Yii::t('app','Password')])->label(false) ?>
        </div>
        <div id="formFooter">
          <?= Html::submitButton(Yii::t('app', 'ເຂົ້າ​ລະ​ບົບ'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>

