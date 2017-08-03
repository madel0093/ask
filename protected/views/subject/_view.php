<?php
/* @var $this SubjectController */
/* @var $data Subject */
?>

<div class="view">

	<h2>
		<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
		<?php echo CHtml::link(CHtml::encode($data->Name), array('subject/view', 'id'=>$data->SubjectId)); ?>
		<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('term')); ?>:</b>
		<?php echo CHtml::encode($data->Term); ?>
		<br />
		<b><?php echo CHtml::encode($data->getAttributeLabel('year')); ?>:</b>
		<?php echo CHtml::encode($data->year); ?>
		<br />
		<hr>
	</h2>


</div>