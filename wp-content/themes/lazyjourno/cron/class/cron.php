<?php 

class DigestCron {

	private static $settings;

	public function __construct() {
		self::$settings = EsImports::plugin_get_all_settings();
	}

	public static function checkPassphrase() {
		global $wpdb;
		$check = $wpdb->get_row("SELECT option_value FROM wp_digest WHERE option_name='passphrase' LIMIT 1");
		if ($check->option_value != $_GET['pp']) {
			DigestLog::insertAction('cron','Attempted to run cron task with invalid passphrase ('.$_GET['pp'].') from '.$_SERVER['REMOTE_ADDR'].'.');
			echo "Invalid pass-phrase";
			exit;
		}
	}

	public static function checkSchedule() {
		$localsettings = DigestSettings::loadSettings();
		$c_day = date('w');
		$c_hour = date('G');
		if ($c_day !== (int)$localsettings['day'] || $c_hour !== (int)$localsettings['time']) {
			DigestLog::insertAction('cron','Cron job not scheduled. Exiting...');
			exit;
		}
	}

	public static function composeEmail() {
		$localsettings = DigestSettings::loadSettings();
		$subscribers = EsImports::view_subscriber_bulk(); // ID-LIST as parameter

	}

	public static function unsubscribeLink($subscriber = array()) {
		$unsublink = EsImports::plugin_add_home_url(self::$settings['ig_es_unsublink'], "?es=unsubscribe&db={{DBID}}&email={{EMAIL}}&guid={{GUID}}" );
		$cacheid = EsImports::generate_guid(100);
		$dbid = (!empty($subscriber["es_email_id"])) ? $subscriber["es_email_id"] : '';
		$guid = (!empty($subscriber["es_email_guid"])) ? $subscriber["es_email_guid"] : '';
		$email = str_replace("+","%2B",$subscriber['es_email_mail']);
		return EsImports::prepare_unsubscribe_link($unsublink, $email, $dbid, $guid, $cacheid);
	}
}

// Stack