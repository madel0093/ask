<?php
/* @var $this AnswerLikeController */
/* @var $model AnswerLike */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'answer-like-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'studentId'); ?>
		<?php echo $form->textField($model,'studentId'); ?>
		<?php echo $form->error($model,'studentId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Rate'); ?>
		<?php echo $form->textField($model,'Rate',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Rate'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->