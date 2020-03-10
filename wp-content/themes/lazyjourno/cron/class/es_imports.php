<?php 


class esImports {
	public static function plugin_get_all_settings() {

		global $wpdb;

	 	$condition = 'ig_es';
	 	$get_all_es_settings_from_options = $wpdb->prepare( "SELECT option_name, option_value
	 														FROM {$wpdb->prefix}options
	 														WHERE option_name LIKE %s", $wpdb->esc_like( $condition ) . '%' );
	 	$result = $wpdb->get_results( $get_all_es_settings_from_options, ARRAY_A );

	 	$settings = array();

	 	if ( ! empty( $result ) ) {
	 		foreach ($result as $index => $data ) {
	 			$settings[ $data['option_name'] ] = $data['option_value'];
	 		}
	 	}

	 	return $settings;

	}

	public static function plugin_add_home_url( $es_url, $qs ) {
		$qs       = ! empty( $es_url ) ? "?" . parse_url( $es_url, PHP_URL_QUERY ) : $qs;
		$home_url = home_url( '/' );
		$es_url   = $home_url . $qs;

		return $es_url;
	}

	public static function generate_guid($length = 30) {
		$guid = rand();
		$length = 6;
		$rand1 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
		$rand2 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
		$rand3 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
		$rand4 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
		$rand5 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
		$rand6 = substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, $length);
		$guid = $rand1."-".$rand2."-".$rand3."-".$rand4."-".$rand5;
		return $guid;
	}

	public static function get_subscribers() {

		global $wpdb;
		$arrRes = array();

		$sSql = $wpdb->prepare( "SELECT *
								FROM {$wpdb->prefix}es_emaillist
								WHERE es_email_mail != %s", '' );
		$arrRes = $wpdb->get_results( $sSql, ARRAY_A );

		return $arrRes;
	}

	public static function prepare_unsubscribe_link($unsublink, $email, $dbid, $guid, $cacheid) {

		$unsublink = str_replace("{{DBID}}", $dbid, $unsublink);
		$unsublink = str_replace("{{EMAIL}}", $email, $unsublink);
		$unsublink = str_replace("{{GUID}}", $guid, $unsublink);
		$unsublink  = $unsublink . "&cache=".$cacheid;

		return $unsublink;

	}
}