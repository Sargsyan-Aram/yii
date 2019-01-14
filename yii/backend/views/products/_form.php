<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Products */
/* @var $form yii\widgets\ActiveForm */
$categories = \common\models\Categories::find()->all();
$listData=\yii\helpers\ArrayHelper::map($categories,'id','name');
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'category_id')->textInput()->dropDownList(
        $listData,
        ['prompt'=>'Select...'])
    ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'condition')->dropDownList([ 'new' => 'New', 'used' => 'Used', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= \vova07\imperavi\Widget::widget([
        'name' => 'content',
        'settings' => [
            'lang' => 'ru',
        ],
    ]); ?>

    <?= $form->field($model, 'top')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'new')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'sale')->dropDownList([ 1 => '1', 0 => '0', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
