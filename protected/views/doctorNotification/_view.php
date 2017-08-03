<?php
/* @var $this DoctorNotificationController */
/* @var $data DoctorNotification */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('Doctor_NotificationId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->Doctor_NotificationId), array('view', 'id'=>$data->Doctor_NotificationId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('doctorId')); ?>:</b>
	<?php echo CHtml::encode($data->doctorId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Text')); ?>:</b>
	<?php echo CHtml::encode($data->Text); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('seen')); ?>:</b>
	<?php echo CHtml::encode($data->seen); ?>
	<br />


</div>