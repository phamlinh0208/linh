<?php

//$this->widget('zii.widgets.CMenu', array(
//    'firstItemCssClass'=>'first',
//    'lastItemCssClass'=>'last',
//    'htmlOptions'=>array('class'=>'actions'),
//    'items'=>array(
//
//        array(
//            'label'=>Yii::t('department', 'create_department'),
//            'url'=>array('/Department/create'),
//        ),
//
//    )
//));

?>
<h1><?php echo Yii::t('department','department_manager') ?></h1>
<?php
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('department-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>


<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'department-grid',
	'dataProvider'=>$model,
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header'=>'STT',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
        ),
		array(
        'header'  => 'Mã phòng nha',
        'value' =>'$data["dep_code"]',
        'type'  => 'raw',
		),
		array(
        'header'  => 'Tên phòng nha',
        'value' =>'$data["dep_name"]',
        'type'  => 'raw',
		),

        array(
            'header'  => 'Nha sĩ chính',
            'value'=>'$data["staff_name"]',
        ),
/*
		'dep_address',
		'precinct',
        'district',
        'province',
*/
		array(
        'header'  => Yii::t('department','full_address'),
        'value' =>'$data["dep_address"]."-".$data["precinct"]."-".$data["district"]."-".$data["province"]',
        'type'  => 'raw',
		),
		array(
        'header'  => 'Thời gian làm việc',
        'value' =>'$data["work_time"]',
        'type'  => 'raw',
		),
		array(
        'header'  => 'Lần ghé thăm cuối',
        'value' =>'$data["last_feedback"]',
        'type'  => 'raw',
		),
		/*
		array(
        'header'  => Yii::t('department','view_detail'),
        'value' => 'CHtml::link("Xem", Yii::app()->createUrl("Department/viewdetail",array("dep_id"=>$data["dep_id"])))',
        'type'  => 'raw',
		),
		*/
//        array(
//            'name'=>'number_chair',
//            'value'=>'$data->getChair($data->number_chair?$data->number_chair:-1)',
//            'type'=>'raw',
//        ),
//        array(
//            'name'=>'dien_tich',
//            'value'=>'$data->getDienTich($data->dien_tich?$data->dien_tich:-1)',
//            'type'=>'raw',
//        ),
//        array(
//            'name'=>'phong_khach',
//            'value'=>'$data->getYesNoName($data->phong_khach)',
//            'type'=>'raw',
//        ),
//
//        array(
//            'name'=>'dep_status',
//            'value'=>'$data->getStatusName($data->dep_status)',
//            'type'=>'raw',
//        ),
//
		array(
                'header' => '',
                'class' => 'CButtonColumn',
                'template' => '{view} {edit}  {delete}',
                'buttons' => array(
                    'header' => '',
					'view' => array(
                        'label' => 'View', // text label of the button
                        'url' => 'Yii::app()->createUrl("Department/view",array("id"=>$data["dep_id"]))',
                        'imageUrl' => Yii::app()->baseUrl . '/images/system/view.png', // image URL of the button. If not set or false, a text link is used
                    ),
                    'edit' => array(
                        'label' => 'Edit', // text label of the button
                        'url' => 'Yii::app()->createUrl("Department/update",array("id"=>$data["dep_id"]))',
                        'imageUrl' => Yii::app()->baseUrl . '/images/system/update.png', // image URL of the button. If not set or false, a text link is used
                    ),
                    'delete' => array(
                        'label' => 'Delete', // text label of the button
                        'url' => 'Yii::app()->createUrl("Department/delete",array("id"=>$data["dep_id"]))',
                        'imageUrl' => Yii::app()->baseUrl . '/images/system/delete.png', // image URL of the button. If not set or false, a text link is used
                        'options' => array('class' => 'copy'), // HTML options for the button
                    ),
                ),
				
            ),
	),
)); ?>
