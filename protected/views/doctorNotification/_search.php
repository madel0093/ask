<?php
/* @var $this DoctorNotificationController */
/* @var $model DoctorNotification */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'Doctor_NotificationId'); ?>
		<?php echo $form->textField($model,'Doctor_NotificationId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'doctorId'); ?>
		<?php echo $form->textField($model,'doctorId'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Text'); ?>
		<?php echo $form->textArea($model,'Text',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'seen'); ?>
		<?php echo $form->textField($model,'seen',array('size'=>45,'maxlength'=>45)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->