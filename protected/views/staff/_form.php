<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'staff-form',
    'enableAjaxValidation' => false,
)); ?>


    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'staff_code'); ?>
        <?php echo $form->textField($model, 'staff_code', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'staff_code'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'staff_name'); ?>
        <?php echo $form->textField($model, 'staff_name', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'staff_name'); ?>
    </div>


    <div class="row">
        <?php echo $form->labelEx($model, 'email'); ?>
        <?php echo $form->textField($model, 'email', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'email'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'dep_id'); ?>
        <?php echo $form->dropDownList($model, 'dep_id', CHtml::listData(Department::model()->findAll(), 'dep_id', 'dep_name')); ?>
        <?php echo $form->error($model, 'dep_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'staff_level'); ?>
        <?php echo $form->dropDownList($model, 'staff_level', CHtml::listData(AppParam::model()->findAll(array('condition' => 'par_name="level_type"',)), 'par_type', 'par_value')); ?>
        <?php echo $form->error($model, 'staff_level'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'staff_member'); ?>
        <?php echo $form->dropDownList($model, 'staff_member', CHtml::listData(AppParam::model()->findAll(array('condition' => 'par_name="staff_member"',)), 'par_type', 'par_value')); ?>
        <?php echo $form->error($model, 'staff_member'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'staff_address'); ?>
        <?php echo $form->textField($model, 'staff_address', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'staff_address'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'phone_number'); ?>
        <?php echo $form->textField($model, 'phone_number', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'phone_number'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'event'); ?>
        <?php echo $form->textField($model, 'event', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'event'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'office'); ?>
        <?php echo $form->textField($model, 'office', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'office'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textField($model, 'description', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->