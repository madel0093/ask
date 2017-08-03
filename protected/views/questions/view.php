<script type="text/javascript">
    function likejsq(field_id ){
        var base_url = "<?php echo Yii::app()->baseUrl;?>/index.php/questionLike/likedislike";
        $.post( base_url, {field_id:field_id} ,
        function(data) {
            $("#displaytext_"+field_id).html(data.displaytext);
            $("#likedislikecount_"+field_id).html(data.count);
        },'json');
    }</script>



<script type="text/javascript">
    function followjsq(field_id ){
        var base_url = "<?php echo Yii::app()->baseUrl;?>/index.php/Follower/followunfollow";
        $.post( base_url, {field_id:field_id} ,
        function(data) { $("#displaytext2_"+field_id).html(data.displaytext2); },'json');
    }</script>


<script type="text/javascript">
    function favjsq(field_id ){
        var base_url = "<?php echo Yii::app()->baseUrl;?>/index.php/users/favorite";
        $.post( base_url, {field_id:field_id} ,
        function(data) { $("#displaytext3_"+field_id).html(data.displaytext3); },'json');
    }</script>
<?php
 $user_id  = Yii::app()->user->getId();
/* @var $this QuestionsController */
/* @var $model Questions */

$this->breadcrumbs=array(
	'Questions'=>array('index'),
	$model->QuestionsId,
);

$this->menu=array(
	array('label'=>'List Questions', 'url'=>array('index')),
	array('label'=>'Create Questions', 'url'=>array('create')),
	array('label'=>'Update Questions', 'url'=>array('update', 'id'=>$model->QuestionsId)),
	array('label'=>'Delete Questions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->QuestionsId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Questions', 'url'=>array('admin')),
	array('label'=>'Create Answer', 'url'=>array('answers/create', 'qid'=>$model->QuestionsId)),
);
    $QID=$model->QuestionsId;
    $this->widget('application.components.questionsAll', array(
   'question' => $model,
   'user_id' => $user_id,
   'QID' => $QID,
   'seemore'=>false,
    'questionUserName'=>$this->getName($QID),
));
?>

<br />
<article>
    <section>
        <?php 		
            $model2=new Answers;
        	$model2->QuestionId = $model->QuestionsId;
        	$model2->userId = Yii::app()->user->getId();
            $this->renderPartial('_answerform', array('model'=>$model2)); 
        ?>
        </section>
    </article>
<div id='answersdata'>
<?php
$this->renderPartial('renderAnswers', array('QuestionsId'=>$model2->QuestionId));
?>
</div>
