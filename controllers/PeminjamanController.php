<?php

namespace app\controllers;

use Yii;
use app\models\Peminjaman;
use app\models\PeminjamanSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PeminjamanController implements the CRUD actions for Peminjaman model.
 */
class PeminjamanController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Peminjaman models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PeminjamanSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Peminjaman model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Peminjaman model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($id_buku = null)
    {
        $model = new Peminjaman();
       $model->id_buku = $id_buku;
       $model->status_buku = 1;
       $model->tanggal_kembali = date('Y-m-d', strtotime('+7 days'));
       $model->tanggal_batas_pinjam = '0000-00-00';
       // if (User::isAnggota()) {
       //     $model->id_anggota=1;
       // }

       if (Yii::$app->user->identity->id_user_role == 2) {
           $model->id_anggota = Yii::$app->user->identity->id_anggota;
           $model->tanggal_pinjam = date('Y-m-d');
           $model->tanggal_kembali = date('Y-m-d', strtotime('+7 days'));
           $model->status_buku = 1;
           $model->tanggal_batas_pinjam = '0000-00-00';
           Yii::$app->mail->compose('@app/template/pemberitahuan',['model' => $model])
               ->setFrom('diyantiyan51@gmail.com')
               ->setTo($model->anggota->email)
               ->setSubject('Pemberitahuan - Peminjaman Buku')
               ->send();
           $model->save();
           Yii::$app->session->setFlash('success', 'Berhasil meminjam buku. Silahkan cek email anda.');
           return $this->redirect(['index']);
       }
       
       return $this->render('create', [
           'model' => $model,
       ]);
    }

    /**
     * Updates an existing Peminjaman model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Peminjaman model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Peminjaman model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Peminjaman the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Peminjaman::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionKembalikanBuku($id)
    {
        $model = Peminjaman::findOne($id);
        
        $model->status_buku = 2;
        $model->tanggal_pengembalian_buku = date('Y-m-d');

        $selisih = $model->getSelisih();

        $denda1 = new Denda();
        $denda1->id_peminjaman = $model->id;

        foreach (\app\models\KenaikanDenda::find()->all() as $denda) {
            if ($denda->hari <= $selisih) {
                $model->harga = $denda->harga;
                $denda1->harga = $denda->harga;
            } else {
                $model->harga = 0;
            }
        }

        $model->save(false);
        $denda1->save();

        Yii::$app->session->setFlash('Berhasil', 'Buku sudah berhasil di kembalikan');
        
        if (User::isAdmin()) {
            return $this->redirect(Yii::$app->request->referrer);
        } else {
            return $this->redirect(['peminjaman/index']);
        }
    }
}