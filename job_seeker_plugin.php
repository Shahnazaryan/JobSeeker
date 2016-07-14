<?php
/*
Plugin Name: WP Job Seeker
Plugin URI: http://shahumyanmedia.com
Description: Plugin For Job Seekers
Version: 1.0
Author: Gev
Author URI: http://shahumyanmedia.com
License: GPL2
*/


if(!class_exists('WP_Job_Seeker'))
{
	class WP_Job_Seeker
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
			require_once(sprintf("%s/settings.php", dirname(__FILE__)));
			$WP_Job_Seeker_Settings = new WP_Job_Seeker_Settings();

			require_once(sprintf("%s/post-types/job_seeker.php", dirname(__FILE__)));
			$Post_Type_Template = new Post_Type_Template();
			
			require_once(sprintf("%s/class-page-template.php", dirname(__FILE__)));
			$Page_Template_Seeker = new Page_Template_Seeker();

			$plugin = plugin_basename(__FILE__);
			add_filter("plugin_action_links_$plugin", array( $this, 'plugin_settings_link' ));
		}
			

		/**
		 * Activate the plugin
		 */
		public static function activate()
		{
			$new_page_title = 'Job Seekers';
			$new_page_content = '';
			$new_page_template = 'list-seekers.php'; 			
			$page_check = get_page_by_title($new_page_title);
			$new_page = array(
					'post_type' => 'page',
					'post_title' => $new_page_title,
					'post_content' => $new_page_content,
					'post_status' => 'publish',
					'post_author' => 1,
			);
			
			if(!isset($page_check->ID)){
				$new_page_id = wp_insert_post($new_page);
				
				if($new_page_template!=''){
						update_post_meta($new_page_id, '_wp_page_template', $new_page_template);
				}
			}
			
		}

		/**
		 * Deactivate the plugin
		 */
		public static function deactivate()
		{
			$new_page_title = 'Job Seekers';		
			$page_check = get_page_by_title($new_page_title);
			if(isset($page_check->ID)){
				wp_delete_post( $page_check->ID,true );
			}
		}

		/**
		 * @param $links
		 * @return mixed
		 */
		function plugin_settings_link($links)
		{
			$settings_link = '<a href="options-general.php?page=wp_job_seeker">Settings</a>';
			array_unshift($links, $settings_link);
			return $links;
		}


	} 
} 

if(class_exists('WP_Job_Seeker'))
{
	
	register_activation_hook(__FILE__, array('WP_Job_Seeker', 'activate'));
	register_deactivation_hook(__FILE__, array('WP_Job_Seeker', 'deactivate'));

	
	$WP_Job_Seeker = new WP_Job_Seeker();

}
