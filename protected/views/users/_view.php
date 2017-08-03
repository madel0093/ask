<?php
/* @var $this UsersController */
/* @var $data Users */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('userid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->userid), array('view', 'id'=>$data->userid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Email')); ?>:</b>
	<?php echo CHtml::encode($data->Email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Password')); ?>:</b>
	<?php echo CHtml::encode($data->Password); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Score')); ?>:</b>
	<?php echo CHtml::encode($data->Score); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Fname')); ?>:</b>
	<?php echo CHtml::encode($data->Fname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('Lname')); ?>:</b>
	<?php echo CHtml::encode($data->Lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('DepId')); ?>:</b>
	<?php echo CHtml::encode($data->DepId); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
	<?php echo CHtml::encode($data->type); ?>
	<br />

	*/ ?>

</div>