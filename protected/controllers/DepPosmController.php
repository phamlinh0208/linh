<?php

class DepPosmController extends Controller
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
				'actions'=>array('index','view','exportPosm'),
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
		$model=new DepPosm;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['DepPosm']))
		{
			$model->attributes=$_POST['DepPosm'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
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

		if(isset($_POST['DepPosm']))
		{
			$model->attributes=$_POST['DepPosm'];
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
		$dataProvider=new CActiveDataProvider('DepPosm');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new DepPosm('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['DepPosm']))
			$model->attributes=$_GET['DepPosm'];

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
				$this->_model=DepPosm::model()->findbyPk($_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}
	
	
	public function actionExportPosm()
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
		$objPHPExcel->getActiveSheet()->setTitle('posm_'.date("mdY"));
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D1:G1');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D2:G2');
		$objPHPExcel->setActiveSheetIndex(0)->mergeCells('D3:G3');
		 $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('D1','Báo cáo kết quả khảo sát POSM' );
		$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('D2','Ngày tạo báo cáo :'. date("d/m/Y") );
		$objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('D3','Người tạo báo cáo : '.$username );
		
        $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('A5', 'No')
        ->setCellValue('B5', 'Phòng khám')
        ->setCellValue('C5', 'Địa chỉ')
        ->setCellValue('D5', 'Phường')
		->setCellValue('E5', 'Quận')
		->setCellValue('F5', 'Thành phố')
		->setCellValue('G5', 'Số ĐT phòng khám')
		->setCellValue('H5', 'Fax phòng khám')
		->setCellValue('I5', 'Email phòng khám')
		->setCellValue('J5', 'Ngày ghé thăm')
		->setCellValue('K5', 'Lần ghé thăm thứ mấy ?')
		;
// query data
		$connection=Yii::app()->db; 
		$sql = "
				SELECT posm.category,product.product_name FROM posm INNER JOIN product on product.product_id = posm.product_id ORDER BY product.product_name ASC
				";
		$command=$connection->createCommand($sql);
        $posms=$command->queryAll(); 
        $col = 11;
        $array_products = array();
		foreach($posms as $item){
			$header_name = $item['product_name']." ".$item['category'];
			$array_products[$header_name] = $col;
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValueByColumnAndRow($col,5,$header_name);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,5)->applyFromArray($styleArray);
			$col++;
			
		}
		$sql = "
				SELECT competitor.category,product.product_name FROM competitor INNER JOIN product on product.product_id = competitor.product_id ORDER BY product.product_name ASC
				";
		$command = $connection->createCommand($sql);
        $competitors = $command->queryAll(); 
		foreach($competitors as $item){
			$header_name = $item['product_name']." ".$item['category'];
			$array_products[$header_name] = $col;			
			$objPHPExcel->setActiveSheetIndex(0)
						->setCellValueByColumnAndRow($col,5,$header_name);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($col,5)->applyFromArray($styleArray);
			$col++;
			
		}
		$sql = "
				SELECT dep_posm.create_date,department.*,staff.email,staff.phone_number FROM dep_posm 
				INNER JOIN department on dep_posm.dep_id = department.dep_id 
				INNER JOIN staff on department.dep_id = staff.dep_id 
				WHERE staff.staff_level = 1
				GROUP BY dep_posm.create_date ORDER BY dep_posm.id DESC
				";
		$command = $connection->createCommand($sql);
        $result = $command->queryAll(); 
        $col = 1;
        $row = 6;
		foreach($result as $item){
			$sql = "
					SELECT dep_posm.create_date FROM dep_posm
					WHERE dep_posm.dep_id = ".$item['dep_id']."
					GROUP BY dep_posm.create_date
					ORDER BY UNIX_TIMESTAMP(dep_posm.create_date) ASC
				";
			$command = $connection->createCommand($sql);
        	$dates = $command->queryAll(); 
        	$visit_number = "";
			foreach($dates as $key => $date){
				if($date['create_date'] == $item['create_date']){
					$visit_number = $key+1;
				}
			}
			$sql = "
					SELECT dep_posm.*,posm.category,product.product_name FROM dep_posm
					INNER JOIN posm ON posm.posm_id = dep_posm.posm_id
					INNER JOIN product on product.product_id = posm.product_id
					WHERE dep_posm.dep_id = ".$item['dep_id']."
						  AND dep_posm.create_date = '".$item['create_date']."'
				";
			$command = $connection->createCommand($sql);
        	$products = $command->queryAll(); 
        	foreach($products as $product){
        		$product_name = $product['product_name']." ".$product['category'];
        		$col_number = $array_products[$product_name];
        		$objPHPExcel->setActiveSheetIndex(0)
                			->setCellValueByColumnAndRow($col_number, $row, DepPosm::model()->getStateName($product['state']));
        	}
			$objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$row, ($row-5))
				->setCellValue('B'.$row, $item['dep_name'])
				->setCellValue('C'.$row, $item['dep_address'])
				->setCellValue('D'.$row, $item['precinct'])
				->setCellValue('E'.$row, $item['district'])
				->setCellValue('F'.$row, $item['province'])
				->setCellValue('G'.$row, "'".$item['phone_number'])
				->setCellValue('H'.$row, $visit_number)
				->setCellValue('I'.$row, $item['email'])
				->setCellValue('J'.$row, $item['create_date'])
				->setCellValue('K'.$row, $visit_number)																								
				;
            $row++;
		}
        // Save a xls file
        $filename = 'posm_'.date("mdY");
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
        header('Cache-Control: max-age=0');

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        Yii::app()->end();
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='dep-posm-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
