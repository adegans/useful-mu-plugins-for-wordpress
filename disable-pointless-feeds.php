<?php
/*
Plugin Name: Disable pointless feeds
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Disable all feeds except RSS.
*/	

if(!defined('ABSPATH')) exit;

/* ----------------------------------------------------------------
// Disable certain feed types
---------------------------------------------------------------- */
function ajdg_disable_feeds() {
	wp_die('RDF and Atom feeds are disabled, please use RSS instead: '.home_url('/feed/'));
}

add_action('do_feed_rdf', 'ajdg_disable_feeds', 1);
add_action('do_feed_atom', 'ajdg_disable_feeds', 1);
add_action('do_feed_atom_comments', 'ajdg_disable_feeds', 1);

/* ----------------------------------------------------------------
// Redirect sub-feeds
---------------------------------------------------------------- */
function ajdg_disable_sub_feeds() {
	if (is_feed() && !is_home()) {
        wp_redirect(home_url('/blog/feed/'), 301);
        exit;
 	}
}

add_action('template_redirect', 'ajdg_disable_sub_feeds');
?>