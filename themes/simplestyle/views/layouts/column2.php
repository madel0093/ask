<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div id="content_header"></div>
<div id="site_content">
	<div id="sidebar_container">
		<div class="sidebar">
			<div class="sidebar_top"></div>
			<div class="sidebar_item">
				<?php
				$this->beginWidget('zii.widgets.CPortlet', array(
					'title'=>'Operations',
					));
				$this->widget('zii.widgets.CMenu', array(
					'items'=>$this->menu,
					'htmlOptions'=>array('class'=>'operations'),
					));
				$this->endWidget();
				?>
			</div>
			<div class="sidebar_base"></div>
		</div>
	</div> <!-- sidebar_container -->

	<div id="content" role="main">
		<?php echo $content; ?>
	</div>
</div> <!-- site_content -->
<?php $this->endContent(); ?>