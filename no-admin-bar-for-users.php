<?php
/*
Plugin Name: No admin bar for users
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Remove the black admin bar on the front-end for non-admins.
*/	

if(!defined('ABSPATH')) exit;

/* ----------------------------------------------------------------
// Remove admin bar for non-admins
---------------------------------------------------------------- */
function ajdg_hide_admin_bar_for_non_admin( $show ) {
	return (!current_user_can('administrator')) ? false : true;
}
add_filter('show_admin_bar', 'ajdg_hide_admin_bar_for_non_admin', 20, 1);
?>