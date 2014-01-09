<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'feedback-form',
	'enableAjaxValidation'=>false,
)); ?>

	

	<?php echo $form->errorSummary($model); ?>



    <div class="row">
        <?php echo $form->labelEx($model,'user_id'); ?>
        <?php echo $form->dropDownList($model,'user_id',CHtml::listData(User::model()->findAll(), 'id', 'username')); ?>
        <?php echo $form->error($model,'user_id'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'create_datetime'); ?>
        <?php  $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'attribute' => 'create_datetime', // Model attribute filed which hold user input
            'model' => $model, // Model name
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
            'htmlOptions' => array('size' => 15),
        )
    );?>
        <?php echo $form->error($model, 'create_datetime'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model,'dep_id'); ?>
        <?php echo $form->dropDownList($model,'dep_id',CHtml::listData(Department::model()->findAll(), 'dep_id', 'dep_name')); ?>
        <?php echo $form->error($model,'dep_id'); ?>
    </div>

  

    <div class="row">
        <?php echo $form->labelEx($model,'rating'); ?>
        <?php echo $form->dropDownList($model,'rating',Feedback::model()->getSatisfactionOptions()); ?>
        <?php echo $form->error($model,'rating'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'feedback_product'); ?>
        <?php echo $form->textArea($model,'feedback_product',array('maxlength' => 500, 'rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model,'feedback_product'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model,'feedback_other'); ?>
        <?php echo $form->textArea($model,'feedback_other',array('maxlength' => 500, 'rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model,'feedback_other'); ?>
    </div>

<div class="row">
		<?php echo $form->labelEx($model,'next_time'); ?>
        <?php echo $form->textField($model,'next_time',array('size' => 45, 'maxlength' => 200)); ?>
		<?php echo $form->error($model,'next_time'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->