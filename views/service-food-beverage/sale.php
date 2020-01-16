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
    <?php
        echo $this->render('pos_sale',['model'=>$model]);
    ?>
    </div>
</div>