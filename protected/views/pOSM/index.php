<?php
$this->breadcrumbs=array(
	'Posms',
);

$this->menu=array(
	array('label'=>'Create POSM', 'url'=>array('create')),
	array('label'=>'Manage POSM', 'url'=>array('admin')),
);
?>

<h1>Posms</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
