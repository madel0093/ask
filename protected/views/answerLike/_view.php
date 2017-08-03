<?php
/* @var $this AnswerLikeController */
/* @var $data AnswerLike */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('answerLikeId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->answerLikeId), array('view', 'id'=>$data->answerLikeId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('studentId')); ?>:</b>
	<?php echo CHtml::encode($data->studentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Rate')); ?>:</b>
	<?php echo CHtml::encode($data->Rate); ?>
	<br />


</div>