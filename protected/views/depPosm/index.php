<?php
$this->breadcrumbs=array(
	'Dep Posms',
);

$this->menu=array(
	array('label'=>'Create DepPosm', 'url'=>array('create')),
	array('label'=>'Manage DepPosm', 'url'=>array('admin')),
);
?>

<h1>Dep Posms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
