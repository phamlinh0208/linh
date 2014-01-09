

<?php 
echo '<h1>'.Yii::t('staff','view').'</h1>';
echo '<br/>';
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		//'staff_id',
		'staff_code',
		'staff_name',

		'staff_address',
        'email',
        array(
            'label' => Yii::t('staff','staff_level'),
            'value' => Staff::model()->getLevelName($model->staff_level?$model->staff_level:0),
        ),
        array(
            'label' => Yii::t('staff','staff_member'),
            'value' => Staff::model()->getMemberTypeName($model->staff_member?$model->staff_member:0),
        ),
		'phone_number',
		'office',
		'event',
		
		'description',
	),
)); ?>

<?php

$this->widget('zii.widgets.CMenu', array(
    'firstItemCssClass'=>'first',
    'lastItemCssClass'=>'last',
    'htmlOptions'=>array('class'=>'actions'),
    'items'=>array(

        array(
            'label'=>Yii::t('department', 'create_img'),
            'url'=>array('/Image/create&doctor_id='.$model->staff_id),
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
