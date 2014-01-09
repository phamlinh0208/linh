<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('staff', 'create_staff'),
            'url'=>array('/Staff/create'),
        ),

    )
));
?>
<br/>
<h1><?php echo Yii::t('staff','staff_manager') ?></h1>
<?php

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('area-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'staff-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		'staff_code',
		'staff_name',

        'email',

		'staff_address',
		'phone_number',
        array(
            'name'=>'dep_id',
            'value'=>'$data->getDepartmentName($data->dep_id?$data->dep_id:-1)',
            'type'=>'raw',
        ),
//        array(
//            'name'=>'staff_type',
//            'value'=>'$data->getStaffTypeName($data->staff_type?$data->staff_type:-1)',
//            'type'=>'raw',
//        ),
        array(
            'name'=>'staff_level',
            'value'=>'$data->getLevelName($data->staff_level?$data->staff_level:-1)',
            'type'=>'raw',
        ),
        array(
            'name'=>'staff_member',
            'value'=>'$data->getMemberTypeName($data->staff_member?$data->staff_member:-1)',
            'type'=>'raw',
        ),
        office,
        event,


		//'description',

		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
