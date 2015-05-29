<?php

$module = $Params['Module'];
$tpl = eZTemplate::factory();

$siteName = eZINI::instance()->variable( 'SiteSettings', 'SiteName' );
$siteUrl = '/';
eZURI::transformURI( $siteUrl, false, 'full' );
$tpl->setVariable( 'site_url', $siteName . ' (' . $siteUrl . ')' );

$infoMail = false;
if ( eZINI::instance()->hasVariable( 'MailSettings', 'PrivacyEmail' ) && eZINI::instance()->variable( 'MailSettings', 'PrivacyEmail' ) != '' )
    $infoMail = eZINI::instance()->variable( 'MailSettings', 'PrivacyEmail' );

elseif ( eZINI::instance( 'notification.ini' )->hasVariable( 'MailSettings', 'EmailSender' ) && eZINI::instance( 'notification.ini' )->variable( 'MailSettings', 'EmailSender' ) != '' )
    $infoMail = eZINI::instance( 'notification.ini' )->variable( 'MailSettings', 'EmailSender' );

elseif ( eZINI::instance()->hasVariable( 'MailSettings', 'AdminEmail' ) && eZINI::instance()->variable( 'MailSettings', 'AdminEmail' ) != '' )
    $infoMail = eZINI::instance()->variable( 'MailSettings', 'AdminEmail' );

$tpl->setVariable( 'info_mail', $infoMail );

$Result = array();
$Result['content'] = $tpl->fetch( 'design:cookie.tpl' );
$Result['path'] = array( array( 'text' => 'Cookie' , 'url' => false ) );