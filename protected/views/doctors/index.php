<?php
/* @var $this DoctorsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doctors',
);

$this->menu=array(
	array('label'=>'Create Doctors', 'url'=>array('create')),
	array('label'=>'Manage Doctors', 'url'=>array('admin')),
);
?>

<h1>Doctors</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
