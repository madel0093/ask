<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
  <meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=windows-1252" />

  <link href="<?php echo Yii::app()->theme->baseUrl;?>/includes/bootstrap/css/bootstrap.css" id="bootstrap-css" rel="stylesheet" type="text/css" />
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/includes/bootstrap/css/bootstrap-responsive.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/includes/bootstrap/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.pnotify.min.js"></script>
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.pnotify.default.css" media="all" rel="stylesheet" type="text/css" />
  <link href="<?php echo Yii::app()->theme->baseUrl;?>/js/jquery.pnotify.default.icons.css" media="all" rel="stylesheet" type="text/css" />

  <meta name="language" content="en" />
  <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl;?>/css/style.css" />
  <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
  <div id="main">
    <div id="header">

      <div id="logo">
        <div id="logo_text">
          <h1><a href="#"><span class="logo_colour"><?php echo CHtml::encode($this->pageTitle); ?></span></a></h1>
          <h2>Simple. Contemporary. Databse Project.</h2>
        </div>
      </div>

      <div id="menubar">
        <ul id="menu">
          <?php 
          $userId = Yii::app()->user->getId();
          $notifies = $notifiesSize = NULL;
          if(!Yii::app()->user->isGuest){
            $notifies = Yii::app()->db->createCommand("SELECT * FROM notification WHERE userid=$userId AND seen=0;")->queryAll();
            $notifiesSize = count($notifies);
          }

          $c_action = $this->action->id;
          $c_controller = $this->uniqueid;
          $home = $about = $contact = $login = $logout = $notify = 'menu';
          if($c_controller == 'site' && $c_action == 'index')    $home = 'selected';
          if($c_controller == 'departments'&& $c_action == 'view')       $about = 'selected';
          if($c_controller == 'site' && $c_action == 'contact')    $contact = 'selected';
          if($c_controller == 'site' && $c_action == 'login')     $login = 'selected';
          if($c_controller == 'site' && $c_action == 'logout')     $logout = 'selected';
          if($c_controller == 'site' && $c_action == 'logout')     $logout = 'selected';
          if($c_controller == 'users' && $c_action == 'notify')     $notify = 'selected';

          $this->widget('zii.widgets.CMenu',array(
            'id'=>'menu',
            'items'=>array(
                  // 'itemOptions'=>array('class'=>'selected')
              array('label'=>'Home', 'url'=>array('/site/index') , 'itemOptions'=>array('class'=>$home)),
              array('label'=>'subjects', 'url'=>array('/departments/view'), 'itemOptions'=>array('class'=>$about)),
              array('label'=>'Contact', 'url'=>array('/site/contact') , 'itemOptions'=>array('class'=>$contact)),
              array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest , 'itemOptions'=>array('class'=>$login)),
              array('label'=>'Notification ('.$notifiesSize.')', 'url'=>array('/users/notify'), 'visible'=>!Yii::app()->user->isGuest , 'itemOptions'=>array('class'=>$notify)),
              array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest , 'itemOptions'=>array('class'=>$logout))
              ),
            ));
            ?>
          </ul>
        </div>

      </div> <!-- header -->

<?php
 $this->widget('application.extensions.PNotify.PNotify',array(
          'options'=>array(
              'text'=>'sad',
              'delay'=>0,
              'opacity'=>0,))
        );
  if(!Yii::app()->user->isGuest){
    Yii::app()->db->createCommand("UPDATE notification set seen=1 WHERE userid=$userId;")->execute();
    for ($i=0; $i < $notifiesSize; $i++) { ?>
        <script type="text/javascript">
          $(document).ready(function(){
            var notice = $.pnotify({
                      text: '<?php echo CHtml::link(CHtml::encode($notifies[$i]['text']), array('questions/view', 'id'=>$notifies[$i]['questionId']));?>'
                    });});  </script> <?php
    }
  }
?>

<script type="text/javascript"> var notice = $.pnotify({}); </script>

<div id="content_header"></div>
<div id="site_content">
       <?php echo $content; ?>
</div>
</div> <!-- site_content -->
     <div id="content_footer"></div>
     <div id="footer">
      <p>Copyright &copy; 2013 Askakeko</p>
    </div>

  </div> <!-- main -->
</body>
</html>
