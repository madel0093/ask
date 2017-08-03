<?php
/* @var $this DoctorNotificationController */
/* @var $model DoctorNotification */

$this->breadcrumbs=array(
	'Doctor Notifications'=>array('index'),
	$model->Doctor_NotificationId=>array('view','id'=>$model->Doctor_NotificationId),
	'Update',
);

$this->menu=array(
	array('label'=>'List DoctorNotification', 'url'=>array('index')),
	array('label'=>'Create DoctorNotification', 'url'=>array('create')),
	array('label'=>'View DoctorNotification', 'url'=>array('view', 'id'=>$model->Doctor_NotificationId)),
	array('label'=>'Manage DoctorNotification', 'url'=>array('admin')),
);
?>

<h1>Update DoctorNotification <?php echo $model->Doctor_NotificationId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>