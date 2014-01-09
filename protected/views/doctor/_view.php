<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('doctor_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->doctor_id), array('view', 'id'=>$data->doctor_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->phone_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fax')); ?>:</b>
	<?php echo CHtml::encode($data->fax); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('office')); ?>:</b>
	<?php echo CHtml::encode($data->office); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('member_type')); ?>:</b>
	<?php echo CHtml::encode($data->member_type); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('event_type')); ?>:</b>
	<?php echo CHtml::encode($data->event_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_id')); ?>:</b>
	<?php echo CHtml::encode($data->dep_id); ?>
	<br />

	*/ ?>

</div>