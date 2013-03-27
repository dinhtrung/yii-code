<?php
$this->breadcrumbs=array(
	Yii::t('core', 'Available Website'),
);
$this->menu=array(
	array(
		'label'	=>	Yii::t('core', 'Configure Website'),
		'url'=>array('settings')
	),
);
?>
<h1><?php echo $this->pageTitle = Yii::t('core', "Available Website"); ?></h1>

<?php foreach ($themes as $theme => $name):?>
	<div class="view">
		<?php $themeinfo = Website::getThemeInfo($theme);?>
		<h2><?php print CHtml::link($themeinfo["information"]["name"], array('view', 'theme' => $theme)); ?></h2>
		<div>
		<?php
			$this->beginWidget("CMarkdown");
			print $themeinfo["information"]["description"];
			$this->endWidget();
		?>
		</div>
		<?php if (! empty($themeinfo["region"])):?>
			<h3><?php print Yii::t('core', 'Available Region'); ?></h3>
				<ul>
				<?php foreach ($themeinfo["region"] as $k => $v):?>
					<?php printf ("<li><strong>%s</strong>: <code>%s</code></li>", $v, $k); ?>
				<?php endforeach;?>
				</ul>
		<?php endif;?>
	</div>
<?php endforeach; ?>
