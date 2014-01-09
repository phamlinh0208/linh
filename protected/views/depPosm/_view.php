<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_id')); ?>:</b>
	<?php echo CHtml::encode($data->dep_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('posm_id')); ?>:</b>
	<?php echo CHtml::encode($data->posm_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_quantity')); ?>:</b>
	<?php echo CHtml::encode($data->current_quantity); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('state')); ?>:</b>
	<?php echo CHtml::encode($data->state); ?>
	<br />


</div>