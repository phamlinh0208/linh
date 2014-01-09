<?php
$this->breadcrumbs=array(
	'Rights'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Right', 'url'=>array('index')),
	array('label'=>'Manage Right', 'url'=>array('admin')),
);
?>

<h1>Create Right</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>