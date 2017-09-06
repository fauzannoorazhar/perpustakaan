<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Anggota;
use app\models\User;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionInfo()
    {
        return $this->render('info');

    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            /*print $gambar->name;
                die;*/
            return $this->goHome();
        }

        $this->layout = '@app/views/layouts/login';

        $model = new LoginForm(); //Create Object Baru
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout(false); //Menyimpan data sesi Yii::$app->user->logout(false)
        /*print $user->logout;
        die;*/
        /*return $this->goHome();*/
        return $this->redirect(['site/login']);
    }

    public function actionRegister()
    {

        $model = new Anggota();

        if ($model->load(Yii::$app->request->post() && $model->save()) ){
            $model->createUser();//Membuat User Baru. Method dari models angggota
            $model->sendMailToUser();
            $model->sendMailToAdmin();
            return $this->redirect(['site/login']);
        } else {
           return $this->render('register', [
                'model' => $model
            ]);
        }
    }

    public function actionTes()
    {
        
    }
}
