<?php
/**
 * Provide recent content feature
 * @see Node::recentContentData()
 * @see Node::recentContentConfig()
 */
$recent = Node::model()->findAll(array('order' => 'createtime DESC', 'limit' => 5));

foreach ($recent as $data){
	$this->renderPartial("core.views.node._view", array('data' => $data));
}