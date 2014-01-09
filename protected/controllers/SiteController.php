<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$headers="From: {$model->email}\r\nReply-To: {$model->email}";
				mail(Yii::app()->params['adminEmail'],$model->subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
    public function actionTest()
    {
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
//                'color' => array('rgb' => 'FF0000'),
                'size'  => 15,
                'name'  => 'Arial'
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '3674b3')
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
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', Yii::t('export_excel','question_text'))
            ->setCellValue('B5', Yii::t('export_excel','ans_text'))
            ->setCellValue('C5', Yii::t('export_excel','ans_yn'))
            ->setCellValue('D5', Yii::t('export_excel','user_note'));
        for($i=0;$i<10;$i++)
        {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.($i+6), (Yii::t('export_excel','question_text')).($i+1))
                ->setCellValue('B'.($i+6), ($i+1))
                ->setCellValue('C'.($i+6), 'Sai')
                ->setCellValue('D'.($i+6), '');
        }
// query data
        $connection = Yii::app()->db;
        $sql="select sa.sur_ans_id,s.sur_name,sa.user_id from survey s,survey_answer sa  where sa.sur_id=s.sur_id";
        $listAnswer= Yii::app()->db->createCommand($sql)->queryAll();
        $sheet=0;
        foreach($listAnswer as $answer)
        {
            $sur_ans_id=$answer["sur_ans_id"];
            $sur_name=$answer["sur_name"];
            $user_id=$answer["user_id"];
            $objPHPExcel->getActiveSheet()->getStyle('A5:D5')->applyFromArray($styleArray);
            $objPHPExcel->setActiveSheetIndex($sheet)
                ->setCellValue('A5', Yii::t('export_excel','question_text'))
                ->setCellValue('B5', Yii::t('export_excel','ans_text'))
                ->setCellValue('C5', Yii::t('export_excel','ans_yn'))
                ->setCellValue('D5', Yii::t('export_excel','user_note'));
            $sqlDetail="select q.question_text 	,a.ans_text, a.ans_yn, sad.user_note".
                        " from question q, answer a, survey_answer_detail sad".
                        " where sad.question_id=q.question_id".
                        " and sad.answer_value=a.ans_id".
                        " and sad.sur_ans_id='".$sur_ans_id?$sur_ans_id:'-1'."'";
            $answerDetail=$connection->createCommand($sqlDetail)->queryAll();
             $i=6;
            foreach($answerDetail as $row)
            {
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$i, $row['question_text'])
                    ->setCellValue('B'.$i, $row['ans_text'])
                    ->setCellValue('C'.$i, $row['ans_yn'])
                    ->setCellValue('D'.$i, $row['user_note']);
                $i++;
            }
            $sheet++;
            // Rename sheet
            $objPHPExcel->getActiveSheet()->setTitle($sur_name);

            // Set active sheet index to the first sheet,
            // so Excel opens this as the first sheet
            $objPHPExcel->setActiveSheetIndex($sheet);
        }




        // Save a xls file
        $filename = 'Demo Export';
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