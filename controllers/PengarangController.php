<?php

namespace app\controllers;

use Yii;
use app\models\Pengarang;
use app\models\PengarangSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;
use kartik\mpdf\Pdf;

/**
 * PengarangController implements the CRUD actions for Pengarang model.
 */
class PengarangController extends Controller
{
    /**
     * @inheritdoc
     */
   public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [ 
                    [
                        'actions' => ['signup','login'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['index','logout','view','create','update','delete','ekspor-pdf','ekspor-excel'],
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

    /**
     * Lists all Pengarang models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PengarangSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pengarang model.
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
     * Creates a new Pengarang model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Pengarang();

        if ($model->load(Yii::$app->request->post())) {

            $gambar = UploadedFile::getInstance($model, 'gambar');
            
            if(is_object($gambar))
            {
                $model->gambar = $gambar->baseName;
                $model->gambar .= Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
                $model->gambar .= '.' . $gambar->extension;
                
                $path = Yii::getAlias('@app').'/web/uploads/'.$model->gambar;
                $gambar->saveAs($path, false);
            }

            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            } 
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pengarang model.
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
            
            $gambar = UploadedFile::getInstance($model, 'gambar');

            // kondisi yang tidak mengharuskan menambah gambar lagi
            if(is_object($gambar)){
                $model->gambar = $gambar->baseName;
                $model->gambar .= Yii::$app->formatter->asTimestamp(date('Y-d-m h:i:s'));
                $model->gambar .= '.' . $gambar->extension;
                //@path Penyimpanan Jelas
                $path = Yii::getAlias('@app').'/web/uploads/';

                $gambar->saveAs($path.$model->gambar, false);

                if(file_exists($path.$gambar_lama) AND $gambar_lama!=null)
                {
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

        $model = new Pengarang();

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

        $time = date("YmdHis");

        $pdf->filename = "Pengarang".($time).".pdf";
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }

    /**
     * Deletes an existing Pengarang model.
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
     * Finds the Pengarang model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pengarang the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pengarang::findOne($id)) !== null) {
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

        $PHPExcel->getActiveSheet()->mergeCells('A1:D2');
        $PHPExcel->getActiveSheet()->setCellValue('A1', 'Data Pengarang');
        $PHPExcel->getActiveSheet()->getStyle('A1:D2')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $PHPExcel->getActiveSheet()->getStyle('A1:D2')->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $PHPExcel->getActiveSheet()
        ->setCellValue('A3', 'No')
        ->setCellValue('B3', 'Nama Pengarang')
        ->setCellValue('C3', 'Jenis Kelamin')
        ->setCellValue('D3', 'Tanggal Lahir');

        $row = 4;
        $i=1;
        foreach (Pengarang::find()->all() as $data) {
            $PHPExcel->getActiveSheet()->setCellValue('A'.$row, $i);
            $PHPExcel->getActiveSheet()->setCellValue('B'.$row, $data->nama);
            $PHPExcel->getActiveSheet()->setCellValue('C'.$row, $data->getNamaJenisKelamin());
            $PHPExcel->getActiveSheet()->setCellValue('D'.$row, $data->tanggal_lahir);

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

        $PHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($styleArray);
        $PHPExcel->getActiveSheet()->getStyle('A4:D'.$row)->applyFromArray($styleArray);
        $PHPExcel->getActiveSheet()->getStyle('A3:D3')->getFont()->setBold(true);
        $PHPExcel->getActiveSheet()->getStyle('A3:D3')->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $PHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $PHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25);
        $PHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(25);     
        $PHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(25);

        $i = 1;
        $row=4;


        header('Content-Type: application/vnd.ms-excel');
        $filename = time().'Pengarang.xlsx';
        header('Content-Disposition: attachment;filename='.$filename .' ');
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($PHPExcel, 'Excel2007');
        $objWriter->save('php://output'); 
    }
}
