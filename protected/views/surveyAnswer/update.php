<?php
$this->breadcrumbs=array(
	'Survey Answers'=>array('index'),
	$model->sur_ans_id=>array('view','id'=>$model->sur_ans_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SurveyAnswer', 'url'=>array('index')),
	array('label'=>'Create SurveyAnswer', 'url'=>array('create')),
	array('label'=>'View SurveyAnswer', 'url'=>array('view', 'id'=>$model->sur_ans_id)),
	array('label'=>'Manage SurveyAnswer', 'url'=>array('admin')),
);
?>

<h1>Update SurveyAnswer <?php echo $model->sur_ans_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>