<?php

global $wpdb;

require_once(ABSPATH . '/wp-admin/includes/upgrade.php');


$sql =
"
CREATE TABLE IF NOT EXISTS `".$wpdb->prefix."slider` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM CHARACTER SET = `utf8`;
";

dbDelta($sql);

?>