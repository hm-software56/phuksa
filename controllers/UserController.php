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
        if(Yii::$app->user->identity->type!="Admin")
        {
        $user=User::find()->where(['type'=>Yii::$app->user->identity->type,'status'=>1]);
        }else{
            $user=User::find()->where(['status'=>1]);
        }
        $dataProvider = new ActiveDataProvider([
            'query' =>$user,
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
        $employee=new UserProfile();
        if ($model->load(Yii::$app->request->post()) && $employee->load(Yii::$app->request->post())) {
            $model->password=Yii::$app->getSecurity()->generatePasswordHash($model->password);
            if($model->save()){
                $employee->user_id=$model->id;
                $employee->photo = UploadedFile::getInstance($employee, 'photo');
                if ($employee->photo){       
                    $photo_name='profile_'.date('Ymdhis').'.' . $employee->photo->extension;      
                    $employee->photo->saveAs(\Yii::$app->basePath.'/web/images/' . $photo_name);
                    $employee->photo=$photo_name;
                }
                if($employee->save())
                {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'employee'=>$employee
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
        $employee=UserProfile::find()->where(['user_id'=>$id])->one();
        if (!$employee)
        {
            $employee=new UserProfile();
        }
        $photo_name=$employee->photo;
        if ($model->load(Yii::$app->request->post()) && $employee->load(Yii::$app->request->post())) {
            if($password_old!=$model->password)
            {
                $model->password=Yii::$app->getSecurity()->generatePasswordHash($model->password);
            }
            if($model->save()){
                $employee->user_id=$model->id;
                $employee->photo = UploadedFile::getInstance($employee, 'photo');
                if ($employee->photo){       
                    $photo_name='profile_'.date('Ymdhis').'.' . $employee->photo->extension;      
                    $employee->photo->saveAs(\Yii::$app->basePath.'/web/images/' . $photo_name);
                    $employee->photo=$photo_name;
                }else{
                    $employee->photo=$photo_name;
                }
                if($employee->save())
                {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'employee'=>$employee
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
        #$this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status=0;
        $model->save();
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