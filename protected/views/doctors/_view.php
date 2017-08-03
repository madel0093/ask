<?php
/* @var $this DoctorsController */
/* @var $data Doctors */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('doctorsId')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->doctorsId), array('view', 'id'=>$data->doctorsId)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fname')); ?>:</b>
	<?php echo CHtml::encode($data->Fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Lname')); ?>:</b>
	<?php echo CHtml::encode($data->Lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('SubId')); ?>:</b>
	<?php echo CHtml::encode($data->SubId); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Doctorscol')); ?>:</b>
	<?php echo CHtml::encode($data->Doctorscol); ?>
	<br />


</div>