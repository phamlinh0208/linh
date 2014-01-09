<?php
$this->breadcrumbs=array(
	'Survey Answers'=>array('index'),
	$model->sur_ans_id,
);

$this->menu=array(
	array('label'=>'List SurveyAnswer', 'url'=>array('index')),
	array('label'=>'Create SurveyAnswer', 'url'=>array('create')),
	array('label'=>'Update SurveyAnswer', 'url'=>array('update', 'id'=>$model->sur_ans_id)),
	array('label'=>'Delete SurveyAnswer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sur_ans_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SurveyAnswer', 'url'=>array('admin')),
);
?>

<h1>View SurveyAnswer #<?php echo $model->sur_ans_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sur_ans_id',
		'user_id',
		'sur_id',
		'staff_id',
		'create_datetime',
	),
)); ?>
