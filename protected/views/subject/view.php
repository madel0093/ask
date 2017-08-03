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
/* @var $this SubjectController */
/* @var $model Subject */

$this->breadcrumbs=array(
	'Subjects'=>array('index'),
	$model->Name,
);

$this->pageTitle = $model->Name;
$userid=yii::app()->user->getId();
$current_user=  Users::model()->findByPk($userid);
if($current_user->type=='superadmin'){
$this->menu=array(
	array('label'=>'List Subject', 'url'=>array('index')),
	array('label'=>'Create Subject', 'url'=>array('create')),
	array('label'=>'Update Subject', 'url'=>array('update', 'id'=>$model->SubjectId)),
	array('label'=>'Delete Subject', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->SubjectId),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Subject', 'url'=>array('admin')),
	array('label'=>'Create Question', 'url'=>array('questions/create', 'sid'=>$model->SubjectId)),
);
}else if($current_user->type=='student'){
 $this->menu=array(
	array('label'=>'ask Question', 'url'=>array('questions/create', 'sid'=>$model->SubjectId)),
);   
}else if($current_user->type=='doctor'){
    
};
$departmentadmin  = Yii::app()->db->createCommand("SELECT * FROM departmentadmin WHERE userId=$userid;")->queryAll(); 

if(count($departmentadmin) && $model->DepId==$departmentadmin[0]['depId']){
    $this->menu=array(
            array('label'=>'List users', 'url'=>array('ViewUsersAdmin','id'=>$model->SubjectId)),
    );    
}
$user_id  = Yii::app()->user->getId();
for($i=0;$i<count($subjects);$i++){
    $QID=$subjects[$i]['QuestionsId'];
    $uid=$subjects[$i]['userId'];
    $this->widget('application.components.questionsAll', array(
   'question' => $subjects[$i],
   'user_id' => $uid,
   'QID' => $QID,
   'seemore'=>true,
    'questionUserName'=>$this->getName($QID),
));
}
?>
