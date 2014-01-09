<?php

class FeedbackController extends Controller
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
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','view','exportFeedback'),
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
		$model=new Feedback;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Feedback']))
		{
			$model->attributes=$_POST['Feedback'];
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

		if(isset($_POST['Feedback']))
		{
			$model->attributes=$_POST['Feedback'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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
		$dataProvider=new CActiveDataProvider('Feedback');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Feedback('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Feedback']))
			$model->attributes=$_GET['Feedback'];

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
				$this->_model=Feedback::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='feedback-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionExportFeedback()
	{
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
                'size'  => 11,
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
               // 'color' => array('rgb' => '2121ff'),
                'size'  => 15,
                'name'  => 'Arial'
            ),

        );

        // Set properties
        $objPHPExcel->getProperties()->setCreator("LinhPV")
            ->setLastModifiedBy("LinhPV")
            ->setTitle("PDF Test Document")
            ->setSubject("PDF Test Document")
            ->setDescription("Test document for PDF, generated using PHP classes.")
            ->setKeywords("pdf php")
            ->setCategory("Test result file");
			$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($styleHeader);
        $objPHPExcel->getActiveSheet()->getStyle('A5:Z5')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
		$user=User::model()->findByPk(Yii::app()->user->id);
		$username=$user->profile->name;
		$objPHPExcel->getActiveSheet()->setTitle('Ykienbacsi_'.date("mdY"));
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:G1');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:G2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D3:G3');
		 $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('D1','Thông Tin Phòng Khám và Ý Kiến Bác sĩ' );
		$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('D2','Ngày tạo:'. date("d/m/Y") );
		$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('D3','Người tạo báo cáo: '.$username );
		
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A5', Yii::t('export_feedback','stt'))
        ->setCellValue('B5', Yii::t('export_feedback','dep'))
        ->setCellValue('C5', Yii::t('export_feedback','address'))
        ->setCellValue('D5', Yii::t('export_feedback','precinct'))
		->setCellValue('E5', Yii::t('export_feedback','district'))
		->setCellValue('F5', Yii::t('export_feedback','province'))
		->setCellValue('G5', Yii::t('export_feedback','dep_phone'))
		->setCellValue('H5', Yii::t('export_feedback','dep_fax'))
		->setCellValue('I5', Yii::t('export_feedback','dep_email'))
		->setCellValue('J5', Yii::t('export_feedback','time_visit'))
		->setCellValue('K5', Yii::t('export_feedback','number_visit'))
		->setCellValue('L5', Yii::t('export_feedback','next_visit'))
		->setCellValue('M5', Yii::t('export_feedback','bs_name'))
		->setCellValue('N5', Yii::t('export_feedback','bs_phone'))
		->setCellValue('O5', Yii::t('export_feedback','bs_email'))
		->setCellValue('P5', Yii::t('export_feedback','bs_office'))
		->setCellValue('Q5', Yii::t('export_feedback','bs_member'))
		->setCellValue('R5', Yii::t('export_feedback','lt_name'))
		->setCellValue('S5', Yii::t('export_feedback','lt_phone'))
		->setCellValue('T5', Yii::t('export_feedback','number_chair'))
		->setCellValue('U5', Yii::t('export_feedback','number_ns'))
		->setCellValue('V5', Yii::t('export_feedback','number_pt'))
		->setCellValue('W5', Yii::t('export_feedback','dien_tich'))
		->setCellValue('X5', Yii::t('export_feedback','feedback_product'))
		->setCellValue('Y5', Yii::t('export_feedback','satisfaction'))
		->setCellValue('Z5', Yii::t('export_feedback','feedback_other'));
	
// query data
		$connection=Yii::app()->db; 
		$sql="select d.dep_name,d.dep_address, d.precinct,d.district,d.province, ".
		"(select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level=1 order by s.staff_id desc limit 1) dep_phone,".
		" '' dep_fax,".
		"(select s.email  from staff s where s.dep_id=d.dep_id and s.staff_level=1 order by s.staff_id desc limit 1) dep_mail,".
		"(select group_concat(f.create_datetime separator '; ') from feedback f where f.dep_id = d.dep_id group by f.dep_id) time_visit,  ".
		"(select count(1) from feedback f where f.dep_id = d.dep_id) number_visit,".
		"(select s.staff_name  from staff s where s.dep_id=d.dep_id and s.staff_level=1 order by s.staff_id desc limit 1) bs_name,".
		"(select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level=1 order by s.staff_id desc limit 1) bs_phone,".
		"(select s.email  from staff s where s.dep_id=d.dep_id and s.staff_level=1 order by s.staff_id desc limit 1) bs_mail,".
		"(select s.office  from staff s where s.dep_id=d.dep_id and s.staff_level=1 order by s.staff_id desc limit 1) bs_office,".
		"(select p.par_value from app_param p   join	 (select s.staff_member ,s.dep_id from staff s where  s.staff_level=1 order by s.staff_id desc limit 1) sm on p.par_type=sm.staff_member where p.par_name='staff_member' and sm.dep_id=d.dep_id ) bs_member,".
		"(select s.staff_name from staff s where s.dep_id=d.dep_id and s.staff_level=2 order by s.staff_id desc limit 1) lt_name,".
		"(select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level=2 order by s.staff_id desc limit 1) lt_phone,".
		"d.number_chair,".
		"(select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=3) count_ns,".
		"(select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=4) count_pt,".
		"d.dien_tich, ".
		"(select group_concat(f.feedback_product separator '; ') from feedback f where f.dep_id = d.dep_id group by f.dep_id) feedback_product,  ".
		"(select group_concat(if(f.rating=1,'H�i l�ng','Kh�ng h�i l�ng') separator '; ') from feedback f where f.dep_id = d.dep_id group by f.dep_id) satisfaction,".
		"(select group_concat(f.feedback_other separator '; ') from feedback f where f.dep_id = d.dep_id group by f.dep_id) feedback_other".
		" from department d".
		" where d.dep_id in (SELECT DISTINCT dep_id FROM `feedback`)";
		$command=$connection->createCommand($sql);
        $rows=$command->queryAll(); 
        $i=6;
        foreach($rows as $row)
        {
			
			 $dep_name =$row['dep_name'];
			 $dep_address =$row['dep_address'];
			 $precinct = $row['precinct'];
			 $district = $row['district'];
			 $province = $row['province'];
			 $dep_phone = $row['dep_phone'];
			 $dep_fax =$row['dep_fax'];
			 $dep_mail = $row['dep_mail'];
			 $time_visit = $row['time_visit'];
			 $number_visit = $row['number_visit'];
			 $bs_name = $row['bs_name'];
			 $bs_phone = $row['bs_phone'];
			 $bs_mail = $row['bs_mail'];
			 $bs_office = $row['bs_office'];
			 $bs_member = $row['bs_member'];
			 $lt_name =$row['lt_name'];
			 $lt_phone = $row['lt_phone'];
			 $number_chair = $row['number_chair'];
			 $count_ns = $row['count_ns'];
			 $count_pt = $row['count_pt'];
			 $dien_tich = $row['dien_tich'];
			 $feedback_product = $row['feedback_product'];
			 $satisfaction = $row['satisfaction'];
			 $feedback_other = $row['feedback_other'];
			 
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$i, ($i-5))
				->setCellValue('B'.$i, $dep_name)
				->setCellValue('C'.$i, $dep_address)
				->setCellValue('D'.$i, $precinct)
				->setCellValue('E'.$i, $district)
				->setCellValue('F'.$i, $province)
				->setCellValue('G'.$i, $dep_phone)
				->setCellValue('H'.$i, $dep_fax)
				->setCellValue('I'.$i, $dep_mail)
				->setCellValue('J'.$i, $time_visit)
				->setCellValue('K'.$i, $number_visit)
				->setCellValue('L'.$i, '')
				->setCellValue('M'.$i, $bs_name)
				->setCellValue('N'.$i, $bs_phone)
				->setCellValue('O'.$i, $bs_mail)
				->setCellValue('P'.$i, $bs_office)
				->setCellValue('Q'.$i, $bs_member)
				->setCellValue('R'.$i, $lt_name)
				->setCellValue('S'.$i, $lt_phone)
				->setCellValue('T'.$i, $number_chair)
				->setCellValue('U'.$i, $count_ns)
				->setCellValue('V'.$i, $count_pt)
				->setCellValue('W'.$i, $dien_tich)
				->setCellValue('X'.$i, $feedback_product)
				->setCellValue('Y'.$i, $satisfaction)	
				->setCellValue('Z'.$i, $feedback_other)	;
            $i++;

        }




        // Save a xls file
        $filename = 'Ykienbacsi_'.date("mdY");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        Yii::app()->end();
	}
}
