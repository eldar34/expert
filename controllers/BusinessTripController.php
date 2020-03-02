<?php

namespace app\controllers;

use Yii;
use app\models\BusinessTrip;
use app\models\BusinessTripSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

use app\models\BuisnessMultiple;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/**
 * BusinessTripController implements the CRUD actions for BusinessTrip model.
 */
class BusinessTripController extends Controller
{
    public $layout = 'admin';
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
     * Lists all BusinessTrip models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BusinessTripSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * First page.
     * @return mixed
     */
    public function actionDefault()
    {
        $userRole = 'админа';
        if(Yii::$app->user->can('supervisor')){
            $userRole = 'руководителя';
        }
        if(Yii::$app->user->can('master')){
            $userRole = 'мастера';
        }
        if(Yii::$app->user->can('director')){
            $userRole = 'директора';
        }
        

        return $this->render('default', [
            'userRole' => $userRole,
            
        ]);
    }

    /**
     * Displays a single BusinessTrip model.
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
     * Creates a new BusinessTrip model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new BusinessTrip();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreatemulti()
    {
        
        if (Yii::$app->request->post()) {

            $models = BuisnessMultiple::createMultiple(BusinessTrip::classname());
            BuisnessMultiple::loadMultiple($models, Yii::$app->request->post());

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($models)
                );
            }

            // validate all models
            
            $valid = BuisnessMultiple::validateMultiple($models);
            
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    
                        foreach ($models as $model) {
                            
                            if (! ($flag = $model->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                        // return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'models' => (empty($models)) ? [new BusinessTrip] : $models
        ]);
    }

    /**
     * Updates an existing BusinessTrip model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if( !Yii::$app->user->can('supervisor')){
            if( !Yii::$app->user->can('updateOwnPost', ['post'=>$model]) ){
                throw new ForbiddenHttpException("Permission Denied", 1);
            } 
        }        

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing BusinessTrip model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if( !Yii::$app->user->can('supervisor')){
            if( !Yii::$app->user->can('updateOwnPost', ['post'=>$model]) ){
                throw new ForbiddenHttpException("Permission Denied", 1);
            } 
        }         

        $model->delete();

        return $this->redirect(['index']);
    }

    public function actionMatching($id)
    {
        $model = $this->findModel($id);

        if( Yii::$app->user->can('master')){
            if( !Yii::$app->user->can('updateOwnPost', ['post'=>$model]) ){
                throw new ForbiddenHttpException("Permission Denied", 1);
            } 
        }         

        $model->status = 2;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionAgreed($id)
    {
        $model = $this->findModel($id);

        if( Yii::$app->user->can('master')){
            if( !Yii::$app->user->can('updateOwnPost', ['post'=>$model]) ){
                throw new ForbiddenHttpException("Permission Denied", 1);
            } 
        }         

        $model->status = 3;
        $model->save();

        return $this->redirect(['index']);
    }

    public function actionDenied($id)
    {
        $model = $this->findModel($id);

        if( Yii::$app->user->can('master')){
            if( !Yii::$app->user->can('updateOwnPost', ['post'=>$model]) ){
                throw new ForbiddenHttpException("Permission Denied", 1);
            } 
        }         

        $model->status = 4;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the BusinessTrip model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BusinessTrip the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = BusinessTrip::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
