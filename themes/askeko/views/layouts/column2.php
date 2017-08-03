<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="main" class = "clearfix">
    <aside>
      	<nav>
        	<ul id="menu">
				<!-- <?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Operations',
					));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
					));
				$this->endWidget();
				?> -->
			</ul>
      	</nav>
    </aside>

	<div id="main">
		<?php echo $content; ?>
	</div>
</div> <!-- site_content -->
<?php $this->endContent(); ?>