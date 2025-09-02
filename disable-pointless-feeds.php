<?php
/*
Plugin Name: Disable pointless feeds
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Disable all feeds except RSS.
*/	

if(!defined('ABSPATH')) exit;

function ajdg_disable_feeds() {
	$siteurl = get_option('siteurl');
	wp_die('RDF and Atom feeds are disabled, please use RSS instead: '.$siteurl.'/feed/');
}

add_action('do_feed_rdf', 'ajdg_disable_feeds', 1);
add_action('do_feed_atom', 'ajdg_disable_feeds', 1);
add_action('do_feed_atom_comments', 'ajdg_disable_feeds', 1);

?>