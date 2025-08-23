<?php
/*
Plugin Name: Disable pointless feeds
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Disable all feeds except RSS2.
*/	

if(!defined('ABSPATH')) exit;

/* ----------------------------------------------------------------
// Disable certain feed types
---------------------------------------------------------------- */
function ajdg_disable_feeds() {
	$siteurl = get_option('siteurl');
	wp_die('RDF and Atom feeds are disabled, please use RSS2 instead: '.$siteurl.'/feed/');
}

add_action('do_feed_rdf', 'ajdg_disable_feeds', 1);
add_action('do_feed_atom', 'ajdg_disable_feeds', 1);
add_action('do_feed_atom_comments', 'ajdg_disable_feeds', 1);

?>