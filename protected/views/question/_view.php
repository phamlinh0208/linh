<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('question_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->question_id), array('view', 'id'=>$data->question_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('question_text')); ?>:</b>
	<?php echo CHtml::encode($data->question_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('sur_id')); ?>:</b>
	<?php echo CHtml::encode($data->sur_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>