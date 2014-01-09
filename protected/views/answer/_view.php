<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('ans_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->ans_id), array('view', 'id'=>$data->ans_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('question_id')); ?>:</b>
	<?php echo CHtml::encode($data->question_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ans_text')); ?>:</b>
	<?php echo CHtml::encode($data->ans_text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ans_yn')); ?>:</b>
	<?php echo CHtml::encode($data->ans_yn); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ans_status')); ?>:</b>
	<?php echo CHtml::encode($data->ans_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />


</div>