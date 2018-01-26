<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\typeahead\Typeahead;
use yii\jui\AutoComplete;

/* @var $this yii\web\View */
/* @var $model common\models\Address */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="address-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->widget(AutoComplete::classname(), [
        'options' => ['class' => 'form-control', 'data-url' => Url::to(['/address/autocomplete'])],
        'clientOptions' => [
            'source' => new \yii\web\JsExpression("function (request, response) {
                var url = $('#address-address').data('url');
                $.get(url, {term: request.term}, function (data) {
                    response(data);
                });
            }"),
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
