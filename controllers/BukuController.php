<?php

namespace app\controllers;

use Yii;
use app\models\Buku;
use app\models\BukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ArrayHelper;

/**
 * BukuController implements the CRUD actions for Buku model.
 */
class BukuController extends Controller
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
     * Lists all Buku models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BukuSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Buku model.
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
     * Creates a new Buku model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       $model = new Buku();

        //Mengambil data (get) dari from setiap tabel untuk dimunculkan di (tambah buku) untuk otomatis ada di masing-masing

        // $model->id_kategori = $id_kategori;
        // $model->id_penulis = $id_penulis;
        // $model->id_penerbit = $id_penerbit;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            //ambil file berkas dan file sampul yg ada di form
            $sampul = UploadedFile::getInstance($model, 'sampul');
            $berkas = UploadedFile::getInstance($model, 'berkas');

            //merubah nama filenya
            $model->sampul = time() . '_' . $sampul->name;
            $model->berkas = time() . '_' . $berkas->name;

            //save data ke database
            $model->save(false);

            //lokasi untuk menyimpan file
            $sampul->saveAs(Yii::$app->basePath . '/web/upload/' . $model->sampul);
            $berkas->saveAs(Yii::$app->basePath . '/web/upload/' . $model->berkas);


            //Menuju ke view id yg data di buat
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Buku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        //Mengambil data lama di database
        $sampul_lama = $model->sampul;
        $berkas_lama = $model->berkas;

        if ($model->load(Yii::$app->request->post()) && $model->validate()){

            //Mengambil data baru di layout form
            $sampul = UploadedFile::getInstance($model, 'sampul');
            $berkas = UploadedFile::getInstance($model, 'berkas');

            //Jika ada data file yang dirubah maka data lama akan dihapus dan diganti dengan data baru yang sudah diambil 

            if ($sampul !== null) {
                unlink(Yii::$app->basePath . '/web/upload/' . $sampul_lama);
                $model->sampul = time() . '_' . $sampul->name;
                $sampul->saveAs(Yii::$app->basePath . '/web/upload/' . $model->sampul);

            } else {
                $model->sampul = $sampul_lama;
            }

            if ($berkas !== null) {
                unlink(Yii::$app->basePath . '/web/upload/' . $berkas_lama);
                $model->berkas = time() . '_' .$berkas->name;
                $berkas->saveAs(Yii::$app->basePath . '/web/upload/' . $model->berkas);
            } else {
                $model->berkas = $berkas_lama;
            }

            //Simpan ke database
            $model->save(false);

            //Menuju ke view id yang datanya sudah dibuat
            return $this->redirect(['view', 'id' => $model->id]);
        }
            return $this->render('update', ['model' => $model,]);
    }

    /**
     * Deletes an existing Buku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
       $model = $this->findModel($id);

      //Basepath sebagai tempatnya 
      unlink(Yii::$app->basePath . '/web/upload/' . $model->sampul);
      unlink(Yii::$app->basePath . '/web/upload/' . $model->berkas);

      $model->delete();

      //redirect untuk menunjukan tempat kemana akan kembali, disini kembalinya menuju ke Index
        return $this->redirect(['index']);
    }

    /**
     * Finds the Buku model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Buku the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Buku::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
