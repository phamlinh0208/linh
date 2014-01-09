<?php
$this->breadcrumbs=array(
	'Surveys'=>array('index'),
	$model->sur_id=>array('view','id'=>$model->sur_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Survey', 'url'=>array('index')),
	array('label'=>'Create Survey', 'url'=>array('create')),
	array('label'=>'View Survey', 'url'=>array('view', 'id'=>$model->sur_id)),
	array('label'=>'Manage Survey', 'url'=>array('admin')),
);
?>

<h1>Update Survey <?php echo $model->sur_id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>