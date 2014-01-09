<?php
$this->breadcrumbs=array(
	'Survey Types'=>array('admin'),
	$model->sur_type_id,
);

$this->menu=array(
	array('label'=>'List SurveyType', 'url'=>array('index')),
	array('label'=>'Create SurveyType', 'url'=>array('create')),
	array('label'=>'Update SurveyType', 'url'=>array('update', 'id'=>$model->sur_type_id)),
	array('label'=>'Delete SurveyType', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->sur_type_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage SurveyType', 'url'=>array('admin')),
);
?>

<h1>View SurveyType #<?php echo $model->sur_type_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'sur_type_id',
		'sur_type_name',
        array(
            'label' => Yii::t('survey_type','sur_type_status'),
            'value' => SurveyType::model()->getStatusName($model->sur_type_status?$model->sur_type_status:-1),
        ),
		'description',
	),
)); ?>
