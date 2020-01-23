<?php

namespace app\controllers;
use Yii;
use app\models\ServiceTicket;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OrderTicket;
use app\models\ServiceElectricCar;
use app\models\OrderElectricCar;
use app\models\ReportInTicket;
use yii\helpers\Url;
class ReportController extends \yii\web\Controller
{
    public function init()
    {
        if(Yii::$app->user->id){
            Yii::$app->layout="main_admin";
        }
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionReport($date_start=null,$date_end=null,$type=null)
    {
        Yii::$app->session['report_url']=Url::toRoute(['report/report','rt'=>'date']);

        if(empty($date_start) || empty($date_end))
        {
            $date_start=date('Y-m-d 00:00:00');
            $date_end=date('Y-m-d 23:59:00');
        }else{
            $date_start=date('Y-m-d 00:00:00',strtotime($date_start));
            $date_end=date('Y-m-d 23:59:00', strtotime($date_end));
        }
        if(!empty($type))
        {
            $model=OrderTicket::find()->where('service_ticket_id='.$type.' and (order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')->all();
        }else{
            $model=OrderTicket::find()->where('order_date>"'.$date_start.'" and order_date<"'.$date_end.'"')->all();
        }
       $service_ticket=ServiceTicket::find()->all();
        return $this->render('report',['model'=>$model,'service_ticket'=>$service_ticket]);
    }
    public function actionReportbymonth()
    {
        Yii::$app->session['report_url']=Url::toRoute(['report/reportbymonth','rt'=>'month']);
        return $this->render('report');
    }
    public function actionReportbyyear()
    {
        Yii::$app->session['report_url']=Url::toRoute(['sreport/reportbyyear','rt'=>'year']);
        return $this->render('report');
    }


    public function actionReportcar($date_start=null,$date_end=null,$type=null)
    {
        Yii::$app->session['report_url']=Url::toRoute(['report/reportcar','rt'=>'date']);

        if(empty($date_start) || empty($date_end))
        {
            $date_start=date('Y-m-d 00:00:00');
            $date_end=date('Y-m-d 23:59:00');
        }else{
            $date_start=date('Y-m-d 00:00:00',strtotime($date_start));
            $date_end=date('Y-m-d 23:59:00', strtotime($date_end));
        }
        if(!empty($type))
        {
            $model=\app\models\OrderElectricCar::find()->where('service_electric_car_id='.$type.' and (order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')->all();
        }else{
            $model=\app\models\OrderElectricCar::find()->where('order_date>"'.$date_start.'" and order_date<"'.$date_end.'"')->all();
        }
       $service_car=\app\models\ServiceElectricCar::find()->all();
        return $this->render('reportcar',['model'=>$model,'service_car'=>$service_car]);
    }
    public function actionReportcarbymonth()
    {
        Yii::$app->session['report_url']=Url::toRoute(['report/reportcarbymonth','rt'=>'month']);
        return $this->render('reportcar');
    }
    public function actionReportcarbyyear()
    {
        Yii::$app->session['report_url']=Url::toRoute(['report/reportcarbyyear','rt'=>'year']);
        return $this->render('reportcar');
    }


    public function actionReportsfb($rt=null)
    {
        if($rt=="month")
        {
            Yii::$app->session['report_url']=Url::toRoute(['report/reportsfb','rt'=>'month']);
        }elseif($rt=="year"){
            Yii::$app->session['report_url']=Url::toRoute(['report/reportsfb','rt'=>'year']);
        }
        else{
            Yii::$app->session['report_url']=Url::toRoute(['report/reportsfb','rt'=>'date']);
        }
        return $this->render('report_foodbeverage');
    }

    public function actionReportpod($rt=null)
    {
        if($rt=="month")
        {
            Yii::$app->session['report_url']=Url::toRoute(['report/reportpod','rt'=>'month']);
        }elseif($rt=="year"){
            Yii::$app->session['report_url']=Url::toRoute(['report/reportpod','rt'=>'year']);
        }
        else{
            Yii::$app->session['report_url']=Url::toRoute(['report/reportpod','rt'=>'date']);
        }
        return $this->render('report_pod');
    }
}
