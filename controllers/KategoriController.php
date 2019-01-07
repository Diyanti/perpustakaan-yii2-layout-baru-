<?php

namespace app\controllers;

use Yii;
use app\models\Kategori;
use app\models\KategoriSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\web\ArrayHelper;
use PhpOffice\PhpWord\IOfactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;

/**
 * KategoriController implements the CRUD actions for Kategori model.
 */
class KategoriController extends Controller
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
     * Lists all Kategori models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KategoriSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Kategori model.
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
     * Creates a new Kategori model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kategori();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing Kategori model.
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
     * Deletes an existing Kategori model.
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
     * Finds the Kategori model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kategori the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kategori::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionExportWord()
    {
        $phpWord = new phpWord();
        $phpWord -> setDefaultFontSize(11);
        $phpWord -> setDefaultFontName('Footlight MT Light');

        $section = $phpWord->addSection(
                [
                    'marginTop' => Converter::cmTotwip(1.80),
                    'marginBottom' => Converter::cmTotwip(1.80),
                    'marginLeft' => Converter::cmTotwip(1.2),
                    'marginRight' => Converter::cmTotwip(1.6),
                ]
        );

        $fontStyle = [
            'underline' => 'single',
            'bold'      => true,
           
        ];
        $paragraphCenter = [
                'alignment' =>'center',   
            ];

        $headerStyle = [
                'bold' =>true,
            ];

        $paragraphRight = [
            'alignment'=>'right',
        ];

        // $spaceAfter = [
        //     'spaceAfter'=> '0',
        // ];
        $phpWord->setDefaultParagraphStyle(
        array(
        'align' => 'both',
        'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(1),
        'spacing' => 120,
        'lineHeight' => 1,));



        #############======END============##########

        // $section->addImage('../web/lmn.jpg', array('width' => 100 , 'height' => 100, 'alignment' => 'center'));
        $section->addText( 
                'LEMBAGA ADMINISTRASI NEGARA',
                $phpWord,
                $paragraphCenter
        );

        $section->addText(
            'REPUBLIK INDONESIA',
             $phpWord,
            $paragraphCenter
           
        );

          $section->addTextBreak(1);

        $section->addText(
            'UNDANGAN SURVEY HARGA',
            $fontStyle,
            $paragraphCenter,
            $headerStyle
        );
        $section->addTextBreak(1);
          
        $tempat = $section->addTextRun($paragraphRight);
         $section->addText('Nomor  :  151/PP/PBJ 01.02/450417');
        $tempat->addText('Jakarta, 9 Mei 2018', ['alignment'=>'right']);
        $section->addText('Lampiran    :   1 (satu) berkas');

        $section->addTextBreak(1);

        $section->addText('Kepada Yth.');

        $section->addText('Sdr. Thomas Alfa Edison', $headerStyle);

         $section->addText('di Karawang');

         $perihal = $section->addTextRun($phpWord);

        $perihal->addText('Perihal : ');
        $perihal->addText('Penawaran Pengadaan Langsung untuk paket Pekerjaan Pembangunan Sistem Informasi Pengadaan (SIP) Kantor LAN Jakarta');

         $section->addTextBreak(1);

         $section->addText(
            'Dengan ini perusahaan Saudara kami undang untuk memberikan penawaran harga proses Pengadaan Langsung paket Pengadaan Jasa Konsultansi sebagai berikut :');
$section->addTextBreak(1);

         $section->addText(
            '1. Paket Pekerjaan', $headerStyle);

         $section->addText(
            'Nama paket pekerjaan : Pembangunan Sistem Informasi Pengadaan (SIP) Kantor LAN Jakarta',$paragraphCenter);

         $section->addText(
            'Lingkup pekerjaan : Pembangunan Sistem Informasi Pengadaan (SIP)',$paragraphCenter);

         $section->addText(
            'Nilai total HPS : Rp. 10.000.000,- (Sepuluh juta rupiah)', $headerStyle);

         $section->addText(
            'Sumber pendanaan : DIPA Satker 450417 LAN Jakarta Tahun Anggaran 2018');

         $section->addText(
            '2. Pelaksanaan Pengadaan',$headerStyle);

         $section->addText('Tempat dan alamat : Kantor LAN Jakarta, Jl. Veteran No. 10, Jakarta pusat');

         $section->addText('Telepon/Fax : 021 - 3868201-06/021-3455021');

         $webSite = $section->addTextRun(null);
         $webSite->addText('Website : ');
         $webSite->addText('www.lan.go.id',['underline'=> 'single']);

        $terlampir = $section->addTextRun();
        $terlampir->addText('dengan Daftar Kuantitas dan Harga (RAB) serta KAK ');
        $terlampir->addText('TERLAMPIR.',$headerStyle);

        $palingLambat = $section->addTextRun();
        $palingLambat->addText('Apabila Saudara membutuhkan keterangan dan penjelasan lebih lanjut, dapat menghubungi Kami sesuai alamat tersebut di atas dan batas akhir penyerahan penawaran melalui email ');
        $palingLambat->addText('paling lambat sampai dengan hari Senin/14 Mei 2018.', $headerStyle);

        $section->addText('Bagi penyedia yang menyampaikan penawaran terendah dan memenuhi persyaratan kualifikasi yaitu memiliki :');

    $section->addText(
    '1. KTP yang masih berlaku;', $headerStyle);

    $section->addText(
    '2. NPWP;', $headerStyle);

     $section->addText(
    '3. Pajak Tahunan Perorangan Tahun 2017 beserta lampirannya;', $headerStyle);

     $section->addText(
    '4. Ijazah Pendidikan Terakhir;', $headerStyle);

      $section->addText(
    '5. Sertifikat Keahlian dibidang yang sesuai dan masih berlaku.', $headerStyle);

      $section->addTextBreak(1);

      $section->addText(
        'akan diundang untuk memasukkan penawaran dan dilakukan klarifikasi terhadap keaslian dokumen kualifikasi.'
      );

       $section->addTextBreak(1);

       $section->addText(
        'Demikian disampaikan untuk diketahui.'
      );


    
     $filename = time() . 'export-word.docx';
       $path = 'exportfile/'. $filename;
       $xmlWriter = IOfactory::createWriter($phpWord,'Word2007');
       $xmlWriter -> save($path);
       return $this -> redirect($path);
}
}
