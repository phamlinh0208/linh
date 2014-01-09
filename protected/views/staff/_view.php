<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->staff_id), array('view', 'id'=>$data->staff_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_code')); ?>:</b>
	<?php echo CHtml::encode($data->staff_code); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_name')); ?>:</b>
	<?php echo CHtml::encode($data->staff_name); ?>
	<br />



    <b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
    <?php echo CHtml::encode($data->email); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('staff_level')); ?>:</b>
    <?php echo CHtml::encode($data->staff_level); ?>
    <br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_address')); ?>:</b>
	<?php echo CHtml::encode($data->staff_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('phone_number')); ?>:</b>
	<?php echo CHtml::encode($data->phone_number); ?>
	<br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('event')); ?>:</b>
    <?php echo CHtml::encode($data->event); ?>
    <br />
    <b><?php echo CHtml::encode($data->getAttributeLabel('office')); ?>:</b>
    <?php echo CHtml::encode($data->office); ?>
    <br />
	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('member_type')); ?>:</b>
	<?php echo CHtml::encode($data->member_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_contact')); ?>:</b>
	<?php echo CHtml::encode($data->staff_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	*/ ?>

</div>