<?php
/**
 * This view file help export the node to PDF
 */
$htmlcontents = $this->renderPartial($this->getAction()->defaultView, array("model" => $model), TRUE);
$htmlcontents = strip_tags($htmlcontents, "<div><span><h1><h2><h3><h4><h5><h6><p><blockquote><pre><a><abbr><acronym><address><code><del><dfn><em><img><q><dl><dt><dd><ol><ul><li><table><caption><tbody><tfoot><thead><tr><th><td><article><aside><dialog><figure><footer><header><hgroup><nav><section>");
Yii::import("ext.vendors.mPDF.*");
$mpdf=new mPDF();
$mpdf->useAdobeCJK = true;
$mpdf->SetAutoFont(AUTOFONT_ALL);
$mpdf->SetDisplayMode('fullpage');
$stylesheet = FileHelper::read_file(Yii::getPathOfAlias('webroot.css.print') . '.css');
$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($htmlcontents);
$mpdf->Output(TextHelper::utf2ascii($this->pageTitle), 'I');
Yii::app()->end();

