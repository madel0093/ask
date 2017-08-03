<?php
/* @var $this DepartmentsController */
/* @var $model Departments */

$this->breadcrumbs=array(
	'Departments'=>array('index'),
	$model->Name=>array('view','id'=>$model->DepartmentId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Departments', 'url'=>array('index')),
	array('label'=>'Create Departments', 'url'=>array('create')),
	array('label'=>'View Departments', 'url'=>array('view', 'id'=>$model->DepartmentId)),
	array('label'=>'Manage Departments', 'url'=>array('admin')),
);
?>

<h1>Update Departments <?php echo $model->DepartmentId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>