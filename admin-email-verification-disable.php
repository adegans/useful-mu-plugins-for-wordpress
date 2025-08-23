<?php
/*
Plugin Name: Admin email verification disable
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Don't ask to verify the admin email every minute. Stop pestering website admins!
*/	

if(!defined('ABSPATH')) exit;

/* ----------------------------------------------------------------
// Disable the pointless periodic email check for admins
---------------------------------------------------------------- */
add_filter( 'admin_email_check_interval', '__return_false' );

?>