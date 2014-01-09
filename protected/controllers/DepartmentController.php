<?php

class DepartmentController extends RController
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
        $model=$this->loadModel();
        $image=Image::model()->findAll(array('condition'=>'dep_id='.$model->dep_id?$model->dep_id:-1,));
        $countRow = Yii::app()->db->createCommand("select count(*) from image where dep_id='".($model->dep_id?$model->dep_id:-1)."'")->queryScalar();
        $query = "select id,img_url from image where dep_id='".($model->dep_id?$model->dep_id:-1)."'";
        $dataProvider = new CSqlDataProvider($query, array(
            'totalItemCount' => $countRow,
            'sort' => array(
                'attributes' => array(
                    'id', 'img_url'
                ),
            ),
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
		
		$queryDepView='select d.*, '.
		' (select s.staff_name from staff s where s.dep_id=d.dep_id and s.staff_level=2 order by s.staff_id desc limit 1) lt_name,'.
		' (select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level=2 order by s.staff_id desc limit 1) lt_phone,'.
		' (select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) dep_phone,'.
		' (select s.email  from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) dep_mail,'.
		' (select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=3) count_ns,'.
		' (select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=4) count_pt'.
		' from department d'.
		" where d.dep_id='".($model->dep_id?$model->dep_id:-1)."'";
		$dataDepProvider = new CSqlDataProvider($queryDepView, array(
            
            'sort' => array(
                'attributes' => array(
                    'dep_id','dep_code','dep_name','dep_address','precinct','district','province','number_chair','dep_status','dien_tich','phong_khach','description','lt_name','lt_phone','dep_phone','dep_mail','count_ns','count_pt'
                ),
            ),
            
        ));
		$dataDepProvider=$dataDepProvider->getData();
		$depData=$dataDepProvider[0];
		
		$query = "select id,img_url from image where dep_id='".($model->dep_id?$model->dep_id:-1)."'";
			$dataProviderDetail = new CSqlDataProvider($query, array(
				'sort' => array(
					'attributes' => array(
						'id', 'img_url'
					),
				),
				
			));
			
			$imgarray=$dataProviderDetail->getData();
			$queryDepViewDetail='select d.dep_id,d.dep_name, '.
			' ( select i.img_url from image i join (select s.staff_id from staff s where s.dep_id='.($model->dep_id?$model->dep_id:-1).' and s.staff_level in (1,6) order by s.staff_id desc limit 1) as doctor on doctor.staff_id=i.doctor_id limit 1 ) bs_img,'.
		 ' (select s.staff_name from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_name,'.
		 ' (select s.office from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_office,'.
		 ' (select s.event from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_event,'.
		 ' (select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_phone,'.
		 ' (select s.email  from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_email,'.
		 ' (select f.create_datetime from feedback f where f.dep_id=d.dep_id  order by f.create_datetime desc limit 1) last_visit,'.
		 ' (select s.staff_member from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_member'.
		 ' from department d'.
		 " where d.dep_id='".($model->dep_id?$model->dep_id:-1)."'";
			$dataDepProviderDetail = new CSqlDataProvider($queryDepViewDetail, array(
				
				'sort' => array(
					'attributes' => array(
						'dep_id','dep_name','bs_img','bs_name','bs_office','bs_event','bs_phone','bs_mail','bs_member','last_visit'
					),
				),
				
			));
			$dataDepProviderDetail=$dataDepProviderDetail->getData();
			$depDataDetail=$dataDepProviderDetail[0];
		$this->render('view',array(
			'model'=>$depData,
            'images'=>$imgarray,
			'viewdetail'=>$depDataDetail
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Department;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['Department']))
		{
			$model->attributes=$_POST['Department'];
			$model->dep_code=Department::convertDepCode($model->province,Department::getChairFromAppParam($model->number_chair),$model->dep_name);
            if ( $model->save()) {
                $this->redirect(array('admin'));
            }
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

		if(isset($_POST['Department']))
		{
			$model->attributes=$_POST['Department'];
			$model->dep_code=Department::convertDepCode($model->province,Department::getChairFromAppParam($model->number_chair),$model->dep_name);
			if($model->save())
				$this->redirect(array('view','id'=>$model->dep_id));
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
		$dataProvider=new CActiveDataProvider('Department');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
	    $query =" select d.*,(select f.create_datetime from feedback f where f.dep_id=d.dep_id order by f.create_datetime desc limit 1) last_feedback ,".
" (select s.staff_name from staff s where s.dep_id=d.dep_id and s.staff_level   limit 1) staff_name ".
"from department d";
		$countRow = Yii::app()->db->createCommand("select count(*) from department")->queryScalar();
        $dataProvider = new CSqlDataProvider($query, array(
            'totalItemCount' => $countRow,
            'sort' => array(
                'attributes' => array(
                     'dep_id','dep_code','dep_name','dep_address','precinct','district','province','number_chair','dep_status','dien_tich','phong_khach','description','work_time','last_feedback' ,'staff_name'
                ),
            ),
            'keyField' =>'dep_id',
            'pagination' => array(
                'pageSize' => 10,
            ),
        ));
		//$model=new Department('search');
		//$model->unsetAttributes();  // clear any default values
		//if(isset($_GET['Department']))
		//	$model->attributes=$_GET['Department'];

		$this->render('admin',array(
			'model'=>$dataProvider,
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
				$this->_model=Department::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='department-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionViewdetail()
	{
		$dep_id=$_REQUEST['dep_id'];
		if(isset($dep_id))
		{
			$query = "select id,img_url from image where dep_id='".($dep_id?$dep_id:-1)."'";
			$dataProvider = new CSqlDataProvider($query, array(
				'sort' => array(
					'attributes' => array(
						'id', 'img_url'
					),
				),
				
			));
			$imgarray=$dataProvider->getData();
			$queryDepView='select d.dep_id,d.dep_name, '.
			' ( select i.img_url from image i join (select s.staff_id from staff s where s.dep_id='.$dep_id.' and s.staff_level in (1,6) order by s.staff_id desc limit 1) as doctor on doctor.staff_id=i.doctor_id limit 1 ) bs_img,'.
		 ' (select s.staff_name from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_name,'.
		 ' (select s.office from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_office,'.
		 ' (select s.event from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_event,'.
		 ' (select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_phone,'.
		 ' (select s.email  from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_mail,'.
		 ' (select s.staff_member from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_member'.
		 ' from department d'.
		 " where d.dep_id='".$dep_id."'";
			$dataDepProvider = new CSqlDataProvider($queryDepView, array(
				
				'sort' => array(
					'attributes' => array(
						'dep_id','dep_name','bs_img','bs_name','bs_office','bs_event','bs_phone','bs_mail','bs_member'
					),
				),
				
			));
			$dataDepProvider=$dataDepProvider->getData();
			$depData=$dataDepProvider[0];
			$this->render('viewdetail',array(
				'model'=>$depData,
				'images'=>$imgarray
			));
		}
	}
}

