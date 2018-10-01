<?php

namespace app\controllers;

use Yii;
use app\models\Penulis;
use app\models\PenulisSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ArrayHelper;
use PhpOffice\PhpWord\IOfactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;

/**
 * PenulisController implements the CRUD actions for Penulis model.
 */
class PenulisController extends Controller
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
     * Lists all Penulis models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenulisSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penulis model.
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
     * Creates a new Penulis model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penulis();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Penulis model.
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
     * Deletes an existing Penulis model.
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
     * Finds the Penulis model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penulis the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penulis::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Export penulis ke word
    public function actionPenulisWord()
    {
        $phpWord = new phpWord();
        $section = $phpWord->addSection(
            [
                'marginTop' => Converter::cmTotwip(1.80),
                'marginBottom' => Converter::cmTotwip(1.80),
                'marginLeft' => Converter::cmTotwip(1.2),
                'marginRight' => Converter::cmTotwip(1.6),
            ]
        );

        $fontStyle = [
            'underline' => 'dash',
            'bold' => true,
            'italic' => true,
        ];
        $paragraphCenter =[
        'alignment' =>'center',
        ];

        $headerStyle = [
            'bold' => true,
        ];

        $section->addText(
            'Daftar Penulis',
            $headerStyle,
            $fontStyle,
            $paragraphCenter
        );

        $section->addText(
            'RINCIAN DARI TABEL PENULIS',
            $headerStyle,
            $paragraphCenter
        );

        $section->addTextBreak(1);

        $judul = $section->addTextRun($paragraphCenter);

        $judul->addText('Keterangan dari ', $fontStyle);
        $judul->addText('Tabel ', ['italic' =>true]);
        $judul->addText('Penulis ', ['bold' =>true]);

        $table = $section->addTable([
            'alignment' => 'center',
            'bgColor' => 6,
            'borderSize' => 6,
            
        ]);
        $table->addRow(null);
        $table->addCell(500)->addText('NO', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Nama', $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText('Alamat', $headerStyle, $paragraphCenter);
        $table->addCell(200)->addText('Telepon', $headerStyle, $paragraphCenter);
        $table->addCell(200)->addText('Email', $headerStyle, $paragraphCenter);

        $semuaPenulis = Penulis::find()->all();
        $nomor = 1;
        foreach ($semuaPenulis as $penulis) {
        $table->addRow(null);
        $table->addCell(500)->addText($nomor++, null, $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText($penulis->nama, null);
        $table->addCell(5000)->addText($penulis->alamat, null, $paragraphCenter);
        $table->addCell(5000)->addText($penulis->telepon, null, $paragraphCenter);
        $table->addCell(5000)->addText($penulis->email, null, $paragraphCenter);
    }

        $filename = time() . 'penulis-word.docx';
        $path = 'exportwordpenulis/' . $filename;
        $xmlWriter = IOfactory::createWriter($phpWord, 'Word2007');
        $xmlWriter -> save($path);
        return $this -> redirect($path);
    }
}
