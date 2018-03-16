<?php 
global $wpdb;

require_once(ABSPATH . '/wp-admin/includes/upgrade.php');

$sql = "DROP TABLE IF EXISTS `".$wpdb->prefix."slider`";
$wpdb->query($sql);

?>