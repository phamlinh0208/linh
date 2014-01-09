<?php $this->widget('zii.widgets.CMenu', array(
	'firstItemCssClass'=>'first',
	'lastItemCssClass'=>'last',
	'htmlOptions'=>array('class'=>'actions'),
	'items'=>array(
		array(
			'label'=>Yii::t('dictionary', 'Assignments'),
			'url'=>array('assignment/view'),
			'itemOptions'=>array('class'=>'item-assignments'),
		),
		array(
			'label'=>Yii::t('dictionary', 'Permissions'),
			'url'=>array('authItem/permissions'),
			'itemOptions'=>array('class'=>'item-permissions'),
		),
		array(
			'label'=>Yii::t('dictionary', 'Roles'),
			'url'=>array('authItem/roles'),
			'itemOptions'=>array('class'=>'item-roles'),
		),
		array(
			'label'=>Rights::t('core', 'Tasks'),
			'url'=>array('authItem/tasks'),
			'itemOptions'=>array('class'=>'item-tasks'),
		),
		array(
			'label'=>Rights::t('core', 'Operations'),
			'url'=>array('authItem/operations'),
			'itemOptions'=>array('class'=>'item-operations'),
		),
	)
));	?>