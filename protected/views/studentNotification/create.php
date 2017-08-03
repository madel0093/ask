<?php
/* @var $this StudentNotificationController */
/* @var $model StudentNotification */

$this->breadcrumbs=array(
	'Student Notifications'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List StudentNotification', 'url'=>array('index')),
	array('label'=>'Manage StudentNotification', 'url'=>array('admin')),
);
?>

<h1>Create StudentNotification</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>