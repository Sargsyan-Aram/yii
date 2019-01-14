<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\User;
use yii\web\Controller;
use yii\web\UploadedFile;

class UserController extends Controller
{
    public function behaviors(){
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['profile'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];

    }
    public function actionProfile()
    {
        if(\Yii::$app->request->isPost) {
            $model = new User();
            $model->avatar =  UploadedFile::getInstance($model, 'avatar');
            if ($model->uploadAvatar()){
                return $this->redirect('/profile');
            }
        }
        $user = \Yii::$app->user->identity['attributes'];
        $model = new User();
        return $this->render('profile',['user'=>$user,'model'=>$model]);
    }

}
