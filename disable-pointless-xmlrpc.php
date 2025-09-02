<?php
/*
Plugin Name: Disable pointless xmlrpc
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Disable XMLRPC.
*/	

if(!defined('ABSPATH')) exit;

add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link'); // Probably redundant, deprecated in WP6.3
?>