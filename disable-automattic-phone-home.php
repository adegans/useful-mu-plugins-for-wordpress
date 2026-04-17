<?php
/*
Plugin Name: Disable Automattic phone home
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Stop Automattics sneaky data collecting about browsers and PHP versions
*/	

if(!defined('ABSPATH')) exit;

/* ----------------------------------------------------------------
// Stop talking to automattic about things they don't need to know
---------------------------------------------------------------- */
add_filter('pre_http_request', 'ajdg_dont_talk_to_automattic', 10, 3);

function ajdg_dont_talk_to_automattic($ret, $request, $url) {
	// No more reporting on what browser you use
	set_site_transient('browser_' . md5($_SERVER['HTTP_USER_AGENT']), array("upgrade" => 0), 604800);
	if(strpos($url, 'https://api.wordpress.org/core/browse-happy') === true) return new WP_Error('http_request_failed', sprintf('Request to %s is not allowed.', $url));

	// Ignore PHP compatibility (Yes, you need to manage that yourself then!)
	set_site_transient('php_check_' . md5(PHP_VERSION), array("is_acceptable" => 1, "is_lower_than_future_minimum" => 0), 604800);
	if(strpos($url, 'https://api.wordpress.org/core/serve-happy') === true) return new WP_Error('http_request_failed', sprintf('Request to %s is not allowed.', $url));

    return $ret;
}
?>