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
/**
 * ServiceTicketController implements the CRUD actions for ServiceTicket model.
 */
class ServiceTicketController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        if(Yii::$app->user->id){
            Yii::$app->layout="main_admin";
        }
    }
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ServiceTicket models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ServiceTicket::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceTicket model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new ServiceTicket model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceTicket();

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id=Yii::$app->user->id;
            $model->date=date('Y-m-d h:i:s');
            if($model->save())
            {
                Yii::$app->session->setFlash('yes',Yii::t('app','Created successfully.'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ServiceTicket model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->user_id=Yii::$app->user->id;
            if($model->save())
            {
                Yii::$app->session->setFlash('yes',Yii::t('app','Edited successfully.'));
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSaleticket()
    {
        $model=ServiceTicket::find()->all();
        $model_car=ServiceElectricCar::find()->all();
        $ordersticket=new OrderTicket;
        $ordersticket_car=new OrderElectricCar;
        $error=[];
        $error_car=[];
        if(isset($_POST['confirm_sale']))
        {
            Yii::$app->session['print']=Yii::$app->session['sale'];
            $print=[];
            foreach($model as $modelsave)
            {
                if(isset(Yii::$app->session['sale']['service_ticket_id_'.$modelsave->id.'']))
                {
                    $ordersticket=new OrderTicket;
                    $ordersticket->order_name=$modelsave->name;
                    $ordersticket->quantity=Yii::$app->session['sale']['quantity_'.$modelsave->id.''];
                    $ordersticket->price=$modelsave->price;
                    $ordersticket->order_date=date('Y-m-d H:i:s');
                    $ordersticket->service_ticket_id=$modelsave->id;
                    $ordersticket->user_id=Yii::$app->user->id;
                    $ordersticket->status="Paid";
                    $ordersticket->order_code=$ordersticket->Getordercode();
                    if(!$ordersticket->save())
                    {
                        print_r($ordersticket->getErrors());exit;
                    }else{
                        $print['order_code_'.$modelsave->id.'']=$ordersticket->order_code;
                    }
                }
            }

            foreach($model_car as $model_carsave)
            {
                if(isset(Yii::$app->session['sale']['service_electric_car_id_'.$model_carsave->id.''])){
                    $ordersticket_car=new OrderElectricCar;
                    $ordersticket_car->order_name=$model_carsave->name;
                    $ordersticket_car->quantity=Yii::$app->session['sale']['quantity_car_'.$model_carsave->id.''];
                    $ordersticket_car->price=$model_carsave->price;
                    $ordersticket_car->order_date=date('Y-m-d H:i:s');
                    
                    $ordersticket_car->service_electric_car_id=$model_carsave->id;
                    $ordersticket_car->user_id=Yii::$app->user->id;
                    $ordersticket_car->status="Paid";
                    $ordersticket_car->order_code=$ordersticket_car->Getordercode();
                    if(!$ordersticket_car->save())
                    {
                        print_r($ordersticket_car->getErrors());exit;
                    }else{
                        $print['order_code_car_'.$model_carsave->id.'']=$ordersticket_car->order_code;
                    }

                }
                
            }
            Yii::$app->session['print']=\array_merge( Yii::$app->session['print'],$print);
            unset(Yii::$app->session['sale']);
            unset(Yii::$app->session['total_amount']);
            return $this->redirect(['service-ticket/print']);
        }elseif(Yii::$app->request->post())
        {
            Yii::$app->session['sale']=Yii::$app->request->post();
            $total_amount=0;
            $notinput_tk=false;
            $notinput_cb=false;
            foreach($model as $model1)
            {
                if(!isset(Yii::$app->session['sale']['service_ticket_id_'.$model1->id.'']) && (int)Yii::$app->session['sale']['quantity_'.$model1->id.'']>0){
                   $error[]=Yii::t('app','Please check ticket')." ". $model1->name. " ".Yii::t('app','Incorrect.!');
                   $notinput_tk=true;
                }elseif(isset(Yii::$app->session['sale']['service_ticket_id_'.$model1->id.''])){
                    $notinput_tk=true;
                    if(empty(Yii::$app->session['sale']['quantity_'.$model1->id.'']))
                    {
                        $notinput_tk=false;
                    }
                    $total_amount+=$model1->price*(int)Yii::$app->session['sale']['quantity_'.$model1->id.''];
                }
            }

            foreach($model_car as $model_car1)
            {
                if(!isset(Yii::$app->session['sale']['service_electric_car_id_'.$model_car1->id.'']) && (int)Yii::$app->session['sale']['quantity_car_'.$model_car1->id.'']>0){
                    $error_car[]=Yii::t('app','Please check ticket')." ". $model_car1->name. " ".Yii::t('app','Incorrect.!');
                    $notinput_cb=true;
                }elseif(isset(Yii::$app->session['sale']['service_electric_car_id_'.$model_car1->id.''])){
                    $notinput_cb=true;
                    if(empty(Yii::$app->session['sale']['quantity_car_'.$model_car1->id.''])){
                        $notinput_cb=false;
                    }
                    $total_amount+=$model_car1->price*(int)Yii::$app->session['sale']['quantity_car_'.$model_car1->id.''];
                }
            }
            if($notinput_cb==false && $notinput_tk==false)
            {
                $error[]=Yii::t('app','Please check ticket input')." ".Yii::t('app','Incorrect.!');
            }
            Yii::$app->session['total_amount']=$total_amount;
        }else{
            $error=['Yes'];
            $error_car=['Yes'];
        }
        if(isset($_GET['b']))
        {
            $error=['Yes'];
            $error_car=['Yes'];
        }
        return $this->render('saleticket', [
            'model' => $model,
            'model_car'=>$model_car,
            'ordersticket'=>$ordersticket,
            'ordersticket_car'=>$ordersticket_car,
            'error'=>$error,
            'error_car'=>$error_car
        ]);
    }

    public function actionPrint()
    {
        $model=ServiceTicket::find()->all();
        $model_car=ServiceElectricCar::find()->all();
        return $this->render('print',['model'=>$model,'model_car'=>$model_car,'dataprint'=>Yii::$app->session['print']]);
    }

    
    /**
     * Deletes an existing ServiceTicket model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the ServiceTicket model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceTicket the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceTicket::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}