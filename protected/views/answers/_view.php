<?php
/* @var $this AnswersController */
/* @var $data Answers */
            $id=$data['Answerid'];
            $question = Yii::app()->db->createCommand("SELECT * FROM answers WHERE Answerid=$id")->queryAll();
            if(count($question)==0) $Answerusername="";
            $userid=$question[0]['userId'];
            $user = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid=$userid")->queryAll();
            if(count($user)==0) $Answerusername="";
            $Answerusername = $user[0]['Fname'].' '.$user[0]['Lname'];
?>
<div class="view">

<br />
<br />
<?php $articleid=""; if($data['approved']!=0){ $articleid="green";} ?>
<article id="<?php echo $articleid; ?>">
    
    <section>
        <footer align='left'>
            <span id='arrow'><h2><?php echo $Answerusername;?></h2></span>
         </footer>
            <div class="talk-bubble tri-right border round left-top">
               <div class="talktext">
                   <p><?php echo $question[0]['Text']; ?></p>
               </div>
            </div>
	
	<br />

    <script type="text/javascript">
    function likejsa(field_id ){
        var base_url = "<?php echo Yii::app()->baseUrl;?>/index.php/answerLike/likedislike";
        $.post( base_url, {field_id:field_id} ,
        function(data) {
            $("#displaytext_"+field_id).html(data.displaytext);
            $("#likedislikecount_"+field_id).html(data.count);
        },'json');}</script>
    <footer align="left">
    <span><a class="button like" href="javascript:void(0);" onclick="likejsa('<?php echo $id;?>')" >
        <span id="displaytext_<?php echo $id;?>">
            <?php 
                $user_id  = Yii::app()->user->getId();
                $command  = Yii::app()->db->createCommand("SELECT * FROM answer_like WHERE answerId=$id AND userId=$user_id;");
                $rowCount = $command->execute();
                $rows     = $command->queryAll();
                if($rowCount == 0 || $rows[0]['Rate'] == '0')   {echo 'Like';}
                else                                            {echo 'Unlike';} ?></span>
        <small>(<span id="likedislikecount_<?php echo $id;?>">
            <?php echo Yii::app()->db->createCommand("SELECT COUNT(*) FROM answer_like WHERE answerId=$id AND Rate='1';")->queryScalar();?>
            </span>)</small></a></span>&nbsp
    <?php
        $userid = Yii::app()->user->getId();
        $user = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid=$userid")->queryAll();
        $type = $user[0]['type'];
        $show = false;
        $unapproveCssId = 'answer_unapprove_'.$id;
        $approveCssId = 'answer_approve_'.$id;
        if($type == 'doctor' && ($data['approved']==0 || $data['approved']==$userid))
        {
            $show=true;
    ?>
    <h id='<?php echo $approveCssId;?>'>
        <?php
            echo CHtml::ajaxSubmitButton('approve',
                Yii::app()->createUrl('answers/approve?answerId='.$id),
                array(  'type'=>'POST',                      
                        'success'=>'function(string){$("#'.$approveCssId.'").hide();$("#'.$unapproveCssId.'").show();}'),
                array('class'=>'button save',));
                
        ?>&nbsp
    </h>
    <h id='<?php echo $unapproveCssId; ?>'>
        <?php
            echo CHtml::ajaxSubmitButton('unapprove',
                Yii::app()->createUrl('answers/unapprove?answerId='.$id),
                array( 'type'=>'POST',                      
                        'success'=>'function(string){$("#'.$unapproveCssId.'").hide();$("#'.$approveCssId.'").show();}'),
                array('class'=>'button save',));
            }
        ?>&nbsp
    </h>
            Posted on 
                <span id="arrow"><?php
                $date=$data['Date'];
                    $dt = new DateTime("$date");
                    echo $dt->format('Y-m-d H:i:s');
            ?></span></footer>
        </section>
    </article>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        <?php
        if(!$show){
            echo '$("#'.$approveCssId.'").hide();';
            echo '$("#'.$unapproveCssId.'").hide();';
        }else if($show && $data['approved'] == 0){
            echo '$("#'.$unapproveCssId.'").hide();';
        }else{
            echo '$("#'.$approveCssId.'").hide();';
        }
        ?>
    });
</script>

       