<?php
$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Doctor', 'url'=>array('index')),
	array('label'=>'Create Doctor', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('doctor-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<br/>
<h1><?php echo Yii::t('doctor','doctor_manager') ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'doctor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'name',
		'email',
		'phone_number',
		'fax',
		'office',
        array(
            'name'=>'dep_id',
            'value'=>'$data->getDepartmentName($data->dep_id?$data->dep_id:-1)',
            'type'=>'raw',
        ),
        array(
            'name'=>'event_type',
            'value'=>'$data->getEventName($data->event_type?$data->event_type:-1)',
            'type'=>'raw',
        ),
        array(
            'name'=>'member_type',
            'value'=>'$data->getMemberTypeName($data->member_type?$data->member_type:-1)',
            'type'=>'raw',
        ),
		/*
		'member_type',
		'event_type',
		'dep_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
