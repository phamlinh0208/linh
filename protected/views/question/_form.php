<div class="form">

    <?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'question-form',
    'enableAjaxValidation' => false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model, 'question_text'); ?>
        <?php echo $form->textArea($model, 'question_text', array('rows' => 4, 'cols' => 45)); ?>
        <?php echo $form->error($model, 'question_text'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'sur_id'); ?>
        <?php echo $form->dropDownList($model, 'sur_id', CHtml::listData(Survey::model()->findAll(array('condition' => 'sur_status=1',)), 'sur_id', 'sur_name')); ?>
        <?php echo $form->error($model, 'sur_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'status'); ?>
        <?php echo $form->dropDownList($model, 'status', Question::model()->getStatusOptions()); ?>
        <?php echo $form->error($model, 'status'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model, 'description'); ?>
        <?php echo $form->textArea($model, 'description', array('rows' => 6, 'cols' => 45)); ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>


    <!-- -------------- -->
    <?php echo CHtml::label(Yii::t('question', 'list_answer'), false);?>

    <table id="hor-minimalist-b" style="width:100%">
        <thead>
        <tr>
            <th scope="col"><?php echo CHtml::label(Yii::t('answer', 'ans_text'), false);?></th>
<!--            <th scope="col">--><?php //echo CHtml::label(Yii::t('answer', 'ans_yn'), false);?><!--</th>-->
            <th scope="col"><?php echo CHtml::label(Yii::t('answer', 'ans_status'), false);?></th>
            <th scope="col">
                <?php echo CHtml::image(Yii::app()->request->baseUrl . "/images/system/plus.png", '', array('onClick' => 'addSupplierFood1($(this))', 'class' => 'add'));?>
                <?php echo Yii::t('dictionary', 'add');?>
            </th>
        </tr>
        </thead>
    <tbody>
        <?php if (count(Answer::model()->findAll(array('condition' => 'ans_status=1 and question_id=' . $model['question_id'] ? $model['question_id'] : '-1',))) > 0): ?>

        <?php foreach ($answerManager->items as $id => $answer): ?>
            <?php $this->renderPartial('_form_answer_item', array('id' => $id, 'model' => $answer, 'form' => $form)); ?>
            <?php endforeach; ?>
        </tbody>
            <?php endif ?>
    </table>


    <?php $this->renderPartial('js', array('answerManager' => $answerManager, 'form' => $form));?>




    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->