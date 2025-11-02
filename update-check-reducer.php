<?php
/*
Plugin Name: Update check reducer
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Reduce WordPress update checks to once a week instead of every fucking second!
*/	

if(!get_transient('ajdg_update_timeout')) {
	// Disable update transients for core, plugins, and themes
	add_filter('pre_site_transient_update_core', '__return_null');
	add_filter('pre_site_transient_update_plugins', '__return_null');
	add_filter('pre_site_transient_update_themes', '__return_null');
	
	// Remove update check actions from the admin panel
	remove_action('load-update-core.php', 'wp_version_check');
	remove_action('load-update-core.php', 'wp_update_plugins');
	remove_action('load-update-core.php', 'wp_update_themes');
	
	// Block outbound update requests to WordPress.org
	add_filter('pre_http_request', 'ajdg_request_reducer', 100, 3);

	function ajdg_request_reducer($pre, $args, $url) {
		if(
	    	strpos($url, 'api.wordpress.org/core/version-check') !== false 
	    	OR strpos($url, 'api.wordpress.org/plugins/update-check') !== false 
	    	OR strpos($url, 'api.wordpress.org/themes/update-check') !== false
	    ) {
			return true; // Prevent the request from being sent
		}

		return $pre;
	}

	// Set a new timer	
	set_transient('ajdg_update_timeout', time(), 604800);
}
?>