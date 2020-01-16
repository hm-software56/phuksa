<div class="row">
    <div class="col-md-3" id="output">
    <?php
        if(Yii::$app->session['print_sale'])
        {
            echo $this->render('print_sale');
        }else{
            echo $this->render('order');
        }
    ?>
    </div>
    <div class="col-md-9">
        <div class="row" align="right">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li>   
                    <?php
                        echo yii\helpers\Html::a('<span class="glyphicon glyphicon-th-large "></span> '.Yii::t('app','​ທັງ​ໝົດ'), '#', [
                                    'onclick' => "
                            $.ajax({
                        type     :'POST',
                        cache    : false,
                        url  : 'index.php?r=service-food-beverage/searchsale&key=all',
                        success  : function(response) {
                            $('#output_sale').html(response);
                        }
                        });return false;",
                                ]);
                    ?> 
                    </li>
                    <li>
                        <?php
                            echo yii\helpers\Html::a('<span class="fa fa-cutlery "></span> '.Yii::t('app','​ປະ​ເພດ ອາ​ຫານ'), '#', [
                                        'onclick' => "
                                $.ajax({
                            type     :'POST',
                            cache    : false,
                            url  : 'index.php?r=service-food-beverage/searchsale&key=Food',
                            success  : function(response) {
                                $('#output_sale').html(response);
                            }
                            });return false;",
                                    ]);
                        ?> 
                    </li>
                    <li>
                        <?php
                                echo yii\helpers\Html::a('<span class="fa fa-glass "></span> '.Yii::t('app','ປະ​ເພ​ດ ເຄື່ອງ​ດື່ມ'), '#', [
                                            'onclick' => "
                                    $.ajax({
                                type     :'POST',
                                cache    : false,
                                url  : 'index.php?r=service-food-beverage/searchsale&key=Beverage',
                        
                                success  : function(response) {
                                    $('#output_sale').html(response);
                                }
                                });return false;",
                                        ]);
                            ?> 
                    </li>
                </ul>
            </div>
        </div>
        <div class="row" id="output_sale">
            <?php
                echo $this->render('pos_sale',['model'=>$model]);
            ?>  
        </div>
    </div>
</div>