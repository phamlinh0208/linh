<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->sur_type_id), array('view', 'id'=>$data->sur_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_type_name')); ?>:</b>
	<?php echo CHtml::encode($data->sur_type_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_type_status')); ?>:</b>
	<?php echo CHtml::encode($data->sur_type_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>