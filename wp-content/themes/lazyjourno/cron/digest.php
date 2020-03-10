<?php

$lj_action = $_GET['action'];
if (!$lj_action) $lj_action = $_POST['action'];

define( 'SHORTINIT', true );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-load.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/link-template.php' );
require_once( $_SERVER['DOCUMENT_ROOT'] . '/wp-includes/formatting.php' );
require_once( 'class/logging.php' );
require_once( 'class/es_imports.php' );
require_once( 'class/settings.php' );
require_once( 'class/cron.php' );
DigestSettings::checkDefaults();

switch ($lj_action) {
	case "cronjob":
	DigestCron::checkPassphrase();
	//DigestCron::checkSchedule();
	$subscribers = EsImports::get_subscribers();
	$links = array();
	foreach($subscribers as $subscriber) {
		$serial = serialize($subscriber);
		echo $serial . "<br>";
		$link = DigestCron::unsubscribeLink($subscriber);
		array_push($links,$link);
	}
	echo "<br><br>";
	var_dump($links);
	break;

	case "savesettings":
	DigestSettings::saveSettings();
	break;
}