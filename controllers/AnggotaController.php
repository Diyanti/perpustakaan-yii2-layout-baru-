<?php

namespace app\controllers;

use Yii;
use app\models\Anggota;
use app\models\AnggotaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ArrayHelper;
use PhpOffice\PhpWord\IOfactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;

/**
 * AnggotaController implements the CRUD actions for Anggota model.
 */
class AnggotaController extends Controller
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
     * Lists all Anggota models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnggotaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Anggota model.
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
     * Creates a new Anggota model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Anggota();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Anggota model.
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
     * Deletes an existing Anggota model.
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
     * Finds the Anggota model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Anggota the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Anggota::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Untuk Export Buku ke word

    public function actionExportWord()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $phpWord->setDefaultFontSize(12);
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultParagraphStyle(
        array(
            'align'      => 'both',
            'spaceAfter' => Converter::pointToTwip(0.7),
            'spacing'    => Converter::pointToTwip(1.5),
            )
        );
        $sectionStyle = [
            'marginTop'=>Converter::cmToTwip(2.25),
            'marginBottom'=>Converter::cmToTwip(2.49),
            'marginLeft'=>Converter::cmToTwip(2.6),
            'marginRight'=>Converter::cmToTwip(2.6),
        ];
        $section = $phpWord->addSection($sectionStyle);
        $phpWord->addParagraphStyle('headerPStyle', ['alignment'=>'center']);
        $phpWord->addParagraphStyle('headerPStyleNoSpace', ['alignment'=>'center']);
        $phpWord->addFontStyle('headerFStyle', ['bold'=>true]);
        $phpWord->addParagraphStyle(
            'multipleTabLeft',
            array(
                'tabs' => array(
                    new \PhpOffice\PhpWord\Style\Tab('left', 750),
                    new \PhpOffice\PhpWord\Style\Tab('left', 1050),
                ),
                'align'=>'left'
            )
        );
        $phpWord->addNumberingStyle(
            'multilevel',
            array(
                'type' => 'multilevel',
                'levels' => array(
                    array('format' => 'upperRoman', 'text' => '%1.', 'left' => 400, 'hanging' => 360, 'tabPos' => 360),
                    array('format' => 'decimal', 'text' => '%2.', 'left' => 720, 'hanging' => 360, 'tabPos' => 720),
                )
            )
        );
        //START HEADER
        $header_alamat = ['bold' => true, 'size' => 12];
        $header_style = ['bold' => true, 'size' => 12,];
        $header_page = $section->addHeader();
        $imageStyle = array(
            'width' => 84,
            'wrappingStyle' => 'square',
            'positioning' => 'absolute',
            'posHorizontalRel' => 'margin',
            'posVerticalRel' => 'line',
        );
        $paragraphCenter = [
                'alignment' =>'center',   
            ];
        $paragraphRight = [
            'alignment'=>'right',
        ];
         
        //START Of HEADER
        $textrun = $header_page->addTextRun('headerPStyle');
        $textrun->addImage('images/logo.png', $imageStyle);
        $textrun->addText("\t\t PEMERINTAH KABUPATEN PURBALINGGA", $header_style, 'headerPStyle');
        $header_page->addText("\t\t KECAMATAN KUTASARI", $header_style, 'headerPStyle');
        $header_page->addText("\t\t DESA SUMINGKIR", $header_alamat, 'headerPStyle');
        $header_page->addText("\t\t JALAN PINGIT NOMOR 3303070003", $header_alamat, 'headerPStyle');
        $textrun = $header_page->addTextRun('headerPStyle');
        // Line
        $header_page->addShape(
            'line',
            array(
                'points'  => '1,1 630,0',
                'outline' => array(
                    'color'      => '#000000',
                    'line'       => 'thickThin',
                    'weight'     => 2,
                ),
            )
        );   

        $section->addText(
            'SURAT PENGANTAR IMUNISASI', 
            [
                'underline' => 'single',
                'bold' => true,
            ],
         $paragraphCenter
        );
        $section->addText('Nomor  : ./003/I/2017', $phpWord, $paragraphCenter);
        $section->addTextBreak(2);
        $section->addText("\t Yang bertanda tangan dibawah ini Kepala Desa Sumingkir, Kecamatan Kutasari, Kabupaten Purbalingga ", $phpWord);
        $section->addTextBreak(1);
        $section->addText("\t Menerangkan dengan sesungguhnya  bahwa :", $phpWord);
        $section->addText("\t\t Nama \t\t\t\t:", $phpWord);
        $section->addText("\t\t Tempat/tgl lahir \t\t:", $phpWord);
        $section->addText("\t\t Kewarganegaraan/Agama \t:", $phpWord);
        $section->addText("\t\t Pekerjaan \t\t\t:", $phpWord);
        $section->addText("\t\t Alamat \t\t\t: RT     RW     Desa Sumingkir", $phpWord);
        $section->addText(" \t\t\t\t\t\t  Kecamatan Kutasari Kabupaten Purbalingga", $phpWord);
        $section->addText("\t\t No NIK \t\t\t: .............................", $phpWord);
        $section->addText("\t\t Keperluan \t\t\t: Imunisasi Catin (Calon Pengantin)", $phpWord);
        $section->addText("\t\t Untuk Kepentingan \t\t: Pernikahan", $phpWord);
        $section->addTextBreak(2);
        $section->addText("\t\t Berlaku Mulai \t\t: ................... s/d diterima", $phpWord);
        $section->addText("\t\t Keterangan lain-lain \t\t: Nama Calon mempelai : ", $phpWord);
        $section->addText("\t\t\t\t\t\t  Bin : ", $phpWord);
        $section->addTextBreak(2);
        $section->addText("\t Demikian untuk menjadikan maklum bagi yang berkepentingan.", $phpWord);
        $section->addTextBreak(1);
        $section->addText('Sumingkir,  ......... ', $phpWord, $paragraphRight);
        $section->addText("\t\t Pemohon \t\t\t\t\t\t Kepala Desa Sumingkir", $phpWord);
        $section->addTextBreak(3);
        $section->addText("\t\t ..................\t\t\t\t\t\t  TUTING HARYATI", $header_style);
        $section->addTextBreak(1);
        $section->addText('Mengetahui, ', $phpWord, $paragraphCenter);
        $section->addText('Kecamatan Kutasari ', $phpWord, $paragraphCenter);
        $section->addTextBreak(3);
        $section->addText(".................................", $phpWord, $paragraphCenter);

        $filename = time() . 'export-word.docx';
        $path = 'exportword/' . $filename;
        $xmlWriter = IOfactory::createWriter($phpWord, 'Word2007');
        $xmlWriter -> save($path);
        return $this -> redirect($path);

    }

       
}
