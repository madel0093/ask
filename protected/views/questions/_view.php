<?php
/* @var $this QuestionsController */
/* @var $data Questions */
?>

<div class="view">

	<h3>
		<?php echo CHtml::link(CHtml::encode($data->Text), array('questions/view', 'id'=>$data->QuestionsId)); ?>
	</h3>

<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('QuestionsId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->QuestionsId), array('view', 'id'=>$data->QuestionsId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('userId')); ?>:</b>
	<?php echo CHtml::encode($data->userId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('subId')); ?>:</b>
	<?php echo CHtml::encode($data->subId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Text')); ?>:</b>
	<?php echo CHtml::encode($data->Text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('date')); ?>:</b>
	<?php echo CHtml::encode($data->date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Description')); ?>:</b>
	<?php echo CHtml::encode($data->Description); ?>
	<br />
 -->

</div>