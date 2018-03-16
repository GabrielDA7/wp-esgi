<?php
/**
* @package SliderEsgiPlugin
*/
/*
Plugin Name: SliderEsgi Plugin
Description: Premier plugin permettant d'ajouter un slider dans ma page home
Version: 0.1
Author: Gabriel Daoud / Louis Decultot
License: GPLv2 or later
Text Domain: slideresgi-plugin
*/
define('WPCIS_PLUGINS_URL', plugins_url());
define('WPCIS_FOLDER', basename(dirname(__FILE__)));
define('WPCIS_SITE_URL', get_option('siteurl'));

include('admin-page.php');

function on_install() {
  include('install/install.sql.php'); // install
}

register_activation_hook(__FILE__, 'on_install');

function on_uninstall() {
  include('install/uninstall.sql.php'); // uninstall
}

register_uninstall_hook(__FILE__, 'on_uninstall');

