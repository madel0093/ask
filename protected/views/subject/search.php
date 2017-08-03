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
