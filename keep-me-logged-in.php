<?php
/*
Plugin Name: Keep admins logged in
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Extends the cookie ttl to 30 days. Stop pestering website admins!
*/	

if(!defined('ABSPATH')) exit;

/* ----------------------------------------------------------------
// Keep me logged in
---------------------------------------------------------------- */
function change_wp_cookie_logout($expiration, $user_id, $remember){
    if($remember AND user_can($user_id, 'manage_options')) {
        $expiration = (86400 * 30); // 30 days in seconds
    }
    return $expiration;
}
add_filter('auth_cookie_expiration', 'change_wp_cookie_logout', 10, 3);

?>