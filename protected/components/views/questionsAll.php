<?php
 $subjects=$this->question;
 $user_id=$this->user_id;
 $QID=$this->QID;
?>
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
  <article>
            <section>

<h1 align="left"><?php echo CHtml::encode($subjects['Text']); ?></h1>
<h3 align="left" style="margin-left: 20px;"> <?php if($this->seemore==true){echo substr(CHtml::encode($subjects['Description']),0,300)."..........";}else{ echo CHtml::encode($subjects['Description']); }?> </h3>

</section>
            <?php if($this->seemore==true){?>
            <div align="right"><a class="button" href="<?php echo Yii::app()->baseUrl;?>/index.php/questions/<?php echo $QID; ?>" >see more</a></div>
            <?php } ?>
            <footer align="left">
<span><a class="button like" href="javascript:void(0);" onclick="likejsq('<?php echo $QID;?>')" >
    <span id="displaytext_<?php echo $QID;?>">
        <?php 
            $rows  = Yii::app()->db->createCommand("SELECT * FROM question_like WHERE questionId=$QID AND userId=$user_id;")->queryAll();;
            $rowCount = count($rows);
            if($rowCount == 0 || $rows[0]['rate'] == '0')   {echo 'Like';}
            else                                            {echo 'Unlike';} ?></span>
    <small>(<span id="likedislikecount_<?php echo $QID;?>">
            <?php echo Yii::app()->db->createCommand("SELECT COUNT(*) FROM question_like WHERE questionId=$QID AND rate='1';")->queryScalar();?>
        </span>)</small></span></a>
    
<span><a class="button star" href="javascript:void(0);" onclick="favjsq('<?php echo $QID;?>')" >
    <span id="displaytext3_<?php echo $QID;?>">
        <?php 
            $rowCount  = Yii::app()->db->createCommand("SELECT * FROM favorite WHERE QuestionId=$QID AND userid=$user_id;")->execute();
            if($rowCount == 0)   {echo 'Add to Favorites';}
            else                 {echo 'Remove from Favorites';} ?></span></a></span>&nbsp

<span><a class="button add" href="javascript:void(0);" onclick="followjsq('<?php echo $QID;?>')" >
    <span id="displaytext2_<?php echo $QID;?>">
        <?php 
            $rowCount  = Yii::app()->db->createCommand("SELECT * FROM follower WHERE questionId=$QID AND userid=$user_id;")->execute();
            if($rowCount == 0)   {echo 'Follow';}
            else                 {echo 'Unfollow';} ?></span></a></span>&nbsp

<?php 
$subId = $subjects['subId'];
$sub = Yii::app()->db->createCommand("SELECT * FROM subject WHERE SubjectId = $subId;")->queryAll();
?>
            <footer>
            </br>
                Subject <span id='arrow'><?php echo $sub[0]['Name'] ; ?></span> Posted on <span id='arrow'>March 18th, 2011</span> By <span id='arrow'><?php  echo $this->questionUserName;?></span>
            </footer>


            
        </article>