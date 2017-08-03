<?php
/* @var $this DoctorNotificationController */
/* @var $model DoctorNotification */

$this->breadcrumbs=array(
	'Doctor Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List DoctorNotification', 'url'=>array('index')),
	array('label'=>'Manage DoctorNotification', 'url'=>array('admin')),
);
?>

<h1>Create DoctorNotification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>