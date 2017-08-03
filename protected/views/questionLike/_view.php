<?php
/* @var $this QuestionLikeController */
/* @var $data QuestionLike */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('questionLikeId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->questionLikeId), array('view', 'id'=>$data->questionLikeId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('studentId')); ?>:</b>
	<?php echo CHtml::encode($data->studentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rate')); ?>:</b>
	<?php echo CHtml::encode($data->rate); ?>
	<br />


</div>