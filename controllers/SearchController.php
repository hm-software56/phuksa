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
class SearchController extends \yii\web\Controller
{
    public function beforeAction($action)
    {
        if(Yii::$app->user->id){
            Yii::$app->layout="main_admin";
            return true;
        }else{
            return $this->redirect(['site/login']);
        }
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSearchticket($no_number=null,$date_start=null,$date_end=null,$type=null)
    {
        
        if(!empty($date_start) && !empty($no_number))
        {
            $date_start=date('Y-m-d 00:00:00',strtotime($date));
            $date_end=date('Y-m-d 23:59:00', strtotime($date));
            $query=OrderTicket::find()
            ->andWhere('(order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')
            ->andWhere(['order_code'=>$no_number])
            ->all();
        }elseif(!empty($no_number))
        {
            $query=OrderTicket::find()
            ->andWhere(['order_code'=>$no_number])
            ->all();
        }elseif(!empty($date_start))
        {
            $query=OrderTicket::find()
            ->andWhere('(order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')
            ->all();
        }else{
            $date_start=date('Y-m-d 00:00:00');
            $date_end=date('Y-m-d 23:59:00');
            $query=OrderTicket::find()
            ->andWhere('(order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')
            ->all();
        }
        return $this->render('search_ticket',['models'=>$query]);
    }

    public function actionSearchcar($no_number=null,$date_start=null,$date_end=null,$type=null)
    {
        if(!empty($date_start) && !empty($no_number))
        {
            $date_start=date('Y-m-d 00:00:00',strtotime($date));
            $date_end=date('Y-m-d 23:59:00', strtotime($date));
            $query=OrderElectricCar::find()
            ->andWhere('(order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')
            ->andWhere(['order_code'=>$no_number])
            ->all();
        }elseif(!empty($no_number))
        {
            $query=OrderElectricCar::find()
            ->andWhere(['order_code'=>$no_number])
            ->all();
        }elseif(!empty($date_start))
        {
            $query=OrderElectricCar::find()
            ->andWhere('(order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')
            ->all();
        }else{
            $date_start=date('Y-m-d 00:00:00');
            $date_end=date('Y-m-d 23:59:00');
            $query=OrderElectricCar::find()
            ->andWhere('(order_date>"'.$date_start.'" and order_date<"'.$date_end.'")')
            ->all();
        }
        return $this->render('search_car',['model'=>$query]);
    }

    public function actionSearchfb()
    {
        return $this->render('search_foodbeverage');
    }

}
