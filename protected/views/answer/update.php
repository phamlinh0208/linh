<?php
$this->breadcrumbs=array(
	'Answers'=>array('index'),
	$model->ans_id=>array('view','id'=>$model->ans_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Answer', 'url'=>array('index')),
	array('label'=>'Create Answer', 'url'=>array('create')),
	array('label'=>'View Answer', 'url'=>array('view', 'id'=>$model->ans_id)),
	array('label'=>'Manage Answer', 'url'=>array('admin')),
);
?>

<h1>Update Answer <?php echo $model->ans_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>