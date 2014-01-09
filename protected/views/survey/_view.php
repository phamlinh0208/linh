<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sur_id), array('view', 'id'=>$data->sur_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_name')); ?>:</b>
	<?php echo CHtml::encode($data->sur_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_datetime')); ?>:</b>
	<?php echo CHtml::encode($data->create_datetime); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->sur_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_status')); ?>:</b>
	<?php echo CHtml::encode($data->sur_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>