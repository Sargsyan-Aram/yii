<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .asd{
        float: left;
    }
  .form-group{
      clear: left;
  }
</style>
<div class="site-signup container text-center">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'first_name') ?>
                <?= $form->field($model, 'last_name')?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'phone')->textInput([
                    'type' => 'number'
                ]) ?>
                <?= $form->field($model, 'country')->textInput() ?>
                <?= $form->field($model, 'city')->textInput() ?>
                <div class="col-md-3"></div>
                <?= $form->field($model, 'gender',['options' => ['class' => 'asd col-md-3']])->radio(['label'=>'Male','value'=>'male','uncheck' => null]) ?>
                <?= $form->field($model, 'gender',['options' => ['class' => 'asd col-md-3']])->radio(['label'=>'Female','value'=>'female','uncheck' => null]) ?>
                <?= $form->field($model, 'birthday')->input('date')?>
            <br>
                <div class="form-group">
                    <?= Html::submitButton('Signup', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
