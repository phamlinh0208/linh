<?php
$this->breadcrumbs=array(
	'App Params',
);

$this->menu=array(
	array('label'=>'Create AppParam', 'url'=>array('create')),
	array('label'=>'Manage AppParam', 'url'=>array('admin')),
);
?>

<h1>App Params</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
