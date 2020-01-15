<?php
use lo\widgets\SlimScroll;
?>
<?php
echo SlimScroll::widget([
    'options' => [
        'height' => '550px',
	   
        // 'alwaysVisible' => true,
        // "distance" => '20px',
       // "wheelStep" => 100,
    ]
]);
?>
<?php
foreach ($model as $model) {
    ?>
    <div class="col-md-4 col-sm-4 col-xs-6">
        <div class="row">
            <div class="col-md-12" align="center">
                <?php
                echo yii\helpers\Html::a('<img src="' . Yii::$app->urlManager->baseUrl . '/images/' . $model->photo . '" class="thumbnail img-responsive" />', '#', [
                    'title' => Yii::t('yii', 'ຂາຍ'),
                    'onclick' => "
                  $.ajax({
                  type     :'POST',
                  cache    : false,
                  url  : 'index.php?r=service-food-beverage/order&id=" . $model->id . "',
                  'beforeSend': function(){
                        $('#send').remove();
                        $('#load').html('<img src=images/loading.gif width=50 />');
                    },
                  success  : function(response) {
                  $('#output').html(response);
                  }
                  });return false;",
                ]);
                ?>
                <?= $model->name ?>
                <br/>
                <span class="text-red"><?= number_format($model->sale_price, 2) ?></span> <?=Yii::t('app','ກີບ')?><br/><br/>
            </div>
        </div>
    </div>
    <?php
}
?>
<?php  echo SlimScroll::end(); ?>