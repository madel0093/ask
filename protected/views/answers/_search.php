<?php
/* @var $this AnswersController */
/* @var $model Answers */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Answerid'); ?>
		<?php echo $form->textField($model,'Answerid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'QuestionId'); ?>
		<?php echo $form->textField($model,'QuestionId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'studentId'); ?>
		<?php echo $form->textField($model,'studentId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Text'); ?>
		<?php echo $form->textArea($model,'Text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Date'); ?>
		<?php echo $form->textField($model,'Date',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'approved'); ?>
		<?php echo $form->textField($model,'approved',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->