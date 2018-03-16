<?php
global $wpdb;
extract($_POST);

if(isset($_GET['act']) && $_GET['act'] == 'save') {
    $wpdb->query("INSERT INTO ".$wpdb->prefix."slider(nom,url) VALUES('".$nom."','".$url."')");
} else if(isset($_GET['act']) && $_GET['act'] == 'delete') {
	$wpdb->query("DELETE FROM ".$wpdb->prefix."slider WHERE id=".$_GET['id']);
}
?>