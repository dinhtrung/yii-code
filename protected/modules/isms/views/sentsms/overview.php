<?php
$this->breadcrumbs=array(
	'Tổng hợp tin đã gửi'	=>	array(Yii::t('app', 'overview')),
);

$this->renderPartial('_menu');
?>

<div class="wide form">

<?php $this->beginWidget('CActiveForm', array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
)); ?>

        <div class="row">
                <label>Chọn ngày cần tổng kết</label>
                <?php echo CHtml::textField('time', $time); ?>
                <?php echo CHtml::textField('offset', $offset); ?>
                <p class="info description">Vui lòng nhập định dạng ngày tháng: YYYY-MM-DD (ví dụ: <samp><?php echo $time; ?></samp>)
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton(Yii::t('app', 'Search')); ?>
        </div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->

<h1><?php echo $this->pageTitle = 'Tổng hợp tin đã gửi'; ?></h1>
<p class="info">Thống kê số tin nhắn và chương trình nhắn tin từ ngày <em class="red"><?php echo $time; ?></em> đến <em class="red"><?php echo $offset; ?></em>.</p>
<h3>Tin đã gửi thành công</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sentok',
	'dataProvider'=>$sentok,
	'enablePagination'=>false,

	'columns'=>array(
					'campaign_id', 'sender', 'time', 'msgdata', 'cnt'
	),
)); ?>

<h3>Tin chưa gửi được</h3>
<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'sentfailed',
	'dataProvider'=>$sentfailed,
'enablePagination'=>false,

	'columns'=>array(
					'campaign_id', 'sender', 'time', 'msgdata', 'cnt'
	),
)); ?>
