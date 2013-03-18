<ul class="actions">
<?php 
if(UserModule::isAdmin()) {
?>
<li><?php echo CHtml::link(Yii::t('user', 'Manage User'),array('/user/admin')); ?></li>
<?php 
} else {
?>
<li><?php echo CHtml::link(Yii::t('user', 'List User'),array('/user')); ?></li>
<?php
}
?>
<li><?php echo CHtml::link(Yii::t('user', 'Profile'),array('/user/profile')); ?></li>
<li><?php echo CHtml::link(Yii::t('user', 'Edit'),array('edit')); ?></li>
<li><?php echo CHtml::link(Yii::t('user', 'Change password'),array('changepassword')); ?></li>
<li><?php echo CHtml::link(Yii::t('user', 'Logout'),array('/user/logout')); ?></li>
</ul>