<?php
$this->breadcrumbs=array(
	'Test',
);?>
<h1><?php echo $this->id . '/' . $this->action->id; ?></h1>

<p>
	You may change the content of this page by modifying
	the file <tt><?php echo __FILE__; ?></tt>.
</p>

<?php $pattern = '<front>
core/node/*
/core/test
<front>';
$path = "/site/index";
function drupal_match_path($path, $patterns) {
    // Convert path settings to a regular expression.
    // Therefore replace newlines with a logical or, /* with asterisks and the <front> with the frontpage.
    $to_replace = array(
      '/(\r\n?|\n)/', // newlines
      '/\\\\\*/', // asterisks
      '/(^|\|)\\\\<front\\\\>($|\|)/', // <front>
    );
    $replacements = array(
      '|',
      '.*',
      '\1' . preg_quote(Yii::app()->setting->get('Webtheme', 'homeUrl', '/site/index'), '/') . '\2',
    );
    $patterns_quoted = preg_quote($patterns, '/');
    $regexp = '/^(' . preg_replace($to_replace, $replacements, $patterns_quoted) . ')$/';
	CVarDumper::dump($regexp, 10, TRUE);
  return (bool) preg_match($regexp, $path);
}

if (drupal_match_path($path, $pattern)) echo "Path: $path match with pattern $pattern";
else echo "Pattern $pattern do not match with $path.";