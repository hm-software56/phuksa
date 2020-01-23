<?php
use yii\helpers\Html;
use yii\helpers\Url;
$this->title = Yii::t('app', 'ລາຍ​ງານ​ການ​ຂາຍ​ປີ້​ລົດ​​ນຳໃຊ້​ທ່ຽວ​ສວນ​​ພຶກ​ສາ');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row" align="right">
	<div class="col-md-12">
		<ul class="breadcrumb">
			<li>   
			<?php
				echo yii\helpers\Html::a('<span class="fa fa-pie-chart"></span> '.Yii::t('app','ລາຍ​ງານ​ຕ​າມ​ວັນ​ທີ່'),Url::toRoute(['report/reportcar','rt'=>'date']));
			?> 
			</li>
			<li>
				<?php
					echo yii\helpers\Html::a('<span class="fa fa-line-chart"></span> '.Yii::t('app','ລາຍ​ງານ​ຕ​າມເດືອນ'), Url::toRoute(['report/reportcarbymonth','rt'=>'month']));
				?> 
			</li>
			<li>
				<?php
					echo yii\helpers\Html::a('<span class="fa fa-bar-chart"></span> '.Yii::t('app','ລາຍ​ງານ​ຕ​າມປີ'), Url::toRoute(['report/reportcarbyyear','rt'=>'year']));
					?> 
			</li>
		</ul>
	</div>
</div>
<?php
if($_GET['rt']=="month")
{
	echo $this->render('reportcar_by_month');
}elseif($_GET['rt']=="year")
{
	echo $this->render('reportcar_by_year');
}else{
	echo $this->render('reportcar_by_date',['service_car'=>$service_car,'model'=>$model]);
}

?>
 
<script>
function printDiv(divName) {
	document.getElementById("show_logo").style.display = "block";
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
	document.getElementById("show_logo").style.display = "none";
}
</script>