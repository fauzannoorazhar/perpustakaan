<?php

namespace app\controllers;

use Yii;
use app\models\Buku;
use app\models\BukuSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;


/**
 * BukuController implements the CRUD actions for Buku model.
 */
class BukuController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [//AccessControl menyediakan kontrol akses sederhana berdasarkan aturan perangkat  
                'class' => AccessControl::className(),
                'rules' => [ 
                    [
                        'actions' => ['signup','login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['daftar-buku','index','logout','view','create','update','ekspor-pdf','ekspor-excel','ekspor-word','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction'
            ]
        ];
    }


    public function actionDaftarBuku()
    {
        return $this->render('daftar_buku');
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

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Action Tambah Berkas Upload 
            $gambar = UploadedFile::getInstance($model, 'gambar');

            if(is_object($gambar))//is_object adalah fungsi yang digunakan unutuk mengetahui apakah sebuhab variabel bernilai objek atau tidak
            {
                $model->gambar = $gambar->baseName; 
                /*print $gambar->name;
                die;*/
                $model->gambar .= Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
                $model->gambar .= '.' . $gambar->extension;

                $path = Yii::getAlias('@app').'/web/uploads/'.$model->gambar;
                $gambar->saveAs($path, false);
            }
            if($model->save()){
            return $this->redirect(['index', 'id' => $model->id]);
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Buku model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        // Untuk merubah atau update gambar, jadi tidak perlu menambah gambar lagi ketika akan mengupdate gambar
        $gambar_lama = $model->gambar;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Action Tambah Berkas Upload 
            $gambar = UploadedFile::getInstance($model, 'gambar');

            // kondisi yang tidak mengharuskan menambah gambar lagi
            if(is_object($gambar)){
                $model->gambar = $gambar->baseName;//Nama dasar file uploads
                $model->gambar .= Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
                $model->gambar .= '.' . $gambar->extension;
                //@path Penyimpanan Jelas
                $path = Yii::getAlias('@app').'/web/uploads/';

                $gambar->saveAs($path.$model->gambar, false);

                //Memerikasi apakah file dalam di rektori ada
                if(file_exists($path.$gambar_lama) AND $gambar_lama!=null)
                {
                    //Menghapus file
                    unlink($path.$gambar_lama);
                }

            } else {
                $model->gambar = $gambar_lama;
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionEksporPdf()
    {
       // get your HTML raw content without any layouts or scripts

        $model = new Buku();

        $content = $this->renderPartial('_ekspor',['model'=>$model]);
        
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Krajee Report Title'],
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>['Perpustakan'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);

        $time = date('YmdHis');

        $pdf->filename = "buku".$time.".pdf";
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    /**
     * Deletes an existing Buku model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

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
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionEksporExcel()
    {
        $PHPExcel = new \PHPExcel();
        $sheet=0;                  
        $PHPExcel->setActiveSheetIndex($sheet);

        $PHPExcel->getActiveSheet()->mergeCells('A1:E2');
        $PHPExcel->getActiveSheet()->setCellValue('A1', 'Data Buku');
        $PHPExcel->getActiveSheet()->getStyle('A1:E2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $PHPExcel->getActiveSheet()->getStyle('A1:E2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $PHPExcel->getActiveSheet()
        ->setCellValue('A3', 'No')
        ->setCellValue('B3', 'Nama Pengarang')
        ->setCellValue('C3', 'Nama Buku')
        ->setCellValue('D3', 'Nama Kategori')
        ->setCellValue('E3', 'Tanggal Terbit');

        $row = 4;
        $i=1;
        foreach (Buku::find()->all() as $data) {
            $PHPExcel->getActiveSheet()->setCellValue('A'.$row, $i);
            $PHPExcel->getActiveSheet()->setCellValue('B'.$row, $data->getRelationField("pengarang","nama"));
            $PHPExcel->getActiveSheet()->setCellValue('C'.$row, $data->nama);
            $PHPExcel->getActiveSheet()->setCellValue('D'.$row, $data->getRelationField("kategori","nama"));
            $PHPExcel->getActiveSheet()->setCellValue('E'.$row, $data->tanggal_terbit);

            $row++;
            $i++;

        }

        $row--;

        $styleArray = [
            'borders' => [
                'allborders' => [
                    'style' => \PHPExcel_Style_Border::BORDER_THIN
                ]
            ]
        ]; 

        $PHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);

        $PHPExcel->getActiveSheet()->getStyle('A3:E3')->applyFromArray($styleArray);
        $PHPExcel->getActiveSheet()->getStyle('A4:E'.$row)->applyFromArray($styleArray);
        $PHPExcel->getActiveSheet()->getStyle('A3:E3')->getFont()->setBold(true);
        $PHPExcel->getActiveSheet()->getStyle('A3:E3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);     
        $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);
        $PHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(25);

        $i = 1;
        $row=4;


        header('Content-Type: application/vnd.ms-excel');
        $filename = time().'buku.xlsx';
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output'); 
    }


    public function actionEksporWord()
    {

        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $phpWord->setDefaultFontName('Arial Narrow');
        $phpWord->setDefaultFontSize(12);
        $phpWord->setDefaultParagraphStyle(
        array(
            'align'      => 'both',
            'spaceAfter' => Converter::pointToTwip(0),
            'spacing'    => 0,
            )
        );
        $sectionStyle = [
            'marginTop'=>Converter::cmToTwip(1.6),
            'marginLeft'=>Converter::cmToTwip(2),
            'marginBottom'=>Converter::cmToTwip(1.25),
            'marginRight'=>Converter::cmToTwip(2),
        ];

        $section = $phpWord->addSection($sectionStyle);

        $phpWord->addParagraphStyle('headerPStyle', ['alignment'=>'center','spaceAfter'=>Converter::pointToTwip(10)]);
        $phpWord->addParagraphStyle('headerPStyleNoSpace', ['alignment'=>'center']);
        $phpWord->addFontStyle('headerFStyle', ['bold'=>true]);

        $imageStyle = array(
            'width' => 90,
            'height' => 76,
            'wrappingStyle' => 'square',
            'alignment'=>'center'
        );

        //START HEADER

        $section->addImage('images/gambar.png',$imageStyle);

        $section->addText("TEST",'headerFStyle','headerPStyle');
        $section->addText("TEST2",'headerFStyle','headerPStyle');

        $section->addTextBreak(1);

        $phpWord->addTableStyle('tabelPeserta');
        $table = $section->addTable('tabelPeserta');

        $tableStyle = [
            'cellMarginRight'=>Converter::cmToTwip(0.19),
            'cellMarginLeft'=>Converter::cmToTwip(0.19),
            'borderColor'=>'000000',
            'borderSize'=>1,
            'alignment'=>\PhpOffice\PhpWord\SimpleType\JcTable::CENTER
        ];
        $firstRowStyle = [
            'bgColor'=>'BFBFBF',
        ];

        $headerRowStyle = [
            'cantSplit'=>true,
            'tblHeader'=>true,
        ];

        $cellStyle = array('valign' => 'center');


/*      $table->addRow(Converter::cmToTwip(1),$headerRowStyle);
        $table->addCell(Converter::cmToTwip(1.08),$cellStyle)->addText("NO.");
        $table->addCell(Converter::cmToTwip(5.63),$cellStyle)->addText("NAMA.");
        $table->addCell(Converter::cmToTwip(1.25),$cellStyle)->addText("NDH.");
        $table->addCell(Converter::cmToTwip(6.7),$cellStyle)->addText("INSTANSI.");
        $table->addCell(Converter::cmToTwip(3.25),$cellStyle)->addText("KUALIFIKASI\nKELULUSAN");

        $i=1;
        foreach ($model->pesertas as $peserta) {
            $table->addRow(Converter::cmToTwip(0.9),['exactHeight'=>false]);
            $table->addCell(Converter::cmToTwip(1.08),$cellStyle)->addText($i.'.');
            $table->addCell(Converter::cmToTwip(5.63),$cellStyle)->addText($peserta->nama,null,['align'=>'left']);
            $table->addCell(Converter::cmToTwip(1.25),$cellStyle)->addText($i++,null,['align'=>'center']);
            $table->addCell(Converter::cmToTwip(6.7),$cellStyle)->addText($peserta->jabatan,null,['align'=>'center']);
            $table->addCell(Converter::cmToTwip(3.25),$cellStyle)->addText('Memuaskan',null,['align'=>'center']);
        }*/

        //END OF END DOC TTD

        $filename = time().'_data_buku.docx';
        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');
        $xmlWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $xmlWriter->save("php://output");


    }



}
