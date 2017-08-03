<?php
/* @var $this AnswerLikeController */
/* @var $model AnswerLike */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'answerLikeId'); ?>
		<?php echo $form->textField($model,'answerLikeId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'studentId'); ?>
		<?php echo $form->textField($model,'studentId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Rate'); ?>
		<?php echo $form->textField($model,'Rate',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->