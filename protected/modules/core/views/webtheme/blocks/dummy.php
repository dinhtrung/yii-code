<div class="view">
<h2>
	<?php print Yii::t('core', "Dummy portlet on region :region", array(':region' => $name)); ?>
</h2>
<blockquote class="loud box">
	<?php print Yii::t('core', "You can customize the theming of this region by edit the layout file, and put the variable <code>$:region</code> into the region.", array(':region' => $region)); ?>
</blockquote>
<?php
	$this->beginWidget("CMarkdown");
	$this->widget('ext.yiiext.widgets.lipsum.ELipsum',array('paragraphs'=>2, 'words'=>20));
	$this->endWidget();
?>
</div>
