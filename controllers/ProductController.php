<?php

namespace app\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
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
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        if ($model->load(Yii::$app->request->post())) {
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->photo){       
                $photo_name='home_'.date('Ymdhis').'.' . $model->photo->extension;      
                $model->photo->saveAs(\Yii::$app->basePath.'/web/images/' . $photo_name);
                $model->photo=$photo_name;
            }
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
     * Updates an existing Product model.
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

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('yes',Yii::t('app','Deleted successfully.'));
        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}