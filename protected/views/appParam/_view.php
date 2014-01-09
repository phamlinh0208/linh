<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('par_name')); ?>:</b>
	<?php echo CHtml::encode($data->par_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('par_type')); ?>:</b>
	<?php echo CHtml::encode($data->par_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('par_value')); ?>:</b>
	<?php echo CHtml::encode($data->par_value); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('par_status')); ?>:</b>
	<?php echo CHtml::encode($data->par_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>