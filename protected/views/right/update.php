<?php
$this->breadcrumbs=array(
	'Rights'=>array('index'),
	$model->itemname=>array('view','id'=>$model->itemname),
	'Update',
);

$this->menu=array(
	array('label'=>'List Right', 'url'=>array('index')),
	array('label'=>'Create Right', 'url'=>array('create')),
	array('label'=>'View Right', 'url'=>array('view', 'id'=>$model->itemname)),
	array('label'=>'Manage Right', 'url'=>array('admin')),
);
?>

<h1>Update Right <?php echo $model->itemname; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>