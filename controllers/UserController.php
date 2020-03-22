<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserProfile;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post())) {
            $model->password=Yii::$app->getSecurity()->generatePasswordHash($model->password);
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $password_old=$model->password;

        if ($model->load(Yii::$app->request->post())) {
            if($password_old!=$model->password)
            {
                $model->password=Yii::$app->getSecurity()->generatePasswordHash($model->password);
            }
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionProfile()
    {   
        $model=UserProfile::find()->where(['user_id'=>Yii::$app->user->id])->one();
        $updated=false;
        if(!$model)
        {
            $model=new UserProfile();
        }
        $photo_name=$model->photo;
        if ($model->load(Yii::$app->request->post())) {
            $model->user_id=Yii::$app->user->id;
            $model->photo = UploadedFile::getInstance($model, 'photo');
            if ($model->photo){       
                $photo_name='profile_'.date('Ymdhis').'.' . $model->photo->extension;      
                $model->photo->saveAs(\Yii::$app->basePath.'/web/images/' . $photo_name);
                $model->photo=$photo_name;
            }else{
                $model->photo=$photo_name;
            }
            if($model->save())
            {
                $updated=true;
            }
        }
        return $this->render('profile', [
            'model' => $model,
            'updated'=>$updated
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}