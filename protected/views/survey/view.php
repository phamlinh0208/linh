<?php
$this->breadcrumbs=array(
	'Surveys'=>array('index'),
	$model->sur_id,
);

$this->menu=array(
	array('label'=>'List Survey', 'url'=>array('index')),
	array('label'=>'Create Survey', 'url'=>array('create')),
	array('label'=>'Update Survey', 'url'=>array('update', 'id'=>$model->sur_id)),
	array('label'=>'Delete Survey', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sur_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Survey', 'url'=>array('admin')),
);
?>

<h1>View Survey #<?php echo $model->sur_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sur_id',
		'sur_name',
		'create_datetime',

        array(
            'label' => Yii::t('survey','sur_type_id'),
            'value' => Survey::model()->getSurveyTypeName($model->sur_type_id?$model->sur_type_id:-1),
        ),
        array(
            'label' => Yii::t('survey','sur_status'),
            'value' => Survey::model()->getStatusName($model->sur_status?$model->sur_status:0),
        ),
		'description',
	),
)); ?>
