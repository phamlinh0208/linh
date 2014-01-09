<?php
Yii::import("ext.input.TabularInputManager");
class QuestionController extends RController
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
		$model=new Question;
        $answerManager=new AnswerManager;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Question']))
		{

			$model->attributes=$_POST['Question'];
            if(isset($_POST['Answer']))
            {
                $answerManager->manage($_POST['Answer']);
               // print_r($answerManager);die();
                $valid=$model->validate();
                if(isset($_POST['Answer']))
                {
                    $valid=$answerManager->validate($model) && $valid;
                }

                if($valid)
                {

                    if($model->save())
                    {
                        if(isset($_POST['Answer']))
                        {
                            $answerManager->save($model);
                        }
                        $this->redirect(array('admin'));
                    }
                }
            }


		}

		$this->render('create',array(
			'model'=>$model,
            'answerManager'=>$answerManager,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel();
        $answerManager=AnswerManager::load($model);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Question']))
		{
			$model->attributes=$_POST['Question'];
            if(isset($_POST['Answer']))
            {
                $answerManager->manage($_POST['Answer']);
                // print_r($answerManager);die();
                $valid=$model->validate();
                if(isset($_POST['Answer']))
                {
                    $valid=$answerManager->validate($model) && $valid;
                }

                if($valid)
                {

                    if($model->save())
                    {
                        if(isset($_POST['Answer']))
                        {
                            $answerManager->save($model);
                        }
                        else
                        {
                            Answer::model()->deleteAll('question_id='.$model->id);
                        }
                        $this->redirect(array('view','id'=>$model->question_id));
                    }
                }
            }
		}

		$this->render('update',array(
			'model'=>$model,
            'answerManager'=>$answerManager,
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
		$dataProvider=new CActiveDataProvider('Question');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Question('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Question']))
			$model->attributes=$_GET['Question'];

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
				$this->_model=Question::model()->findbyPk($_GET['id']);
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
		if(isset($_POST['ajax']) && $_POST['ajax']==='question-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}

class AnswerManager extends TabularInputManager
{
    protected $class='Answer';

    public function getItems()
    {
        if (is_array($this->_items))
        {
            return ($this->_items);
        }
        else
        {
            return array(
                'n0'=>new Answer(),
            );
        }
    }


    public function deleteOldItems($model, $itemsPk)
    {
        $criteria=new CDbCriteria;
        $criteria->addNotInCondition('ans_id', $itemsPk);
        $criteria->addCondition("question_id= {$model->primaryKey}");

        Answer::model()->deleteAll($criteria);
    }

    public static function load($model)
    {
        $return = new AnswerManager();
        foreach ($model->answers as $item)
        {
            $return->_items[$item->primaryKey]=$item;
        }
        return $return;
    }


    public function setUnsafeAttribute($item, $model)
    {
        $item->question_id = $model->primaryKey;
    }


}
