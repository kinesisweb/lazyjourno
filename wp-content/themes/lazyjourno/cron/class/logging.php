<?php

class DigestLog {
    
    private static $db = 'wp_digest_log';

    private static function timeStamp() {
    	return date('Y-m-d H:i:s');
    }

    public static function insertAction($action = "",$comment = "") {
    	global $wpdb;
    	$wpdb->insert(self::$db, array(
    		'timestamp' => self::timeStamp(),
    		'action' => $action,
    		'comment' => $comment
    	));
    }
}