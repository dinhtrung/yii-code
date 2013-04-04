<?php
/**
 * Imap connection flags
 *
 * /service=service	mailbox access service, default is "imap"
/user=user	remote user name for login on the server
/authuser=user	remote authentication user; if specified this is the user name whose password is used (e.g. administrator)
/anonymous	remote access as anonymous user
/debug	record protocol telemetry in application's debug log
/secure	do not transmit a plaintext password over the network
/imap, /imap2, /imap2bis, /imap4, /imap4rev1	equivalent to /service=imap
/pop3	equivalent to /service=pop3
/nntp	equivalent to /service=nntp
/norsh	do not use rsh or ssh to establish a preauthenticated IMAP session
/ssl	use the Secure Socket Layer to encrypt the session
/validate-cert	validate certificates from TLS/SSL server (this is the default behavior)
/novalidate-cert	do not validate certificates from TLS/SSL server, needed if server uses self-signed certificates
/tls	force use of start-TLS to encrypt the session, and reject connection to servers that do not support it
/notls	do not do start-TLS to encrypt the session, even with servers that support it
/readonly	request read-only mailbox open (IMAP only; ignored on NNTP, and an error with SMTP and POP3)
 */
?>

<div class="row">
	<?php echo $form->labelEx($model,'option'); ?>
	<?php if (is_string($model->option)) $model->option = explode('/', $model->option);
	echo $form->checkBoxList($model,'option',$model->optionOption(), array('labelOptions' => array('style' => 'display:inline'))); ?>
	<?php echo $form->error($model,'option'); ?>
	<?php if('_HINT_Emailsetting.option' != $hint = Yii::t('isms', '_HINT_Emailsetting.option')) echo $hint; ?>
</div>

