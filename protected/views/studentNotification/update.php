<?php
/* @var $this StudentNotificationController */
/* @var $model StudentNotification */

$this->breadcrumbs=array(
	'Student Notifications'=>array('index'),
	$model->Student_NotificationId=>array('view','id'=>$model->Student_NotificationId),
	'Update',
);

$this->menu=array(
	array('label'=>'List StudentNotification', 'url'=>array('index')),
	array('label'=>'Create StudentNotification', 'url'=>array('create')),
	array('label'=>'View StudentNotification', 'url'=>array('view', 'id'=>$model->Student_NotificationId)),
	array('label'=>'Manage StudentNotification', 'url'=>array('admin')),
);
?>

<h1>Update StudentNotification <?php echo $model->Student_NotificationId; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>