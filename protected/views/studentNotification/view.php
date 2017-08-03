<?php
/* @var $this StudentNotificationController */
/* @var $model StudentNotification */

$this->breadcrumbs=array(
	'Student Notifications'=>array('index'),
	$model->Student_NotificationId,
);

$this->menu=array(
	array('label'=>'List StudentNotification', 'url'=>array('index')),
	array('label'=>'Create StudentNotification', 'url'=>array('create')),
	array('label'=>'Update StudentNotification', 'url'=>array('update', 'id'=>$model->Student_NotificationId)),
	array('label'=>'Delete StudentNotification', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->Student_NotificationId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage StudentNotification', 'url'=>array('admin')),
);
?>

<h1>View StudentNotification #<?php echo $model->Student_NotificationId; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'Student_NotificationId',
		'studentId',
		'text',
		'seen',
	),
)); ?>
