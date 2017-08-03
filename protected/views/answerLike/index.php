<?php
/* @var $this AnswerLikeController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Answer Likes',
);

$this->menu=array(
	array('label'=>'Create AnswerLike', 'url'=>array('create')),
	array('label'=>'Manage AnswerLike', 'url'=>array('admin')),
);
?>

<h1>Answer Likes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
