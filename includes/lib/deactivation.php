<?php
	global $wpdb;
    if(get_option("delete_progress_tool")){
	    $qs_progress_db_table = $wpdb->prefix . 'qs_progress';
		$wpdb->query( "DROP TABLE IF EXISTS $qs_progress_db_table" );
		$qs_achievement_db_table = $wpdb->prefix . 'qs_achievements';
		$wpdb->query( "DROP TABLE IF EXISTS $qs_achievement_db_table" );
	    delete_option("enable_progress_tool");
	    delete_option("delete_progress_tool");
	}
