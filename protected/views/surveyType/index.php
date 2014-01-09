<?php
$this->breadcrumbs=array(
	'Survey Types',
);

$this->menu=array(
	array('label'=>'Create SurveyType', 'url'=>array('create')),
	array('label'=>'Manage SurveyType', 'url'=>array('admin')),
);
?>

<h1>Survey Types</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
