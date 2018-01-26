<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Address */

$this->title = Yii::t('app', 'Create Address');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Profiles'), 'url' => ['/profile/index']];
$this->params['breadcrumbs'][] = ['label' => $model->profile->name, 'url' => ['/profile/view', 'id' => $model->profile_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
