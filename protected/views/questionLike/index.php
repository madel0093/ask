<?php
/* @var $this QuestionLikeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Question Likes',
);

$this->menu=array(
	array('label'=>'Create QuestionLike', 'url'=>array('create')),
	array('label'=>'Manage QuestionLike', 'url'=>array('admin')),
);
?>

<h1>Question Likes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
