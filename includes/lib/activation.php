<?php
global $wpdb;
if ( ! function_exists( 'dbDelta' ) ) {
	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
}
$charset_collate = '';
if ( ! empty( $wpdb->charset ) ) {
	$charset_collate .= "DEFAULT CHARACTER SET $wpdb->charset";
}
if ( ! empty( $wpdb->collate ) ) { 
	$charset_collate .= " COLLATE $wpdb->collate";
}
$qs_progress_db_table = $wpdb->prefix . 'qs_progress';
if($wpdb->get_var( "show tables like '$qs_progress_db_table'" ) != $qs_progress_db_table)
    {
		$qs_progress_create_query = "CREATE TABLE " . $qs_progress_db_table . " (
						`id` int(11) unsigned NOT NULL auto_increment,
						`user_id` int(11) unsigned NOT NULL,
						`quit_date` datetime NOT NULL,
						`date_format` varchar(255) NOT NULL,
					  	`cig_per_day` int(11) NOT NULL,
					  	`cig_pack_price` float(12,2) NOT NULL,
					  	`currency` varchar(255) NOT NULL,
					  	`first_cig_after_wakeup` varchar(255) NOT NULL,
					  	`created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					  	`updated_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					  	PRIMARY KEY  (id),
					  	UNIQUE KEY `user_id` (`user_id`)
						) " . $charset_collate . ";";
}
dbDelta( $qs_progress_create_query );
$wpdb->query( "ALTER TABLE " . $qs_progress_db_table . " MODIFY COLUMN id int(11) unsigned NOT NULL AUTO_INCREMENT" );
$wpdb->query( "ALTER TABLE " . $qs_progress_db_table . " ADD `quit_date_iso` VARCHAR(15) NOT NULL AFTER `quit_date`" );
$qs_achievement_db_table = $wpdb->prefix . 'qs_achievements';
if($wpdb->get_var( "show tables like '$qs_achievement_db_table'" ) != $qs_achievement_db_table)
    {
		$qs_achievement_create_query = "CREATE TABLE " . $qs_achievement_db_table . " (
						`id` int(11) unsigned NOT NULL auto_increment,
						`name` varchar(255) NOT NULL,
						`type` enum('money','time','cigarette') NOT NULL DEFAULT 'time',
						`num_type` int(11) NOT NULL,
					    `achievement_order` int(11) NOT NULL,
					    `image` varchar(255) NOT NULL,
					    `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
					    `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
					    `status` tinyint(1) NOT NULL DEFAULT '1',
					  	PRIMARY KEY  (id)
						) " . $charset_collate . ";";


}
dbDelta( $qs_achievement_create_query );
$wpdb->query( "ALTER TABLE " . $qs_achievement_db_table . " MODIFY COLUMN id int(11) unsigned NOT NULL AUTO_INCREMENT" );
$achievement_data = "INSERT INTO " . $qs_achievement_db_table . " (`id`, `name`, `type`, `num_type`, `achievement_order`, `image`, `created_date`, `updated_date`, `status`) VALUES
(1, '24 hours', 'time', 1440, 1, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(2, '48 hours', 'time', 2880, 2, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(3, '3 days', 'time', 4320, 3, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(4, '1 week', 'time', 10080, 4, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(5, '2 weeks', 'time', 20160, 5, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(6, '3 weeks', 'time', 30240, 6, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(7, '1 month', 'time', 43800, 7, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(8, '2 months', 'time', 87600, 8, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(9, '3 months', 'time', 131400, 9, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(10, '6 months', 'time', 262800, 10, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(11, '1 year', 'time', 525600, 11, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(12, '1 year and a half', 'time', 788400, 12, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(13, '2 years', 'time', 1051200, 13, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(14, '3 years', 'time', 1576800, 14, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(15, '4 years', 'time', 2102400, 15, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(16, '5 years', 'time', 2628000, 16, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(17, '10 years', 'time', 5256000, 17, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(18, '20 years', 'time', 1051200, 18, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(19, '100 saved', 'money', 100, 1, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 10:00:37', 1),
(20, '500 saved', 'money', 500, 2, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(21, '1000 saved', 'money', 1000, 3, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(22, '2500 saved', 'money', 2500, 4, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(23, '5000 saved', 'money', 5000, 5, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(24, '10000 saved', 'money', 10000, 6, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(25, '20000 saved', 'money', 20000, 7, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(26, '50000 saved', 'money', 50000, 8, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(27, '100000 saved', 'money', 100000, 9, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(28, '100 cigarettes not smoked', 'cigarette', 100, 1, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 09:59:31', 1),
(29, '250 cigarettes not smoked', 'cigarette', 250, 2, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(30, '500 cigarettes not smoked', 'cigarette', 500, 3, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(31, '1000 cigarettes not smoked', 'cigarette', 1000, 4, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(32, '5000 cigarettes not smoked', 'cigarette', 5000, 5, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(33, '10000 cigarettes not smoked', 'cigarette', 10000, 6, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1),
(34, '30000 cigarettes not smoked', 'cigarette', 30000, 7, 'https://cdn1.iconfinder.com/data/icons/ui-color1/512/Untitled-40-512.png', '2020-12-03 02:31:54', '2020-12-03 02:32:16', 1);";
$wpdb->query( $achievement_data );
?>