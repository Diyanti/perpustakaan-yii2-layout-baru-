<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use Mpdf\Mpdf;
use app\models\Buku;
use app\models\User;
use app\models\Anggota;
use app\models\RegisterForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function verifyCode()
    {
        return[
                'captcha' => [
                    'class' => 'yii\captcha\CaptchaAction',
                    'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                ],
        ];
    }
    
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
     * {@inheritdoc}
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // return $this->render('dashboard');
         if (!Yii::$app->user->isGuest)
        {
            return $this->redirect(['site/dashboard']);
        } else {
            return $this->redirect(['site/login']);
        }
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        // if (!Yii::$app->user->isGuest) {
        //     return $this->goHome();
        // }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    // Custom Sendiri untuk dashboard
    public function actionDashboard()
    {
        // if (User::isAdmin() || User::isAnggota()) {
         if (User::isAdmin()) {
            return $this->render('dashboard');

        } elseif (User::isAnggota()) {
            return $this->render('dashboard');
            
        } elseif (User::isPetugas()) {
            return $this->render('dashboard');
        }
        else
        {
            return $this->redirect(['site/login']);
        }
        // return $this->render('dashboard');
    }

    //untuk membuat register sendiri
    public function actionRegister()
    {
        //agar secara otomatis membuat sendiri
        $this->layout='main-login';
        //$model untuk layout register
        $model = new RegisterForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $anggota = new Anggota();
            $anggota->nama = $model->nama;
            $anggota->alamat = $model->alamat;
            $anggota->telepon = $model->telepon;
            $anggota->email = $model->email;
            $anggota->save();

            $user = new User();
            $user->username = $model->username;
            $user->password = $model->password;
            $user->id_anggota = $anggota->id;
            $user->id_petugas = 0;
            $user->id_user_role = 2;
            $user->status = 2;
            $user->save();

            return $this->redirect(['site/login']);
        } 

        //untuk memunculkan form dari halaman register
        return $this->render('register', ['model'=>$model]);
    }

     //Untuk Export ke PDF
    public function actionExportPdf() 
   {
         $this->layout='main1';
         $model = Buku::find()->All();
         $mpdf=new mPDF();
         $mpdf->WriteHTML($this->renderPartial('template',['model'=>$model]));
         $mpdf->Output('DataBuku.pdf', 'D');
         exit;
   }
}
