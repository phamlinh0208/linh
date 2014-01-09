<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_ans_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sur_ans_id), array('view', 'id'=>$data->sur_ans_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_id')); ?>:</b>
	<?php echo CHtml::encode($data->sur_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('staff_id')); ?>:</b>
	<?php echo CHtml::encode($data->staff_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->create_datetime); ?>
	<br />


</div>