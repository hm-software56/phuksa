<div class="row">
    <div class="col-md-3" id="output">
    <?php
        echo $this->render('order');
    ?>
    </div>
    <div class="col-md-9">
    <?php
        echo $this->render('pos_sale',['model'=>$model]);
    ?>
    </div>
</div>