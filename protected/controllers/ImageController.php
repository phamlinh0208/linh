<?php

class ImageController extends Controller
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
		$model=new Image;
        $dep_id=Yii::app()->request->getQuery('dep_id');
        $doctor_id=Yii::app()->request->getQuery('doctor_id');
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
            $model->img_url = CUploadedFile::getInstance($model, 'img_url');
            if ($model->img_url) {
                if($dep_id)
                {
                    $photo_name = 'dep_'.$dep_id . '_' . date('YmdHis') . '.' . CFileHelper::getExtension($model->img_url);
                    $model->img_url->saveAs(Yii::getPathOfAlias('webroot') . '/images/department/' . $photo_name);
                    $model->dep_id=$dep_id;
                }
                if($doctor_id)
                {
                    $photo_name = 'doctor_'.$doctor_id . '_' . date('YmdHis') . '.' . CFileHelper::getExtension($model->img_url);
                    $model->img_url->saveAs(Yii::getPathOfAlias('webroot') . '/images/doctor/' . $photo_name);
                    $model->doctor_id=$doctor_id;
                }

                $model->img_url = $photo_name;

            }
            if($dep_id)
            {
                if ($model->save())
                    $this->redirect(array('Department/view&id='.$dep_id));
            }
            else
            {
                if ($model->save())
                    $this->redirect(array('Staff/view&id='.$doctor_id));
            }

		}
        if($dep_id)
        {
            $this->render('create',array(
                'model'=>$model,
                'dep_id'=>$dep_id
            ));
        }
        else
        {
            $this->render('create',array(
                'model'=>$model,
                'doctor_id'=>$doctor_id
            ));
        }

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

		if(isset($_POST['Image']))
		{
			$model->attributes=$_POST['Image'];
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
		$dataProvider=new CActiveDataProvider('Image');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Image('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Image']))
			$model->attributes=$_GET['Image'];

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
				$this->_model=Image::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='image-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionExportFeedback()
	{
	
	}
}
