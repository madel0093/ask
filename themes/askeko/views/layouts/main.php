<?php
    $baseurl = Yii::app()->baseUrl . "/index.php/";
    $userId = Yii::app()->user->getId();
    Yii::app()->clientScript->registerCoreScript('jquery');

    $users = Yii::app()->db->createCommand("SELECT * FROM studs ;")->queryAll();
    for($i=0;$i<count($users);$i++)
    {
      $userid=$users[$i]['userId'];
      $studentAnswersLikeCounts = Yii::app()->db->createCommand("SELECT  count(*) FROM answer_like as al,answers as a WHERE a.userId=$userid AND al.answerId=a.Answerid AND a.approved='0' AND al.rate = '1' ")->queryAll();
      $studentApprovedCounts = Yii::app()->db->createCommand("SELECT  count(*) FROM answer_like as al,answers as a WHERE a.userId=$userid AND al.answerId=a.Answerid AND a.approved>0")->queryAll();
      $studentQuestionLikeCounts = Yii::app()->db->createCommand("SELECT  count(*) FROM question_like as ql,questions as q WHERE q.userId=$userid AND ql.questionId=q.QuestionsId AND ql.rate = '1' ;")->queryAll();
      $score=$studentAnswersLikeCounts[0]['count(*)']+$studentApprovedCounts[0]['count(*)']*10+$studentQuestionLikeCounts[0]['count(*)'];
      Yii::app()->db->createCommand("UPDATE studs SET Score='$score' WHERE userId='$userid'")->execute();
    }

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>

  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />
  <meta name="language" content="en" />

  <link href="<?php echo Yii::app()->theme->baseUrl;?>/includes/bootstrap/css/bootstrap.css" id="bootstrap-css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/includes/bootstrap/js/bootstrap.min.js"></script>
  <meta charset="UTF-8">
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  <script src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery-latest.min.js"></script> 
  <!-- <script src="http://code.jquery.com/jquery-latest.min.js"></script>    -->
  <script>
    function initMenu() {
          $('#menu ul').hide(); // Hide the submenu
          if ($('#menu li').has('ul')) $('#menu ul').prev().addClass('expandable'); // Expand/collapse a submenu when it exists  
          $('.expandable').click(
            function() {
              $(this).next().slideToggle();
              $(this).toggleClass('expanded');
            }
            );
        }
      // When document ready, call initMenu() function 
      $(document).ready(function() {initMenu();});   
      $(document).ready(function(){
          $(this).find('#login-span').html('&#x25BC;');
	$('#login-trigger').click(function(){
		$(this).next('#login-content').slideToggle();
		$(this).toggleClass('active');					
		
		if ($(this).hasClass('active')) $(this).find('#login-span').html('&#x25B2;')
			else $(this).find('#login-span').html('&#x25BC;')
		})
            });
  </script>
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/font.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/login.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/chatbubble.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/topten.css" />
<style type="text/css">
  .test {
    font: inherit;
    color: #008000;
    background: #eee;
  }
  .foot {
    width: 960px;
    margin: 0 auto;
    padding: 10px 0;
    text-align: center;
  }
</style>
</head>
<?php
  $notifies = $notifiesSize = NULL;
  if(!Yii::app()->user->isGuest){
    $notifies = Yii::app()->db->createCommand("SELECT * FROM notification WHERE userid=$userId AND seen=0;")->queryAll();
    $notifiesSize = count($notifies);
    $this->widget('application.extensions.PNotify.PNotify',array('options'=>array('delay'=>0,'opacity'=>0,)));
   }
?>
<script type="text/javascript">
    var base_url = '<?php echo Yii::app()->baseUrl;?>/index.php/site/dynamicNotification';
    setInterval(function(){
      $.get( base_url, function( data ) {
        for (var i = 0; i < data.count; i++) {
          $.pnotify({text: data.messages[i]});
        }
       
      } , 'json');
    }, 2000);
</script>
<body>
  <header> 
    <hgroup class="clearfix"> 
      <h1><a href="#"><span class="logo_colour">ASKAKEKO</span></a></h1>
      <center>
      <form id="searchbox" action="<?php echo $baseurl.'subject/search';?>">
        <input name="query" id="search" type="text" placeholder="Type here">
        <input id="submit" type="submit" value="Search">
       </form>
       </center>
      <nav id='login_block'>
	<ul>
    <?php if($userId==NULL){ ?>
  		<li id="login">
  			<a id="login-trigger" href="#">
  				Log in <span id='login-span'></span>
  			</a>
  			<div id="login-content">
  				<form id="login-form" action='<?php echo $baseurl.'site/login';?>' method="post">
  					<fieldset id="inputs">
  						<input id="username" type="email" name="LoginForm[username]" placeholder="Your email address" required>   
  						<input id="password" type="password" name="LoginForm[password]" placeholder="Password" required>
  					</fieldset>
  					<fieldset id="actions">
  						<input type="submit" id="submit" value="Log in">
  						<label><input name='LoginForm[rememberMe]' type="checkbox" checked="checked"> Keep me signed in</label>
  					</fieldset>
  				</form>
  			</div>                     
  		</li>
  		<li id="signup">
  			<a href="<?php echo $baseurl.'users/Register';?>">Sign up FREE</a>
  		</li>
    <?php }else{?>
  		<li id="login">
  			<a id="login-trigger" href="#">
  				Notification <span class="bubble"><?php echo $notifiesSize; ?></span>
  			</a>
  			<div id="login-content">
          <p>
            <?php for ($i=0; $i < $notifiesSize; $i++) { 
                  //echo CHtml::link(CHtml::encode($notifies[$i]['text']), array('questions/view', 'id'=>$notifies[$i]['questionId'])); ?>
                  <p><a class="test" href="<?php echo $baseurl.'questions/view/'.$notifies[$i]['questionId'];?>"><?php echo $notifies[$i]['text']; ?></a></p>
            <?php }?>
            <h3><a class="test" href="<?php echo $baseurl.'users/notify';?>">See All</a></h3>
          </p>
  			</div>                     
  		</li>
      <li id="signup"> <a href="<?php echo $baseurl.'site/logout';?>">logout</a></li>
    <?php }?>
	</ul>
</nav>
    </hgroup>
  </header>

  <div id="main" class="clearfix">
    <aside>
      <nav>
        <ul id="menu">
          <li><a href="<?php echo $baseurl.'site/index';?>">Home</a></li>
          <li><a href="<?php echo $baseurl.'site/about';?>">About</a></li>              
          <li><a href="<?php echo $baseurl.'site/contact';?>">Contact</a></li>              
          <?php
            if(Yii::app()->user->isGuest == true){ ?>
              <li><a href="<?php echo $baseurl.'site/login';?>">Login</a></li> <?php
            }else{ 
                 if(Yii::app()->user->getState('activated')>-1){  
                ?>
  
              <li><a href="#">Subjects</a>
                <ul> 
                    <?php
               
                      $dep = Yii::app()->db->createCommand("SELECT * FROM users WHERE  userid=$userId ;")->queryAll();
                      $depid = $dep[0]['DepId'];
                      $subs=array();
                      if($dep[0]['type']=="student"){
                          $year= Yii::app()->db->createCommand("SELECT * FROM studs WHERE userId = $userId;")->queryAll();
                          $year = $year[0]['year'];
                          $subs = Yii::app()->db->createCommand("SELECT * FROM subject WHERE DepId=$depid AND year='$year';")->queryAll();
                      }else if($dep[0]['type']=="doctor"){
                          $subs = Yii::app()->db->createCommand("SELECT * FROM subject WHERE SubjectId in (SELECT SubId FROM doctors WHERE userId=$userId);")->queryAll();
                      }
                      $c = count($subs);
                      for ($i=0; $i < $c; $i++) { ?>
                        <li><a href="<?php echo $baseurl.'subject/view/'.$subs[$i]['SubjectId'];?>"><?php echo $subs[$i]['Name']; ?></a></li> <?php
                      }
                    ?>
                </ul>        
              </li>
              <li><a href="#">Favorits</a>
                <ul> 
                    <?php for ($i=0; $i < $c; $i++) { ?>
                        <li><a href="<?php echo $baseurl.'users/favorites/'.$userId."?sub=".$subs[$i]['SubjectId'];?>"><?php echo $subs[$i]['Name']; ?></a></li> <?php
                      } 
                      ?>
                </ul>        
              </li>

              <li><a href="#">Operations</a><?php
              $this->widget('zii.widgets.CMenu', array(
              'items'=>$this->menu,
              'htmlOptions'=>array('class'=>'operations'),
              ));
            }
        }
          ?>
        </ul>
      </nav>
        <br>
        <?php if(Yii::app()->user->isGuest == false) { ?>
        <article>
            <section id="topTenHeader">
                TOP TEN 
            </section>
            <section class="container">
              <?php 
                $top = Yii::app()->db->createCommand("SELECT * FROM studs ORDER BY Score DESC LIMIT 0 , 10;")->queryAll();
                $topC = count($top);
                $sum = 0;
                for ($i=0; $i < $topC; $i++) { 
                  $sum += $top[$i]['Score'];
                }
                for ($i=0; $i < $topC; $i++) { 
                  $studId = $top[$i]['userId'];
                  if($sum!=0)
                  $percent = ($top[$i]['Score'] / $sum) * 100;
                  else $percent =0;
                  $stud = Yii::app()->db->createCommand("SELECT * FROM users WHERE userid = $studId;")->queryAll();
                  ?>
                    <div class="record"><div class="bar" style="width:<?php echo $percent; ?>%;"><span><?php echo $stud[0]['Fname'].' '.$stud[0]['Lname']; ?></span></div><div class="p"><span><?php echo $top[$i]['Score'].' PTS'."&nbsp&nbsp&nbsp&nbsp".$percent; ?>%</span></div></div>  
              <?php  }
              ?>
            </section>
            <?php } ?>
    </aside>

    <div id="content">
      <?php echo $content; ?>
    </div>
  </div>

  <div class="foot">
      <p>Copyright &copy; 2013 <a href="<?php echo $baseurl.'site/about';?>">Askeko</a></p>
      <!-- Twitter and Facebook
      <div id="tw">
          <a href="http://twitter.com/catalinred" class="twitter-follow-button" data-show-count="false">Follow @catalinred</a>
          <script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
      </div>
      <div id="fb">
          <div id="fb-root"></div><script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
          <script>document.write('<fb:like href="www.red-team-design.com" send="false" layout="button_count" width="50" show_faces="false"></fb:like>');</script>
      </div> -->
  </div>
</body>

</html>
