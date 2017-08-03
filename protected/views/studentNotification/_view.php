<?php
/* @var $this StudentNotificationController */
/* @var $data StudentNotification */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Student_NotificationId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Student_NotificationId), array('view', 'id'=>$data->Student_NotificationId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('studentId')); ?>:</b>
	<?php echo CHtml::encode($data->studentId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b>
	<?php echo CHtml::encode($data->text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seen')); ?>:</b>
	<?php echo CHtml::encode($data->seen); ?>
	<br />


</div>