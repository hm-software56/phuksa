<?php

namespace app\controllers;

use Yii;
use app\models\ProductOrder;
use app\models\Product;
use app\models\ProductOrderSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\ItemOrder;
/**
 * ProductOrderController implements the CRUD actions for ProductOrder model.
 */
class ProductOrderController extends Controller
{
    public function init()
    {
        if(Yii::$app->user->id){
            Yii::$app->layout="main_admin";
        }
    }
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                 //   'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all ProductOrder models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ProductOrder model.
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
     * Creates a new ProductOrder model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ProductOrder();
        $model->order_code=$model->Getordercode();
        $model->status="Draft";
        $model->user_id=Yii::$app->user->id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach($_POST['product'] as $key=>$list)
            {
                $product=Product::find()->where(['id'=>$list])->one();
                $item=new ItemOrder();
                $item->product_id=$list;
                $item->product_order_id=$model->id;
                $item->unit=$_POST['unit'][$key];
                $item->quatity=$_POST['quatity'][$key];
                $item->price=$_POST['price'][$key];
                $item->product_name=$product->name;
                if(!$item->save())
                {
                    print_r($item->getErrors());
                }else{
                    Yii::$app->session->setFlash('yes',Yii::t('app','ບັນ​ທຶກ​​ສັ່ງ​ຊື້​ສີນ​ຄ້າ​ສຳ​ເລັດ!.'));
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ProductOrder model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            ItemOrder::deleteAll(['product_order_id'=>$model->id]);
            foreach($_POST['product'] as $key=>$list)
            {
                $product=Product::find()->where(['id'=>$list])->one();
                $item=new ItemOrder();
                $item->product_id=$list;
                $item->product_order_id=$model->id;
                $item->unit=$_POST['unit'][$key];
                $item->quatity=$_POST['quatity'][$key];
                $item->price=$_POST['price'][$key];
                $item->product_name=$product->name;
                if(!$item->save())
                {
                    print_r($item->getErrors());
                }
            }
            Yii::$app->session->setFlash('yes',Yii::t('app','​ແກ້​ໄຂ​ການ​ສັ່ງ​ຊື້​ສີນ​ຄ້າ​ສຳ​ເລັດ!.'));
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }
    public function actionOrder($id)
    {
        $model = $this->findModel($id);
        $model->status="Order";
        $model->save();
        Yii::$app->session->setFlash('yes',Yii::t('app','ຢັ້ງ​ຢືນ​​ການສັ່ງ​ຊື້​ສີນ​ຄ້າ​ສຳ​ເລັດ!.'));
        return $this->redirect(['view', 'id' => $model->id]);
    }
    public function actionCancle($id)
    {
        $model = $this->findModel($id);
        $model->status="Cancle";
        $model->save();
        Yii::$app->session->setFlash('yes',Yii::t('app','ຍົກ​ເລີກ​​ການສັ່ງ​ຊື້​ສີນ​ຄ້າ​ສຳ​ເລັດ!.'));
        return $this->redirect(['view', 'id' => $model->id]);
    }
    public function actionDone($id)
    {
        $model = $this->findModel($id);
        $model->status="Done";
        $model->save();
        Yii::$app->session->setFlash('yes',Yii::t('app','ສຳ​ເລັດການສັ່ງ​ຊື້​ສີນ​ຄ້າ​!.'));
        return $this->redirect(['view', 'id' => $model->id]);
    }

    public function actionAdditems()
    {
        return $this->renderAjax('add_items');
    }

    /**
     * Deletes an existing ProductOrder model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('yes',Yii::t('app','ລືບ​ການ​ສັ່ງຊື້​ສີນ​ຄ້າ​ສຳ​ເລັດ!.'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the ProductOrder model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProductOrder the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProductOrder::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}