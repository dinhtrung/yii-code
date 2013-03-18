<div class="ddeditor">
<?php if (in_array("bold", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId ?>-editor-bold"><b><?php echo Yii::t('ddeditor','B'); ?></b></button>
<?php endif; ?>
<?php if (in_array("italic", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId ?>-editor-italic"><i><?php echo Yii::t('ddeditor','I'); ?></i></button>
<?php endif; ?>
<?php if (in_array("h", $snippets)):?>
<select id="<?php echo $editorId ?>-editor-h">
    <option value=""><?php echo Yii::t('ddeditor','H'); ?></option>
    <?php for($i=1; $i<=5; $i++ ) : ?>
    <option value="<?php echo $i ?>"><?php echo Yii::t('ddeditor','H'); ?><?php echo $i ?></option>
    <?php endfor; ?>
</select>
<?php endif; ?>
<?php if (in_array("link", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId ?>-editor-link">URL</button>
<!--
<button
    type="button"
    id="<?php echo $editorId ?>-editor-img">IMG</button>
-->
<?php endif; ?>
<?php if (in_array("img", $snippets)):?>
<select id="<?php echo $editorId ?>-editor-img2">
    <option value=""><?php echo Yii::t('ddeditor','IMG'); ?></option>
    <option value="!"><?php echo Yii::t('ddeditor','Inline'); ?></option>
    <option value="*"><?php echo Yii::t('ddeditor','Highslide'); ?></option>
</select>
<?php endif; ?>
<?php if (in_array("li", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId ?>-editor-li">&bull;</button>
<?php endif; ?>
<?php if (in_array("hr", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId ?>-editor-hr"><?php echo Yii::t('ddeditor','HR'); ?></button>
<?php endif; ?>
<?php if (in_array("code", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId ?>-editor-code">Code</button>
<?php endif; ?>
<?php if (in_array("code2", $snippets)):?>
<select id="<?php echo $editorId ?>-editor-code2">
    <option value=""><?php echo Yii::t('ddeditor','Code'); ?></option>
    <?php foreach(explode(", ","ABAP, CPP, CSS, DIFF, DTD, HTML, JAVA, JAVASCRIPT, MYSQL, PERL, PHP, PYTHON, RUBY, SQL, XML") as $language) : ?>
    <option value="<?php echo strtolower($language) ?>"><?php echo $language; ?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>
<?php if (in_array("codetable", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId ?>-editor-table"><?php echo Yii::t('ddeditor','Table'); ?></button>
<?php endif; ?>
<?php if (in_array("addlines", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId; ?>-editor-addlines">+</button>
<?php endif; ?>
<?php if (in_array("remlines", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId; ?>-editor-remlines">-</button>
<?php endif; ?>
<?php if (in_array("preview", $snippets)):?>
<button
    type="button"
    id="<?php echo $editorId; ?>-editor-preview"><?php echo Yii::t('ddeditor','Preview'); ?></button>
<?php endif; ?>
<br/>
<?php if(sizeof($additionalSnippets)>0) : ?>
<?php $n=0; foreach($additionalSnippets as $name=>$additionalSnippet) : $additionalSnippet = array_merge(array($name),$additionalSnippet); ?>
<?php echo CHtml::dropDownList($editorId.'-editor-addS-'.$n,'',$additionalSnippet); ?>
<?php $n++; endforeach; ?>
<br/>
<?php endif; ?>
<?php echo CHtml::activeTextArea($model,$attribute,$htmlOptions); ?>
<div id="<?php echo $editorId; ?>-preview" class="preview"><?php echo Yii::t('ddeditor','Loading Preview...'); ?></div>
</div>
