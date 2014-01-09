<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->dep_id), array('view', 'id'=>$data->dep_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_name')); ?>:</b>
	<?php echo CHtml::encode($data->dep_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_type')); ?>:</b>
	<?php echo CHtml::encode($data->dep_type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_address')); ?>:</b>
	<?php echo CHtml::encode($data->dep_address); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_contact')); ?>:</b>
	<?php echo CHtml::encode($data->dep_contact); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('number_chair')); ?>:</b>
	<?php echo CHtml::encode($data->number_chair); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('parent_dep_id')); ?>:</b>
	<?php echo CHtml::encode($data->parent_dep_id); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('area_id')); ?>:</b>
	<?php echo CHtml::encode($data->area_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('dep_status')); ?>:</b>
	<?php echo CHtml::encode($data->dep_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	*/ ?>

</div>