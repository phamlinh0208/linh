<?php
$this->breadcrumbs=array(
	'Rights',
);

$this->menu=array(
	array('label'=>'Create Right', 'url'=>array('create')),
	array('label'=>'Manage Right', 'url'=>array('admin')),
);
?>

<h1>Rights</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
