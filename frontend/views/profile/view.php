<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Profile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'surname',
            'phone',
            'birth_date',
            ['attribute' => 'gender', 'value' => function ($model) {
                return ($model::getGenderList()[$model->gender] ?? '');
            }],
        ],
    ]) ?>



    <br>

    <h2><?= Yii::t('app', 'Addresses') ?></h2>

    <p>
        <?= Html::a(Yii::t('app', 'Create Address'), ['/address/create', 'profile_id' => $model->id], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => new yii\data\ActiveDataProvider(['query' => $model->getAddresses(), 'pagination' => false]),
        'columns' => [
            'id',
            'profile_id',
            'name',
            'address',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}', 'urlCreator' => function ($action, $model) {
                return ['/address/'.$action, 'id' => $model->id];
            }],
        ],
    ]); ?>
</div>
