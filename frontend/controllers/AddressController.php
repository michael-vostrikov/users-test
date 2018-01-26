<?php

namespace frontend\controllers;

use Yii;
use common\models\Address;
use frontend\models\AddressSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use vitalik74\geocode\Geocode;

/**
 * AddressController implements the CRUD actions for Address model.
 */
class AddressController extends Controller
{
    /**
     * @inheritdoc
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
     * Creates a new Address model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($profile_id)
    {
        $model = new Address();
        $model->profile_id = $profile_id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/profile/view', 'id' => $model->profile_id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Address model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['/profile/view', 'id' => $model->profile_id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Address model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $profile_id = $model->profile_id;
        $model->delete();

        return $this->redirect(['/profile/view', 'id' => $profile_id]);
    }

    /**
     * Returns data for autocomplete ajax request
     */
    public function actionAutocomplete($term = null)
    {
        if (!$term) {
            return [];
        }

        $geo = new Geocode();
        $res = $geo->get($term, ['kind' => 'house']);
        // response GeoObjectCollection metaDataProperty GeocoderResponseMetaData found
        // featureMember i GeoObject metaDataProperty GeocoderMetaData Address formatted

        $cnt = $res['response']['GeoObjectCollection']['metaDataProperty']['GeocoderResponseMetaData']['found'] ?? 0;
        $data = [];
        if ($cnt > 0) {
            $objects = $res['response']['GeoObjectCollection']['featureMember'] ?? [];
            foreach ($objects as $obj) {
                $text = $obj['GeoObject']['metaDataProperty']['GeocoderMetaData']['Address']['formatted'] ?? '';
                if ($text) {
                    $data[] = ['id' => $text, 'label' => $text];
                }
            }
        }

        Yii::$app->response->format = Yii::$app->response::FORMAT_JSON;
        return $data;
    }

    /**
     * Finds the Address model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Address the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Address::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
