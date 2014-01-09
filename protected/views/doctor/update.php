<?php
$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	$model->name=>array('view','id'=>$model->doctor_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Doctor', 'url'=>array('index')),
	array('label'=>'Create Doctor', 'url'=>array('create')),
	array('label'=>'View Doctor', 'url'=>array('view', 'id'=>$model->doctor_id)),
	array('label'=>'Manage Doctor', 'url'=>array('admin')),
);
?>

<h1>Update Doctor <?php echo $model->doctor_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>