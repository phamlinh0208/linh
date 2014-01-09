<?php
$this->breadcrumbs=array(
	'App Params'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List AppParam', 'url'=>array('index')),
	array('label'=>'Create AppParam', 'url'=>array('create')),
	array('label'=>'Update AppParam', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete AppParam', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage AppParam', 'url'=>array('admin')),
);
?>

<h1>View AppParam #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'par_name',
		'par_type',
		'par_value',
		'par_status',
		'description',
	),
)); ?>
