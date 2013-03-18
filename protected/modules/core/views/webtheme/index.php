<?php
$this->breadcrumbs=array(
	Yii::t('webtheme', 'Available Webtheme'),
);
$this->menu=array(
	array(
		'label'	=>	Yii::t('webtheme', 'Configure Webtheme'),
		'url'=>array('settings')
	),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('webtheme', "Available Webtheme"); ?></h1>

<?php foreach ($themes as $theme => $name):?>
	<div class="view">
		<?php $themeinfo = Webtheme::getThemeInfo($theme);?>
		<h2><?php print CHtml::link($themeinfo["information"]["name"], array('view', 'theme' => $theme)); ?></h2>
		<div>
		<?php
			$this->beginWidget("CMarkdown");
			print $themeinfo["information"]["description"];
			$this->endWidget();
		?>
		</div>
		<?php if (! empty($themeinfo["region"])):?>
			<h3><?php print Yii::t('webtheme', 'Available Region'); ?></h3>
				<ul>
				<?php foreach ($themeinfo["region"] as $k => $v):?>
					<?php printf ("<li><strong>%s</strong>: <code>%s</code></li>", $v, $k); ?>
				<?php endforeach;?>
				</ul>
		<?php endif;?>
	</div>
<?php endforeach; ?>
