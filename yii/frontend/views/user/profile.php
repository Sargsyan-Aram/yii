<?php
/* @var $this yii\web\View */
/* @var $user \frontend\controllers\UserController*/
/* @var $form yii\bootstrap\ActiveForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Profile';
$this->params['breadcrumbs'][] = $this->title;
\app\assets\AppAsset::register($this);
?>
<div class="container">
    <div class="row text-center" style="padding: 80px">
        <div class="col-md-5">
            <?php if (!$user['avatar']):?>
                <?php if ($user['gender'] == 'male'):?>
                    <img style="width: 250px;" src="/images/gender/male.png" alt="male">
                <?php else:?>
                    <img style="width: 250px;" src="/images/gender/female.png" alt="female">
                <?php endif;?>
            <?php else:?>
                <img src="/images/userAvatars/<?=$user['id']?>_<?=$user['first_name']?>/<?=$user['avatar']?>" alt="female">
            <?php endif;
            ?>
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data','method'=>'post']]) ?>

            <?= $form->field($model, 'avatar')->fileInput() ?>
            <?= Html::hiddenInput('old_avatar', $user['avatar']); ?>

            <button>Change avatar</button>

            <?php ActiveForm::end() ?>
        </div>
        <div class="col-md-7">
            <h2><?=$user['first_name']?> <?=$user['last_name']?></h2>
            <h5>Email ` <?=$user['email']?></h5>
            <h5>Phone ` <?=$user['phone']?></h5>
            <h5>Country ` <?=$user['country']?></h5>
            <h5>City ` <?=$user['city']?></h5>
            <h5>Birthday ` <?=$user['birthday']?></h5>
        </div>
    </div>
</div>

