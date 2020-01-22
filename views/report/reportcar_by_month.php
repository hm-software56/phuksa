<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use app\models\ServiceTicket;
if(!isset($_GET['month_start'])&& !isset($_GET['month_end']))
{
    $_GET['month_start']='';
    $_GET['month_end']='';
    $_GET['type']='';
}
?>
<?php $form = ActiveForm::begin(['action'=>Yii::$app->session['report_url'],'method'=>'get']); ?>
<div class="row">
	<div class="col-md-2"><input type="month" name="month_start" class="form-control" value="<?=isset($_GET['month_start'])?$_GET['month_start']:''?>" required></div>
	<div class="col-md-1" align="center" style="padding-top:5px"><?=Yii::t('app','ຫາ')?></div>
    <div class="col-md-2"><input  type="month" name="month_end" class="form-control" value="<?=isset($_GET['month_end'])?$_GET['month_end']:''?>" required></div>
	<div class="col-md-2">
		<select name="type" class="form-control" >
            <option value="" selected><?=Yii::t('app','=== ເລືອກປະ​ເພດ​ປີ້ລົດ ===')?></option>
			<?php
            $service_ticket=\app\models\ServiceElectricCar::find()->all();
			foreach($service_ticket as $stk)
			{
				$selected="";
				if(isset($_GET['type']) && $_GET['type']==$stk->id)
				{
					$selected="selected";
				}
			?>
			<option value=<?=$stk->id?> <?=$selected?>><?=$stk->name?></option>
			<?php
			}
			?>
		</select>
	</div>
	<div class="col-md-2"><button type="submit" class="btn btn-success"><il class="fa fa-search"></il> <?=Yii::t('app','ຄົ້ນ​ຫາ')?></button></div>
	<div class="col-md-3" align="right">
		<a class="btn btn-danger btn-sm" onclick="printDiv('print')">
			<il class="fa fa-print"></il> <?=Yii::t('app','ພີມອອກ')?>
		</a>
	</div>
</div>
<?php ActiveForm::end(); ?>
<div id="print">
	<div id="show_logo" style="display:none">
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td width="50">
                        <img src="<?=\Yii::$app->request->BaseUrl . '/images/logo.jpg'?>" class="img-circle"
                            width="80" />
                    </td>
                    <td align="center">
                        <div align="center">
                            <h2><b><?=Yii::t('app','ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ລົດ​​ນຳໃຊ້​ທ່ຽວ​ສວນ​ພຶກ​ສາ')?></b></h2>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php
    if(isset($_GET['month_start'])&& isset($_GET['month_end']))
    {
        $service_type=\app\models\ServiceElectricCar::find()->where(['id'=>$_GET['type']])->one();
        $ticket_type="";
        if($service_type)
        {
            $ticket_type=$service_type->name;
        }
    ?>
    <table class="table table-bordered">
        <tr>
            <td colspan="3" align="right"><?=Yii::t('app','ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ລົດ​​ນຳໃຊ້​ທ່ຽວ​ສວນ​ພຶກ​ສາເດືອນ:').date('m/Y',strtotime($_GET['month_start']))." ຫາ ".date('m/Y',strtotime($_GET['month_end'])).", ".Yii::t('app','ປະ​ເພດ​ປີ້:').$ticket_type ?></td>
        </tr>
        <tr>
            <th><?=Yii::t('app','ເດືອນ')?></th>
            <th><?=Yii::t('app','ລວມ​ຈຳ​ນວນ​ປີ້')?></th>
            <th><?=Yii::t('app','ລວມ​ຈຳ​ນວນ​ເງີນ/ກີບ')?></th>
        </tr>

        <?php
            $start = strtotime($_GET['month_start']);
            $end = strtotime($_GET['month_end']);
            $total_amount=0;
            while($start <= $end)
            {
                $connection = Yii::$app->getDb();
                if(!empty($_GET['type']))
                {
                    $command_amount = $connection->createCommand('SELECT SUM(price*quantity) FROM order_electric_car WHERE service_electric_car_id='.$_GET['type'].' and month(order_date)="'.date('Y', $start).'" and month(order_date)="'.date('Y', $start).'"')->queryScalar();
                    $command_ps = $connection->createCommand('SELECT SUM(quantity) FROM order_electric_car WHERE service_electric_car_id='.$_GET['type'].' and month(order_date)="'.date('m', $start).'" and year(order_date)="'.date('Y', $start).'"')->queryScalar();
                
                }else{
                    $command_amount = $connection->createCommand('SELECT SUM(price*quantity) FROM order_electric_car WHERE month(order_date)="'.date('m', $start).'" and year(order_date)="'.date('Y', $start).'"')->queryScalar();
                    $command_ps = $connection->createCommand('SELECT SUM(quantity) FROM order_electric_car WHERE month(order_date)="'.date('m', $start).'" and month(order_date)="'.date('Y', $start).'"')->queryScalar();
                }
                $total_amount+=$command_amount;
        ?>
        <tr>
                <td><?=date('m/Y', $start) ?></td>
                <td><?=$command_ps?></td>
                <td><?=number_format($command_amount,2)?></td>
        </tr>
        <?php
                $start = strtotime("+1 month", $start);
            }
        ?>
        <tr>
                <td colspan="2" align="right"><b><?=Yii::t('app','ລ​ວມ​ຈຳ​ນວນ​ເງີນ​ທັງ​ໝົດ') ?></b></td>
                <td><b><?=number_format($total_amount,2)?></b></td>
        </tr>
    </table>
    <?php
    }
    ?>
</div>