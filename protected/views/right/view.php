<?php
$this->breadcrumbs=array(
	'Rights'=>array('index'),
	$model->itemname,
);

$this->menu=array(
	array('label'=>'List Right', 'url'=>array('index')),
	array('label'=>'Create Right', 'url'=>array('create')),
	array('label'=>'Update Right', 'url'=>array('update', 'id'=>$model->itemname)),
	array('label'=>'Delete Right', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->itemname),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Right', 'url'=>array('admin')),
);
?>

<h1>View Right #<?php echo $model->itemname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'itemname',
		'type',
		'weight',
	),
)); ?>
