<?php
$this->breadcrumbs=array(
	'App Params'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List AppParam', 'url'=>array('index')),
	array('label'=>'Create AppParam', 'url'=>array('create')),
	array('label'=>'View AppParam', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage AppParam', 'url'=>array('admin')),
);
?>

<h1>Update AppParam <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>