<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('itemname')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->itemname), array('view', 'id'=>$data->itemname)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('weight')); ?>:</b>
	<?php echo CHtml::encode($data->weight); ?>
	<br />


</div>