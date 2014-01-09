<?php
$this->breadcrumbs=array(
	'Survey Types'=>array('index'),
	$model->sur_type_id=>array('view','id'=>$model->sur_type_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List SurveyType', 'url'=>array('index')),
	array('label'=>'Create SurveyType', 'url'=>array('create')),
	array('label'=>'View SurveyType', 'url'=>array('view', 'id'=>$model->sur_type_id)),
	array('label'=>'Manage SurveyType', 'url'=>array('admin')),
);
?>

<h1>Update SurveyType <?php echo $model->sur_type_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>