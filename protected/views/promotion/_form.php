<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'promotion-form',
    'enableAjaxValidation' => false,
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'name'); ?>
        <?php echo $form->textField($model, 'name', array('size' => 45, 'maxlength' => 200)); ?>
        <?php echo $form->error($model, 'name'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'content'); ?>
        <?php echo $form->textArea($model, 'content', array('rows' => 6, 'cols' => 45)); ?>
        <?php echo $form->error($model, 'content'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'start_date'); ?>
        <?php  $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'attribute' => 'start_date', // Model attribute filed which hold user input
            'model' => $model, // Model name
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
            'htmlOptions' => array('size' => 15),
        )
    );?>
        <?php echo $form->error($model, 'start_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'end_date'); ?>
        <?php  $this->widget('zii.widgets.jui.CJuiDatePicker',
        array(
            'attribute' => 'end_date', // Model attribute filed which hold user input
            'model' => $model, // Model name
            'options' => array(
                'showAnim' => 'fold',
                'dateFormat' => 'yy-mm-dd'
            ),
            'htmlOptions' => array('size' => 15),
        )
    );?>

        <?php echo $form->error($model, 'end_date'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 50)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->