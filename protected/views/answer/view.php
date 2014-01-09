<?php
$this->breadcrumbs=array(
	'Answers'=>array('index'),
	$model->ans_id,
);

$this->menu=array(
	array('label'=>'List Answer', 'url'=>array('index')),
	array('label'=>'Create Answer', 'url'=>array('create')),
	array('label'=>'Update Answer', 'url'=>array('update', 'id'=>$model->ans_id)),
	array('label'=>'Delete Answer', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->ans_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Answer', 'url'=>array('admin')),
);
?>

<h1>View Answer #<?php echo $model->ans_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

        array(
            'label' => Yii::t('answer','question_id'),
            'value' => Answer::model()->getQuestionName($model->question_id),
        ),
		'ans_text',
        array(
            'label' => Yii::t('answer','ans_status'),
            'value' => Answer::model()->getStatusName($model->ans_status),
        ),
		'description',
	),
)); ?>
