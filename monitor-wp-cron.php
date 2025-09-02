<?php
/*
Plugin Name: WP-Cron Fixatron
Plugin URI: https://ajdg.solutions/
Author: Arnan de Gans
Author URI: https://www.arnan.me/
Description: Run through whatever jobs were active in the last check and maybe re-schedule the missing ones since then
*/	

if(!defined('ABSPATH')) exit;

function ajdg_check_cron_jobs(){
	$recheck_jobs = get_transient('ajdg_wpcron_recheck');

	if(!$recheck_jobs) {
		// Check every few hours (time in seconds, default is 43200 (12 hours))
		$check_interval = 43200; 

		$cached_jobs = get_transient('ajdg_wpcron_cached');

		if($cached_jobs) {
			// Run through cached jobs to see if they're still active	
			foreach($cached_jobs as $start_time => $job) {
				if(!is_numeric($start_time)) continue;
				
				foreach($job as $job_hook => $details) {
					// Is it still scheduled?
					if(!wp_next_scheduled($job_hook)) {
						// Should only be true if the plugin/action still exists
						if(has_action($job_hook) === true) {
							$details = reset($details);
	
							// $details['schedule'] being false indicates a single run event and should (probably) only be rescheduled if $start_time is in the future
							// Or schedule a recurring event instead
							if($details['schedule'] === false AND $start_time >= time()) {
								wp_schedule_single_event($start_time, $job_hook, $details['args']);
							} else {
								wp_schedule_event($start_time, $details['schedule'], $job_hook, $details['args']);
							}
						}
					}
		
					unset($job_hook, $details);
				}
		
				unset($start_time, $job);
			}
		}
	
		// Cache the current/updated job list for the next check
		$current_jobs = get_option('cron', array());

		set_transient('ajdg_wpcron_cached', $current_jobs, $check_interval + 600);
		set_transient('ajdg_wpcron_recheck', 1, $check_interval);
	}

	unset($current_jobs, $cached_jobs);
}

add_action('init', 'ajdg_check_cron_jobs');
?>