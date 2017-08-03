<?php
/* @var $this DepartmentsController */
/* @var $data Departments */
?>

<div class="view">

	
	<li><h2><?php echo CHtml::link(CHtml::encode($data->Name), array('view', 'id'=>$data->DepartmentId)); ?></h2></li>
	<br />

</div>