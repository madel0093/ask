<?php
/* @var $this DoctorsController */
/* @var $model Doctors */

$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	$model->doctorsId=>array('view','id'=>$model->doctorsId),
	'Update',
);

$this->menu=array(
	array('label'=>'List Doctors', 'url'=>array('index')),
	array('label'=>'Create Doctors', 'url'=>array('create')),
	array('label'=>'View Doctors', 'url'=>array('view', 'id'=>$model->doctorsId)),
	array('label'=>'Manage Doctors', 'url'=>array('admin')),
);
?>

<h1>Update Doctors <?php echo $model->doctorsId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>