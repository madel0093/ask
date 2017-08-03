<?php
/* @var $this StudentNotificationController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Student Notifications',
);

$this->menu=array(
	array('label'=>'Create StudentNotification', 'url'=>array('create')),
	array('label'=>'Manage StudentNotification', 'url'=>array('admin')),
);
?>

<h1>Student Notifications</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
