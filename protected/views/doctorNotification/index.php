<?php
/* @var $this DoctorNotificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctor Notifications',
);

$this->menu=array(
	array('label'=>'Create DoctorNotification', 'url'=>array('create')),
	array('label'=>'Manage DoctorNotification', 'url'=>array('admin')),
);
?>

<h1>Doctor Notifications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
