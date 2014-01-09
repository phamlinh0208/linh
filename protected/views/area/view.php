<?php
$this->breadcrumbs=array(
	'Areas'=>array('index'),
	$model->area_id,
);

$this->menu=array(
	array('label'=>'List Area', 'url'=>array('index')),
	array('label'=>'Create Area', 'url'=>array('create')),
	array('label'=>'Update Area', 'url'=>array('update', 'id'=>$model->area_id)),
	array('label'=>'Delete Area', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->area_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Area', 'url'=>array('admin')),
);
?>

<h1>View Area #<?php echo $model->area_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
//		'area_id',
		'area_code',
		'area_name',
        array(
            'label' => Yii::t('area','area_parent_id'),
            'value' => Area::model()->getParentAreaName($model->area_parent_id?$model->area_parent_id:-1),
        ),
		'area_full_name',
		'description',
	),
)); ?>
