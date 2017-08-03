<?php
/* @var $this DoctorsController */
/* @var $model Doctors */

$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	$model->doctorsId,
);

$this->menu=array(
	array('label'=>'List Doctors', 'url'=>array('index')),
	array('label'=>'Create Doctors', 'url'=>array('create')),
	array('label'=>'Update Doctors', 'url'=>array('update', 'id'=>$model->doctorsId)),
	array('label'=>'Delete Doctors', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->doctorsId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Doctors', 'url'=>array('admin')),
);
?>

<h1>View Doctors #<?php echo $model->doctorsId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'doctorsId',
		'Email',
		'Password',
		'Fname',
		'Lname',
		'SubId',
		'Doctorscol',
	),
)); ?>
