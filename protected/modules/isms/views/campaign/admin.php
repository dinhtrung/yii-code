<?php
if(empty($this->breadcrumbs)) $this->breadcrumbs=array(
	Yii::t('isms', 'Campaigns')
);

if(empty($this->menu)) $this->renderPartial('_menu', array('model' => $model));

		Yii::app()->clientScript->registerScript('search', "
			$('.search-button').click(function(){
				$('.search-form').toggle();
				return false;
				});
			$('.search-form form').submit(function(){
				$.fn.yiiGridView.update('campaign-grid', {
					data: $(this).serialize()
				});
				return false;
				});
			");
		?>

<h1>
<?php echo $this->pageTitle = Yii::t('app', 'Manage') . ' ' . Yii::t('isms', 'Campaigns'); ?>
</h1>
<blockquote> <p> <?php echo Yii::t('app', 'You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b> or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.'); ?> </p> </blockquote>

<?php echo CHtml::link(Yii::t('app', 'Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>

<?php
$buttons = array(
					'approval' => array(
						'label'=>Yii::t('isms', 'Approval'),     // text label of the button
						'url'=>'Yii::app()->controller->createUrl("approved",array("id"=>$data->primaryKey))',
					),
					'update' => array(

					),
					'delete' => array(

					),
			);
if(!isset($buttons['approval']['click']))
{
			$confirmation="if(!confirm(".CJavaScript::encode(Yii::t('isms', 'Toggle approval status for this campaign?')).")) return false;";

			if(Yii::app()->request->enableCsrfValidation)
			{
				$csrfTokenName = Yii::app()->request->csrfTokenName;
				$csrfToken = Yii::app()->request->csrfToken;
				$csrf = "\n\t\tdata:{ '$csrfTokenName':'$csrfToken' },";
			}
			else
				$csrf = '';

			$afterApproval='function(){}';

			$buttons['approval']['click']=<<<EOD
function() {
	$confirmation
	var th=this;
	var afterApproval=$afterApproval;
	$.fn.yiiGridView.update('#campaign-grid', {
		type:'POST',
		url:$(this).attr('href'),$csrf
		success:function(data) {
			$.fn.yiiGridView.update('#campaign-grid');
			afterApproval(th,true,data);
		},
		error:function(XHR) {
			return afterApproval(th,false,XHR);
		}
	});
	return false;
}
EOD;
		}

$btn = array();
if (Yii::app()->getUser()->checkAccess('Isms.Campaign.View')) $btn[] = '{view}';
if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Update')) $btn[] = '{update}';
if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Delete')) $btn[] = '{delete}';
// if (Yii::app()->getUser()->checkAccess('Isms.Campaign.Approved')) $btn[] = '{approval}';

 $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'campaign-grid',
	'dataProvider'=> (Yii::app()->getUser()->checkAccess('Isms.Campaign.*'))? $model->search(): $model->myCampaign(),
	'filter'=>$model,
	'columns'=>array(
		array('name' => 'title', 'value' => '"<strong>" . $data->title."</strong>\n <code>(" . $data->codename . ")</code>\n<br/><em>" . $data->description."</em>"', 'type' => 'html'),
		array('name' => 'start', 'value' => '$data->start."\n".$data->end', 'type' => 'ntext'),
		array('name' => 'status', 'value' => '"<ul><li>" . Campaign::statusOption($data->status)
				."</li>\n<li>". Campaign::readyOption($data->ready)
				."</li>\n<li>". Campaign::activeOption($data->active)
				."</li>\n<li>". ($data->finished && ($data->end < date("Y-m-d H:i:s", time()))?(Campaign::finishedOption(1)):(Campaign::finishedOption(0)))
				."</li>\n</ul>"', 'type' => 'html'),
		array('name' => 'approved', 'value' => '"<ul><li>"
				. Campaign::approvedOption($data->approved)
				."</li>\n<li>". Campaign::limit_exceededOption($data->limit_exceeded)
				."</li>\n</ul>"', 'type' => 'html'),
		/*
		'request_date',
		'request_owner',
		'datasender',
		'tosubscriber',

		array(
					'name'=>'active',
					'value'=>'$data->active?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\', \'No\')',
							'filter'=>array('0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')),
							),
		'sender',
		'ready',
		array(
					'name'=>'org',
					'value'=>'CHtml::value($data,\'org0.title\')',
							'filter'=>CHtml::listData(Organization::model()->findAll(), 'id', 'title'),
							),
		array(
					'name'=>'type',
					'value'=>'$data->type?Yii::t(\'app\',\'Yes\'):Yii::t(\'app\', \'No\')',
							'filter'=>array('0'=>Yii::t('app','No'),'1'=>Yii::t('app','Yes')),
							),
		'throughput',
		'col',
		'isdncol',
		'template',
		'priority',
		'velocity',
		'cpworkday',
		'emailbox',
		'esubject',
		'eattachment',
		'ftpserver',
		*/
		array(
			'class'=>'EButtonColumnWithClearFilters',
			'buttons' => $buttons,
			'template'	=>	implode(' ', $btn),
		),
	),
)); ?>
