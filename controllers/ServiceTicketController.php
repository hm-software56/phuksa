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
        return $this->render('saleticket', [
            'model' => $model,
            'model_car'=>$model_car,
            'ordersticket'=>$ordersticket,
            'ordersticket_car'=>$ordersticket_car
        ]);
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