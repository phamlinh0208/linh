<?php $this->breadcrumbs = array(
	'Rights'=>Rights::getBaseUrl(),
	Rights::t('core', 'Assignments'),
); ?>

<div id="assignments">


    <br/>
    <h2>
	<p>
		<?php echo Yii::t('dictionary', 'listUserGroup'); ?>
	</p>
    </h2>
	<?php $this->widget('zii.widgets.grid.CGridView', array(
	    'dataProvider'=>$dataProvider,
	    'template'=>"{items}\n{pager}",
	    'emptyText'=>Rights::t('dictionary', 'Nousersfound'),
	    'htmlOptions'=>array('class'=>'grid-view assignment-table'),
	    'columns'=>array(
    		array(
    			'name'=>'name',
    			'header'=>Yii::t('dictionary', 'Username'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'name-column'),
    			'value'=>'$data->getAssignmentNameLink()',
    		),
    		array(
    			'name'=>'assignments',
    			'header'=>Yii::t('dictionary', 'Roles'),
    			'type'=>'raw',
    			'htmlOptions'=>array('class'=>'role-column'),
    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_ROLE)',
    		),
//			array(
//    			'name'=>'assignments',
//    			'header'=>Rights::t('core', 'Tasks'),
//    			'type'=>'raw',
//    			'htmlOptions'=>array('class'=>'task-column'),
//    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_TASK)',
//    		),
//			array(
//    			'name'=>'assignments',
//    			'header'=>Rights::t('core', 'Operations'),
//    			'type'=>'raw',
//    			'htmlOptions'=>array('class'=>'operation-column'),
//    			'value'=>'$data->getAssignmentsText(CAuthItem::TYPE_OPERATION)',
//    		),
	    )
	)); ?>

</div>