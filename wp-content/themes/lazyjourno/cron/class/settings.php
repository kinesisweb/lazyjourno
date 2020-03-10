<?php

class DigestSettings {

	public static function checkDefaults() {
		global $wpdb;
		$defaults = array(
			"day" => 5,
			"time" => 17,
			"articles" => 10,
			"template" => "",
			"active" => 0,
			"mailcount" => 100,
			"passphrase" => "sympomania",
			"introduction" => "Welcome to your latest installment of the Lazy Journo Weekly Digest."
		);
		foreach($defaults as $x => $x_val) {
			$rows = $wpdb->get_results( "SELECT * FROM wp_digest WHERE option_name='$x'");
			if (count($rows) === 0) {
				$result = $wpdb->insert('wp_digest', array(
				    'option_name' => $x,
				    'option_value' => $x_val
				));
			}
		}	
	}

	public static function loadSettings() {
		global $wpdb;
		$rows = $wpdb->get_results( "SELECT * FROM wp_digest");
		$settings = array();
		foreach ($rows as $row) {
			$settings[$row->option_name] = $row->option_value;
		}
		return $settings;
	}

	public static function saveSettings() {
		global $wpdb;
		foreach( $_POST as $stuff => $val ) {
			if ($stuff == "action") continue;
			$wpdb->query($wpdb->prepare("UPDATE wp_digest SET option_value=%s WHERE option_name=%s", array($val,$stuff)));
		}
		header("Location: " . $_SERVER['HTTP_REFERER'] . "&save=success");
		die();
	}
}