<?php
$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Doctor', 'url'=>array('index')),
	array('label'=>'Create Doctor', 'url'=>array('create')),
	array('label'=>'Update Doctor', 'url'=>array('update', 'id'=>$model->doctor_id)),
	array('label'=>'Delete Doctor', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->doctor_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Doctor', 'url'=>array('admin')),
);
?>

<h1>View Doctor #<?php echo $model->doctor_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'doctor_id',
		'name',
		'email',
		'phone_number',
		'fax',
		'office',
		'member_type',
		'event_type',
		'dep_id',
	),
)); ?>
<br/>
<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('department', 'create_img'),
            'url'=>array('/Image/create&doctor_id='.$model->doctor_id),
        ),

    )
));
?>

<?php

$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'img-grid',
    'dataProvider' => $image,

    'columns' => array(

        array(
            'name' => Yii::t('department','image'),
            'type' => 'html',
            'value' => 'CHtml::image(Yii::app()->request->baseUrl."/images/doctor/".$data["img_url"], "", array("width"=>240))',
        ),

        array(
            'header' => '',
            'class' => 'CButtonColumn',
            'template' => '{delete}',
            'buttons' => array(
                'header' => '',


                'delete' => array(
                    'label' => 'Delete', // text label of the button
                    'url' => 'Yii::app()->createUrl("Image/delete",array("id"=>$data["id"]))',
                    'imageUrl' => Yii::app()->baseUrl . '/images/system/delete.png', // image URL of the button. If not set or false, a text link is used
                    'options' => array('class' => 'copy'), // HTML options for the button
                ),
            ),
        ),

    ),
));
?>