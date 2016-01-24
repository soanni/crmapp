<?php

namespace app\controllers;
use app\models\user\LoginForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use Yii;

class SiteController extends Controller{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login','logout'],
                'rules' => [
                    [
                        'actions' => ['login'],
                        'roles' => ['?'],
                        'allow' => true
                    ],
                    [
                        'actions' => ['logout'],
                        'roles' => ['@'],
                        'allow' => true
                    ]
                ]
            ]
        ];
    }

    public function actionIndex(){
        return $this->render('homepage');
    }

    public function actionDocs(){
        return $this->render('docindex.md');
    }

    public function actionLogin(){
        if(!Yii::$app->user->isGuest){
            return $this->goHome();
        }
        $model = new LoginForm();
        if($model->load(Yii::$app->request->post()) && $model->login()){
            return $this->goBack();
        }

        return $this->render('login', compact('model'));
    }

    public function actionLogout(){
        Yii::$app->user->logout();
        return $this->goHome();
    }
}