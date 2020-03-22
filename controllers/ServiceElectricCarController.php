<?php

namespace app\controllers;

use Yii;
use app\models\ServiceElectricCar;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\OrderElectricCar;
/**
 * ServiceElectricCarController implements the CRUD actions for ServiceElectricCar model.
 */
class ServiceElectricCarController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function beforeAction($action)
    {
        if(Yii::$app->user->id){
            Yii::$app->layout="main_admin";
            return true;
        }else{
            return $this->redirect(['site/login']);
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
     * Lists all ServiceElectricCar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => ServiceElectricCar::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceElectricCar model.
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
     * Creates a new ServiceElectricCar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceElectricCar();

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
     * Updates an existing ServiceElectricCar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
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

    public function actionSaleticketcar()
    {
        $model_car=ServiceElectricCar::find()->all();
        $ordersticket_car=new OrderElectricCar;
        $error_car=[];
        if(isset($_POST['confirm_sale']))
        {
            Yii::$app->session['print_car']=Yii::$app->session['sale_car'];
            $print=[];
            foreach($model_car as $model_carsave)
            {
                if(isset(Yii::$app->session['sale_car']['service_electric_car_id_'.$model_carsave->id.''])){
                    $ordersticket_car=new OrderElectricCar;
                    $ordersticket_car->order_name=$model_carsave->name;
                    $ordersticket_car->quantity=Yii::$app->session['sale_car']['quantity_car_'.$model_carsave->id.''];
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
            Yii::$app->session['print_car']=\array_merge( Yii::$app->session['print_car'],$print);
            unset(Yii::$app->session['sale_car']);
            unset(Yii::$app->session['total_amount_car']);
            return $this->redirect(['service-electric-car/print']);
        }elseif(Yii::$app->request->post())
        {
            Yii::$app->session['sale_car']=Yii::$app->request->post();
            $total_amount=0;
            $notinput_cb=false;

            foreach($model_car as $model_car1)
            {
                if(!isset(Yii::$app->session['sale_car']['service_electric_car_id_'.$model_car1->id.'']) && (int)Yii::$app->session['sale_car']['quantity_car_'.$model_car1->id.'']>0){
                    $error_car[]=Yii::t('app','Please check ticket')." ". $model_car1->name. " ".Yii::t('app','Incorrect.!');
                    $notinput_cb=true;
                }elseif(isset(Yii::$app->session['sale_car']['service_electric_car_id_'.$model_car1->id.''])){
                    $notinput_cb=true;
                    if(empty(Yii::$app->session['sale_car']['quantity_car_'.$model_car1->id.''])){
                        $notinput_cb=false;
                    }
                    $total_amount+=$model_car1->price*(int)Yii::$app->session['sale_car']['quantity_car_'.$model_car1->id.''];
                }
            }
            if($notinput_cb==false)
            {
                $error[]=Yii::t('app','Please check ticket input')." ".Yii::t('app','Incorrect.!');
            }
            Yii::$app->session['total_amount_car']=$total_amount;
        }else{
            $error_car=['Yes'];
        }
        if(isset($_GET['b']))
        {
            $error_car=['Yes'];
        }
        return $this->render('saleticket_car', [
            'model_car'=>$model_car,
            'ordersticket_car'=>$ordersticket_car,
            'error_car'=>$error_car
        ]);
    }

    public function actionPrint()
    {
        $model_car=ServiceElectricCar::find()->all();
        return $this->render('print',['model_car'=>$model_car,'dataprint'=>Yii::$app->session['print_car']]);
    }
    /**
     * Deletes an existing ServiceElectricCar model.
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
     * Finds the ServiceElectricCar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceElectricCar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceElectricCar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}