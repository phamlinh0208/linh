<?php

class ApiController extends RController {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/lefty';

    /**
     * @var CActiveRecord the currently loaded data model instance.
     */
    private $_model;

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'rights', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     */
    public function actionView() {
        $this->render('view', array(
            'model' => $this->loadModel(),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     */
    public function actionUpdate() {
        
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     */
    public function actionDelete() {
        
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        
    }

    /**
     * api login
     */
    public function actionLogin() {
        $message = array();
        $username = Yii::app()->request->getQuery('username');
        $password = Yii::app()->request->getQuery('password');
        $identity = new UserIdentity($username, $password);
        if ($identity->authenticate()) {
            $message['result'] = true;
            $message['user_info'] = User::model()->findByAttributes(array('username' => $username))->profile->attributes;
        } else {
            $message['result'] = false;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list department
     */
    public function actionGetListDepartment() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $department = Department::model()->findAll(array(
            'offset' => $start,
            'limit' => $limit,
        ));
        foreach ($department as $item) {
            $sql = 'select f.create_datetime from feedback f where f.dep_id=' . $item->attributes["dep_id"] . '  order by f.create_datetime desc limit 1';
            $feedback_time = Yii::app()->db->createCommand($sql)->queryAll();
            $sql = "select id,CONCAT('" . Yii::app()->getBaseUrl(true) . "/images/department/" . "','',img_url) AS img_url from image where dep_id='" . $item->attributes["dep_id"] . "'";
            $images = Yii::app()->db->createCommand($sql)->queryAll();
            $sql = 'select d.*,' .
                    ' (select s.staff_name from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_name,' .
                    ' (select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_phone,' .
                    ' (select s.email  from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_email,' .
                    '(select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=3) count_ns,' .
                    ' (select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=4) count_pt' .
                    ' from department d' .
                    " where d.dep_id='" . $item->attributes["dep_id"] . "'";
            $result = Yii::app()->db->createCommand($sql)->queryAll();
            if (count($feedback_time) > 0) {
                $feedback_time = $feedback_time[0]['create_datetime'];
            } else {
                $feedback_time = "";
            }
            if (count($images) > 0) {
                $images = $images;
            } else {
                $images = array();
            }
            $attributes = $item->attributes;
            $attributes['count_ns'] = $result['0']['count_ns'];
            $attributes['count_pt'] = $result['0']['count_pt'];
            $attributes['bs_phone'] = $result['0']['bs_phone'];
            $attributes['bs_email'] = $result['0']['bs_email'];
            $attributes['bs_name'] = $result['0']['bs_name'];
            $attributes['dien_tich_id'] = $attributes['dien_tich'];
            $attributes['dien_tich'] = Department::model()->getDienTich($attributes['dien_tich']);
            $attributes['phong_khach_id'] = $attributes['phong_khach'];
            $attributes['phong_khach'] = Department::model()->getYesNoName($attributes['phong_khach']);
            $attributes['last_feedback_time'] = $feedback_time;
            $attributes['images'] = $images;
            $message['result'][] = $attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list staff
     */
    public function actionGetListStaff() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $dep_id = Yii::app()->request->getQuery('dep_id', 1);
        $Staff = Staff::model()->findAll(array(
            'condition' => 'dep_id = ' . $dep_id,
            'offset' => $start,
            'limit' => $limit,
        ));
        foreach ($Staff as $item) {
			$attributes = $item->attributes;
			$query = "select id,CONCAT('" . Yii::app()->getBaseUrl(true) . "/images/doctor/" . "','',img_url) as img_url from image where doctor_id='".$item->attributes["staff_id"]."'";
			$images = Yii::app()->db->createCommand($query)->queryAll();
			$attributes['images'] = $images;
            $message['result'][] = $attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list promotion
     */
    public function actionGetListPromotion() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $Promotion = Promotion::model()->findAll(array(
            'offset' => $start,
            'limit' => $limit,
        ));
        foreach ($Promotion as $item) {
            $message['result'][] = $item->attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list area
     */
    public function actionGetListArea() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $Area = Area::model()->findAll(array(
            'offset' => $start,
            'limit' => $limit,
        ));
        $dep_chair = AppParam::model()->findAll(array('condition' => 'par_name="dep_chair"'), 'par_type', 'par_value');
        $count = 0;
        foreach ($dep_chair as $item) {
            $message['dep_chair'][$count]["text"] = $item->attributes['par_value'];
            $message['dep_chair'][$count]["value"] = $item->attributes['par_type'];
            $count++;
        }
        $dep_dt = AppParam::model()->findAll(array('condition' => 'par_name="dep_dt"'), 'par_type', 'par_value');
        $count = 0;
        foreach ($dep_dt as $item) {
            $message['dep_dt'][$count]["text"] = $item->attributes['par_value'];
            $message['dep_dt'][$count]["value"] = $item->attributes['par_type'];
            $count++;
        }
        foreach ($Area as $item) {
            $message['result'][] = $item->attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api create department
     */
    public function actionCreateImage() {
        $message = array();
        $message['result'] = array();
        $dep_id = Yii::app()->request->getPost('dep_id');
        $doctor_id = Yii::app()->request->getPost('doctor_id');
        $message['dep_id'] = $dep_id;
        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);
        $model = new Image;
        if (isset($_POST)) {
            $model->attributes = $_POST;
            $model->img_url = new CUploadedFile($_FILES['img_url']['name'], $_FILES['img_url']['tmp_name'], $_FILES['img_url']['type'], $_FILES['img_url']['size'], $_FILES['img_url']['error']);
            if ($model->img_url) {
                if ($dep_id) {
                    $photo_name = 'dep_' . $dep_id . '_' . date('YmdHis') . '.' . CFileHelper::getExtension($model->img_url);
                    $model->img_url->saveAs(Yii::getPathOfAlias('webroot') . '/images/department/' . $photo_name);
                    $model->dep_id = $dep_id;
                }
                if ($doctor_id) {
                    $photo_name = 'doctor_' . $doctor_id . '_' . date('YmdHis') . '.' . CFileHelper::getExtension($model->img_url);
                    $model->img_url->saveAs(Yii::getPathOfAlias('webroot') . '/images/doctor/' . $photo_name);
                    $model->doctor_id = $doctor_id;
                }
                $model->img_url = $photo_name;
            }
            if ($model->save()) {
                $message["result"] = true;
            } else {
                $message['result'] = false;
                $message['message'] = 'Data is not validate';
            }
        } else {
            $message['result'] = false;
            $message['message'] = 'Have not file!';
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api create department
     */
    public function actionCreateDepartment() {
        $message = array();
        $message['result'] = array();
        $model = new Department;
        if (isset($_POST['dep_name'])) {
            $model->attributes = $_POST;
            $model->dep_code = Department::convertDepCode($model->province, Department::getChairFromAppParam($model->number_chair), $model->dep_name);
            if ($model->save()) {
                $message['result'] = true;
                $message['dep_id'] = $model->primaryKey;
            } else {
                $message['result'] = false;
                $message['message'] = "Data is not validate";
            }
        } else {
            $message['result'] = false;
            $message['message'] = 'Data is not validate';
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api edit department
     */
    public function actionEditDepartment() {
        $message = array();
        $message['result'] = array();
        $model = Department::model()->findbyPk($_POST['dep_id']);
        if (isset($_POST['dep_id'])) {
            $model->attributes = $_POST;
            $model->dep_code = Department::convertDepCode($model->province, Department::getChairFromAppParam($model->number_chair), $model->dep_name);
            if ($model->save()) {
                $message['result'] = true;
            } else {
                $message['result'] = false;
                $message['message'] = "Data is not validate";
            }
        } else {
            $message['result'] = false;
            $message['message'] = 'Data is not validate';
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api edit staff
     */
    public function actionEditStaff() {
        $message = array();
        $message['result'] = array();
        $model = Staff::model()->findbyPk($_POST['staff_id']);
        try {
            if (isset($_POST['staff_id'])) {
                $model->attributes = $_POST;

                if ($model->save()) {
                    $message['result'] = true;
                } else {
                    $message['result'] = false;
                    $message['message'] = "save die;";
                }
            } else {
                $message['result'] = false;
                $message['message'] = 'Data is not validate';
            }
        } catch (Exception $e) {
            $message['message'] = 'Caught exception: ' . $e->getMessage();
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api create get date time
     */
    public function actionGetDateTime() {
        $message = array();
        $message['datetime'] = date("Y-m-d");
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api create feedback
     */
    public function actionCreateFeedback() {
        $message = array();
        $message['result'] = array();
        $model = new Feedback;
        if (isset($_POST['user_id'])) {
            $model->attributes = $_POST;
            if ($model->save()) {
                $message['result'] = true;
                $message['feedback_id'] = $model->primaryKey;
            } else {
                $message['result'] = false;
                $message['message'] = "Data is not validate";
            }
        } else {
            $message['result'] = false;
            $message['message'] = 'Data is not validate';
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api create staff
     */
    public function actionCreateStaff() {
        $message = array();
        $message['result'] = array();
        $model = new Staff;
        if (isset($_POST['staff_name'])) {
            $model->attributes = $_POST;
            if ($model->save()) {
                $message['result'] = true;
                $message['doctor_id'] = $model->primaryKey;
            } else {
                $message['result'] = false;
                $message['message'] = "Data is not validate";
            }
        } else {
            $message['result'] = false;
            $message['message'] = 'Data is not validate';
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list survey
     */
    public function actionGetListSurvey() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $survey = Survey::model()->findAll(array(
            'offset' => $start,
            'limit' => $limit,
        ));
        foreach ($survey as $item) {
            $attributes = $item->attributes;
            $sur_id = $attributes['sur_id'];
            $question = Question::model()->findAll(array(
                'condition' => 'sur_id = ' . $sur_id . ' AND status = 1'
            ));
            foreach ($question as $item_question) {
                $attributes_question = $item_question->attributes;
                $question_id = $attributes_question['question_id'];
                $Answer = Answer::model()->findAll(array(
                    'condition' => 'question_id = ' . $question_id . ' AND ans_status = 1'
                ));
                foreach ($Answer as $item_ans) {
                    $attributes_question['answers'][] = $item_ans->attributes;
                }
                $attributes['questions'][] = $attributes_question;
            }
            $message['result'][] = $attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list POSM
     */
    public function actionGetListPosm() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $product_id = Yii::app()->request->getQuery('product_id', 1);
        $POSM = POSM::model()->findAll(array(
            'condition' => 'product_id = ' . $product_id,
            'offset' => $start,
            'limit' => $limit,
        ));
        foreach ($POSM as $item) {
            $message['result'][] = $item->attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list POSM
     */
    public function actionGetListCompetitor() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $product_id = Yii::app()->request->getQuery('product_id', 1);
        $Competitor = Competitor::model()->findAll(array(
            'condition' => 'product_id = ' . $product_id,
            'offset' => $start,
            'limit' => $limit,
        ));
        foreach ($Competitor as $item) {
            $message['result'][] = $item->attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * api get list feedback
     */
    public function actionGetListFeedback() {
        $message = array();
        $message['result'] = array();
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $dep_id = Yii::app()->request->getQuery('dep_id', 1);
        $message['result'] = Yii::app()->db->createCommand("select 	feedback.*,tbl_users.username from feedback LEFT JOIN tbl_users on tbl_users.id = feedback.user_id WHERE feedback.dep_id = $dep_id LIMIT $limit OFFSET $start")->queryAll();
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * submit posm
     */
    public function actionSubmitPosm() {
        $message = array();
        $message['result'] = array();
        if (isset($_POST['dep_id'])) {
            for ($i = 1; $i <= $_POST['num_posm']; $i ++) {
                $PostArray = array();
                $PostArray['posm_id'] = $_POST['posm_id' . $i];
                $PostArray['current_quantity'] = $_POST['current_quantity' . $i];
                $PostArray['status'] = $_POST['status' . $i];
                $PostArray['state'] = $_POST['state' . $i];
                $PostArray['dep_id'] = $_POST['dep_id'];
                $PostArray['create_date'] = date("Y-m-d");
                $model = new DepPosm;
                $model->attributes = $PostArray;
                if ($model->save()) {
                    $message['result'] = true;
                } else {
                    $message['result'] = false;
                    $message['message'] = "Data is not validate";
                    break;
                }
            }
        } else {
            $message['result'] = false;
            $message['message'] = 'Data is not validate';
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * submit competitor
     */
    public function actionSubmitCompetitor() {
        $message = array();
        $message['result'] = array();
        if (isset($_POST['dep_id'])) {
            for ($i = 1; $i <= $_POST['num_competitor']; $i ++) {
                $PostArray = array();
                $PostArray['competitor_id'] = $_POST['competitor_id' . $i];
                $PostArray['current_quantity'] = $_POST['current_quantity' . $i];
                $PostArray['status'] = $_POST['status' . $i];
                $PostArray['state'] = $_POST['state' . $i];
                $PostArray['dep_id'] = $_POST['dep_id'];
                $PostArray['create_date'] = date("Y-m-d");
                $PostArray['note'] = $_POST['note'];
                $model = new Depcompetitor;
                $model->attributes = $PostArray;
                if ($model->save()) {
                    $message['result'] = true;
                } else {
                    $message['result'] = false;
                    $message['message'] = "Data is not validate";
                    break;
                }
            }
        } else {
            $message['result'] = false;
            $message['message'] = 'Data is not validate';
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }
	function convertSearchKey($key){
		$marTViet=array("à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
		"ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề"
		,"ế","ệ","ể","ễ",
		"ì","í","ị","ỉ","ĩ",
		"ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ"
		,"ờ","ớ","ợ","ở","ỡ",
		"ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
		"ỳ","ý","ỵ","ỷ","ỹ",
		"đ",
		"À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă"
		,"Ằ","Ắ","Ặ","Ẳ","Ẵ",
		"È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
		"Ì","Í","Ị","Ỉ","Ĩ",
		"Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ"
		,"Ờ","Ớ","Ợ","Ở","Ỡ",
		"Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
		"Ỳ","Ý","Ỵ","Ỷ","Ỹ",
		"Đ");

		$marKoDau=array("a","a","a","a","a","a","a","a","a","a","a"
		,"a","a","a","a","a","a",
		"e","e","e","e","e","e","e","e","e","e","e",
		"i","i","i","i","i",
		"o","o","o","o","o","o","o","o","o","o","o","o"
		,"o","o","o","o","o",
		"u","u","u","u","u","u","u","u","u","u","u",
		"y","y","y","y","y",
		"d",
		"A","A","A","A","A","A","A","A","A","A","A","A"
		,"A","A","A","A","A",
		"E","E","E","E","E","E","E","E","E","E","E",
		"I","I","I","I","I",
		"O","O","O","O","O","O","O","O","O","O","O","O"
		,"O","O","O","O","O",
		"U","U","U","U","U","U","U","U","U","U","U",
		"Y","Y","Y","Y","Y",
		"D");
		return str_replace($marTViet,$marKoDau,$key);
	}
    /**
     * api search list department
     */
    public function actionSearchDepartment() {
        $message = array();
        $message['result'] = array();
        $dep_name = $this->convertSearchKey($_REQUEST['dep_name']);
        $dep_address = $this->convertSearchKey($_REQUEST['dep_address']);
        $bs_name = $this->convertSearchKey($_REQUEST['bs_name']);
        $start = Yii::app()->request->getQuery('start', 0);
        $limit = Yii::app()->request->getQuery('limit', 20);
        $query = 'select d.*,' .
                ' (select s.staff_name from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_name,' .
                ' (select s.phone_number from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_phone,' .
                ' (select s.email  from staff s where s.dep_id=d.dep_id and s.staff_level in (1,6) order by s.staff_id desc limit 1) bs_email,' .
                ' (select f.create_datetime from feedback f where f.dep_id=d.dep_id  order by f.create_datetime desc limit 1)  last_feedback_time,' .
                ' (select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=3) count_ns,' .
                ' (select count(*) from staff s where s.dep_id=d.dep_id and s.staff_level=4) count_pt' .
                ' from department d' .
                " where 1=1";
        if ($dep_name) {
            $query = $query . " AND (d.dep_name like N'%" . $dep_name . "%')";
        }
        if ($dep_address) {
            $query = $query . " AND (d.dep_address like N'%" . $dep_address . "%' OR d.precinct like N'%" . $dep_address . "%' OR d.district like N'%" . $dep_address . "%' OR d.province like N'%" . $dep_address . "%')";
        }
        if ($bs_name) {
            $query = $query . " AND d.dep_id in ( select s.dep_id from staff s where s.staff_name like N'%" . $bs_name . "%')";
        }
        $query = $query . " LIMIT $limit OFFSET $start";
        $department = Yii::app()->db->createCommand($query)->queryAll();
        foreach ($department as $item) {
            $attributes = $item;
            $sql = "select id,CONCAT('" . Yii::app()->getBaseUrl(true) . "/images/department/" . "','',img_url) AS img_url from image where dep_id='" . $attributes["dep_id"] . "'";
            $images = Yii::app()->db->createCommand($sql)->queryAll();
            $attributes['dien_tich_id'] = $attributes['dien_tich'];
            $attributes['phong_khach_id'] = $attributes['phong_khach'];
            $attributes['dien_tich'] = Department::model()->getDienTich($attributes['dien_tich']);
            $attributes['phong_khach'] = Department::model()->getYesNoName($attributes['phong_khach']);
            $attributes['images'] = $images;
            $message['result'][] = $attributes;
        }
        $message = json_encode($message);
        header('Content-type: application/json');
        exit($message);
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     */
    public function loadModel() {
        
    }

}
