<?php
/* @var $this AnswerLikeController */
/* @var $model AnswerLike */

$this->breadcrumbs=array(
	'Answer Likes'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List AnswerLike', 'url'=>array('index')),
	array('label'=>'Create AnswerLike', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#answer-like-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Answer Likes</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'answer-like-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'answerLikeId',
		'studentId',
		'Rate',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
