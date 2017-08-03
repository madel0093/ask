<?php
/* @var $this DoctorsController */
/* @var $model Doctors */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doctors-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'Email',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Password'); ?>
		<?php echo $form->passwordField($model,'Password',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Fname'); ?>
		<?php echo $form->textField($model,'Fname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Fname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Lname'); ?>
		<?php echo $form->textField($model,'Lname',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($model,'Lname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'SubId'); ?>
		<?php echo $form->textField($model,'SubId'); ?>
		<?php echo $form->error($model,'SubId'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Doctorscol'); ?>
		<?php echo $form->textField($model,'Doctorscol'); ?>
		<?php echo $form->error($model,'Doctorscol'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->