<?php
/* @var $this DoctorNotificationController */
/* @var $model DoctorNotification */

$this->breadcrumbs=array(
	'Doctor Notifications'=>array('index'),
	$model->Doctor_NotificationId,
);

$this->menu=array(
	array('label'=>'List DoctorNotification', 'url'=>array('index')),
	array('label'=>'Create DoctorNotification', 'url'=>array('create')),
	array('label'=>'Update DoctorNotification', 'url'=>array('update', 'id'=>$model->Doctor_NotificationId)),
	array('label'=>'Delete DoctorNotification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Doctor_NotificationId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage DoctorNotification', 'url'=>array('admin')),
);
?>

<h1>View DoctorNotification #<?php echo $model->Doctor_NotificationId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Doctor_NotificationId',
		'doctorId',
		'Text',
		'seen',
	),
)); ?>
