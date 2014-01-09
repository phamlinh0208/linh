<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->area_id), array('view', 'id'=>$data->area_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_code')); ?>:</b>
	<?php echo CHtml::encode($data->area_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_name')); ?>:</b>
	<?php echo CHtml::encode($data->area_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_parent_id')); ?>:</b>
	<?php echo CHtml::encode($data->area_parent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('area_full_name')); ?>:</b>
	<?php echo CHtml::encode($data->area_full_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>