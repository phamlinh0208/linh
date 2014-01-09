<?php

class SurveyController extends RController
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/lefty';

	/**
	 * @var CActiveRecord the currently loaded data model instance.
	 */
	private $_model;

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'rights', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 */
	public function actionView()
	{
		$this->render('view',array(
			'model'=>$this->loadModel(),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Survey;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Survey']))
		{
			$model->attributes=$_POST['Survey'];
			if($model->save())
                $this->redirect(array('admin'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Survey']))
		{
			$model->attributes=$_POST['Survey'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->sur_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 */
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel()->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(array('index'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Survey');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Survey('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Survey']))
			$model->attributes=$_GET['Survey'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 */
	public function loadModel()
	{
		if($this->_model===null)
		{
			if(isset($_GET['id']))
				$this->_model=Survey::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='survey-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
    public function actionExportExcel()
    {
        $sur_id='-1';
        if(isset($_GET['sur_id']))
        {
            $sur_id=$_GET['sur_id'];
        }
        else{
            return;
        }

        //
        // get a reference to the path of PHPExcel classes
        $phpExcelPath = Yii::getPathOfAlias('ext.phpexcel.Classes');

        // Turn off our amazing library autoload

        // spl_autoload_unregister(array('YiiBase','autoload'));

        //
        // making use of our reference, include the main class
        // when we do this, phpExcel has its own autoload registration
        // procedure (PHPExcel_Autoloader::Register();)
        include($phpExcelPath . DIRECTORY_SEPARATOR . 'PHPExcel.php');

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // style and format
        $styleArray = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size'  => 15,
                'name'  => 'Arial'
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '7b7b7b')
            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );
        $styleHeader = array(
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => '2121ff'),
                'size'  => 18,
                'name'  => 'Arial'
            ),
//            'fill' => array(
//                'type' => PHPExcel_Style_Fill::FILL_SOLID,
//                'color' => array('rgb' => '7b7b7b')
//            ),
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        // Set properties
        $objPHPExcel->getProperties()->setCreator("LinhPV")
            ->setLastModifiedBy("LinhPV")
            ->setTitle("PDF Test Document")
            ->setSubject("PDF Test Document")
            ->setDescription("Test document for PDF, generated using PHP classes.")
            ->setKeywords("pdf php")
            ->setCategory("Test result file");
        $objPHPExcel->getActiveSheet()->getStyle('A5:D5')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);

        $objPHPExcel->getActiveSheet()->getStyle('A5:D5')->applyFromArray($styleArray);
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A5', Yii::t('export_excel','question_text'))
        ->setCellValue('B5', Yii::t('export_excel','ans_text'))
        ->setCellValue('C5', Yii::t('export_excel','ans_yn'))
        ->setCellValue('D5', Yii::t('export_excel','status'));
// query data
        $listData=Survey::model()->findByPk($sur_id);
        $listQuestion=$listData->questions;

         $objPHPExcel->setActiveSheetIndex(0)
             ->setCellValue('B2',$listData['sur_name'] );
        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($styleHeader);
        $i=6;
        foreach($listQuestion as $question)
        {
            $listAnswer=$question->answers;
            $question_text=$question["question_text"];

            $question_status=$question["status"];

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, $question_text);
            $i++;
            foreach($listAnswer as $answer)
            {
                $ans_text=$answer["ans_text"];
                $ans_yn=$answer["ans_yn"];
                $ans_status=$answer["ans_status"];
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$i,$ans_text)
                    ->setCellValue('C'.$i,Answer::model()->getYesNoName($ans_yn))
                    ->setCellValue('D'.$i,Answer::model()->getStatusName($ans_status));
                $i++;
            }

        }




        // Save a xls file
        $filename = 'Survey';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        Yii::app()->end();

        //
        // Once we have finished using the library, give back the
        // power to Yii...
        spl_autoload_register(array('YiiBase','autoload'));
    }
}
