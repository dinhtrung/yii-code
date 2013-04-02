<?php echo "<?php\n"; ?>
$this->mainMenu['<?php echo $this->moduleID; ?>'] = array(
	'label' => Yii::t('<?php echo $this->moduleID; ?>', '<?php echo $this->moduleClass; ?>'),
	'url'=>array('/<?php echo $this->moduleID; ?>/default/index'),
	'visible' => Yii::app()->user->checkAccess('<?php echo $this->moduleClass; ?>.Default.Index'),
	'items'=>array(
		array(
				'label' => Yii::t('?php echo $this->moduleID; ?>', 'Controller.Action'),
				'url'=>array('/<?php echo $this->moduleID; ?>/controller/action'),
				'visible' => Yii::app()->user->checkAccess('<?php echo $this->moduleClass; ?>.Controller.Action')
			),
	),
);