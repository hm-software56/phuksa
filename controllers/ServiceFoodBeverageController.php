<?php

namespace app\controllers;

use Yii;
use app\models\ServiceFoodBeverage;
use app\models\ServiceFoodBeverageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\SaleFoodBeverage;
use app\models\ItemFoodBeverage;
/**
 * ServiceFoodBeverageController implements the CRUD actions for ServiceFoodBeverage model.
 */
class ServiceFoodBeverageController extends Controller
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
     * Lists all ServiceFoodBeverage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ServiceFoodBeverageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ServiceFoodBeverage model.
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
     * Creates a new ServiceFoodBeverage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ServiceFoodBeverage();

        if ($model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->photo){       
                $photo_name='pd_'.date('Ymdhis').'.' . $model->photo->extension;      
                $model->photo->saveAs(\Yii::$app->basePath.'/web/images/' . $photo_name);
                $model->photo=$photo_name;
            }
            $model->date=date('Y-m-d');
            $model->user_id=Yii::$app->user->id;
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
     * Updates an existing ServiceFoodBeverage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $photo_name=$model->photo;

        if ($model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->photo){       
                $photo_name='home_'.date('Ymdhis').'.' . $model->photo->extension;      
                $model->photo->saveAs(\Yii::$app->basePath.'/web/images/' . $photo_name);
                $model->photo=$photo_name;
            }else{
                $model->photo=$photo_name;
            }
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

    public function actionSale()
    {
        $model=ServiceFoodBeverage::find()->all();
        return $this->render('sale',['model'=>$model]);
    }

    public function actionOrder($id) 
    {
        $model = ServiceFoodBeverage::find()->where(['id'=>$id])->one();
        if($model)
        {
            if (!empty(\Yii::$app->session['product'])) {
                $array = [];
                if(!in_array($id, \Yii::$app->session['product_id']))
                {
                    $array[$model->id]=1;
                    \Yii::$app->session['product_id']=array_merge(array($model->id),\Yii::$app->session['product_id']);
                    \Yii::$app->getSession()->setFlash('su',$model->id);
                //  \Yii::$app->getSession()->setFlash('success','ເພີ່ມ​ສີ​ນ​ຄ້າ​ແລ້ວ.......');
                        
                }
                foreach (\Yii::$app->session['product'] as $order_p=>$qautity) {
                    if($order_p==$model->id)
                    {
                        $array[$order_p]=$qautity+1;
                        \Yii::$app->getSession()->setFlash('su',$order_p);
                    //  \Yii::$app->getSession()->setFlash('success','ເພີ່ມ​ສີ​ນ​ຄ້າ​ແລ້ວ.......');
                    
                    }else{
                        $array[$order_p]=$qautity;
                    }    
                } 
                Yii::$app->session['product'] =$array;
            } else {
                \Yii::$app->session['product'] = [$model->id =>1];
                \Yii::$app->session['product_id'] = [$model->id];
            }
        }
        return $this->renderAjax('order', [
        ]);
    }
    public function actionOrdercancle() {
        unset(Yii::$app->session['product']);
        return $this->renderAjax('order');
    }
    public function actionConfirmpay($id) {
        if($id==1)
        {
            $salefood=new SaleFoodBeverage;
            $salefood->status="Paid";
            $salefood->date=date('Y-m-d H:i:s');

        }
        return $this->renderAjax('confirm_pay');
    }

    public function actionOrderdelete($id) {
        if (!empty(\Yii::$app->session['product'])) {
            $array = [];
            $product_id = [];
            foreach (\Yii::$app->session['product'] as $order_p=>$qautity) {
                    if($order_p!=$id)
                    {
                        $array[$order_p]=$qautity;
                        $product_id[]=$order_p;
                    }    
            } 
            \Yii::$app->session['product_id'] = $product_id;
            Yii::$app->session['product'] = $array;
        }
        return $this->renderAjax('order');
    }
    /**
     * Deletes an existing ServiceFoodBeverage model.
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
     * Finds the ServiceFoodBeverage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ServiceFoodBeverage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ServiceFoodBeverage::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
