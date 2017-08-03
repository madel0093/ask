<?php
/* @var $this DoctorsController */
/* @var $model Doctors */

$this->breadcrumbs=array(
	'Doctors'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Doctors', 'url'=>array('index')),
	array('label'=>'Manage Doctors', 'url'=>array('admin')),
);
?>

<h1>Create Doctors</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>