<?php

namespace app\controllers;
                                                                                                                                                                                      
use Yii;
use app\models\Penerbit;
use app\models\PenerbitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ArrayHelper;
use PhpOffice\PhpWord\IOfactory;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Shared\Converter;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use app\components\Helper;
use kartik\mpdf\Pdf;

/**
 * PenerbitController implements the CRUD actions for Penerbit model.
 */
class PenerbitController extends Controller
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
     * Lists all Penerbit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PenerbitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         if (Yii::$app->request->get('export')) {
            return $this->exportExcel(Yii::$app->request->queryParams);
        }
        if (Yii::$app->request->get('export-pdf')) {
            return $this->exportPdf(Yii::$app->request->queryParams);
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Penerbit model.
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
     * Creates a new Penerbit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Penerbit();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Penerbit model.
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
     * Deletes an existing Penerbit model.
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
     * Finds the Penerbit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Penerbit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Penerbit::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    //Export penulis ke word
    public function actionPenerbitWord()
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
            'Daftar Penerbit',
            $headerStyle,
            $fontStyle,
            $paragraphCenter
        );

        $section->addText(
            'RINCIAN DARI TABEL PENERBIT',
            $headerStyle,
            $paragraphCenter
        );

        $section->addTextBreak(1);

        $judul = $section->addTextRun($paragraphCenter);

        $judul->addText('Keterangan dari ', $fontStyle);
        $judul->addText('Tabel ', ['italic' =>true]);
        $judul->addText('Penerbit ', ['bold' =>true]);

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

        $semuaPenerbit = Penerbit::find()->all();
        $nomor = 1;
        foreach ($semuaPenerbit as $penerbit) {
        $table->addRow(null);
        $table->addCell(500)->addText($nomor++, null, $headerStyle, $paragraphCenter);
        $table->addCell(5000)->addText($penerbit->nama, null);
        $table->addCell(5000)->addText($penerbit->alamat, null, $paragraphCenter);
        $table->addCell(5000)->addText($penerbit->telepon, null, $paragraphCenter);
        $table->addCell(5000)->addText($penerbit->email, null, $paragraphCenter);
    }

        $filename = time() . 'penerbit-word.docx';
        $path = 'exportwordpenulis/' . $filename;
        $xmlWriter = IOfactory::createWriter($phpWord, 'Word2007');
        $xmlWriter -> save($path);
        return $this -> redirect($path);
    }

        //Untuk export ke excel    
    public function exportExcel($params)
    {
        $spreadsheet = new Spreadsheet();
        
        $spreadsheet->setActiveSheetIndex(0);
        
        $sheet = $spreadsheet->getActiveSheet();
        
        $setBorderArray = array(
            'borders' => array(
                'allBorders' => array(
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => array('argb' => '000000'),
                ),
            ),
        );

        $sheet->getColumnDimension('A')->setWidth(5);
        $sheet->getColumnDimension('B')->setWidth(25);
        $sheet->getColumnDimension('C')->setWidth(30);
        $sheet->getColumnDimension('D')->setWidth(30);
        $sheet->getColumnDimension('E')->setWidth(30);

        $sheet->setCellValue('A3', strtoupper('No'));
        $sheet->setCellValue('B3', strtoupper('Nama'));
        $sheet->setCellValue('C3', strtoupper('Alamat'));
        $sheet->setCellValue('D3', strtoupper('Telepon'));
        $sheet->setCellValue('E3', strtoupper('Email'));
       

        $spreadsheet->getActiveSheet()->setCellValue('A1', 'DATA PENERBIT');

        $spreadsheet->getActiveSheet()->getStyle('A3:E3')->getFill()->setFillType(Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A3:E3')->getFill()->getStartColor()->setARGB('d8d8d8');
        $spreadsheet->getActiveSheet()->mergeCells('A1:E1');
        $spreadsheet->getActiveSheet()->getDefaultRowDimension('3')->setRowHeight(25);
        $sheet->getStyle('A1:E3')->getFont()->setBold(true);
        $sheet->getStyle('A1:E3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $row = 3;
        $i=1;

        $searchModel = new PenerbitSearch();

        foreach($searchModel->getQuerySearch($params)->all() as $data){

            $row++;
            $sheet->setCellValue('A' . $row, $i);
            $sheet->setCellValue('B' . $row, $data->nama);
            $sheet->setCellValue('C' . $row, $data->alamat);
            $sheet->setCellValue('D' . $row, $data->telepon);
            $sheet->setCellValue('E' . $row, $data->email);
            
            $i++;
        }

        $sheet->getStyle('A3:E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('D3:E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('E3:E' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);


        $sheet->getStyle('C' . $row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $sheet->getStyle('A3:E' . $row)->applyFromArray($setBorderArray);

        $filename = time() . 'Data Penerbit.xlsx';
        $path = 'exports/' . $filename;
        $writer = new Xlsx($spreadsheet);
        $writer->save($path);

        return $this->redirect($path);
    }
    //untuk export pdf penerbit
    public function exportPdf($params)
    {
        $searchModel = new PenerbitSearch();
        $searchModel = $searchModel->getQuerySearch($params)->all();
        
        $content = $this->renderPartial('/site/exportpdfpenerbit',['model' => $searchModel]);

        $cssInline = <<<CSS
        table {
            *border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }
        .table-pdf td, .table-pdf th {
            padding: 10px;
            border: 1px solid #0000;
            text-align: center;
        }
        .table-pdf th {
            border: 1px solid #0000;
            background-color: #eee;
            text-align: center;
        }
        .center{
            text-align: center;
        }
CSS;

        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
            'marginLeft' => 10,
            'marginRight' => 10,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => $cssInline,
             // set mPDF properties on the fly
            'options' => ['title' => 'Linen - Supervisi Outsourcing'],
             // call mPDF methods on the fly
            'methods' => [
                'SetHeader'=> [null],
                'SetFooter'=> [null],
            ]
        ]);

        $date = date('Y-m-d His');

        $pdf->filename = "Penerbit - ".$date.".pdf";

        // return the pdf output as per the destination setting
        return $pdf->render();
    }

}
