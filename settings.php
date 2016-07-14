<?php
if(!class_exists('WP_Job_Seeker_Settings'))
{
	class WP_Job_Seeker_Settings
	{
		/**
		 * Construct the plugin object
		 */
		public function __construct()
		{
            add_action('admin_init', array(&$this, 'admin_init'));
        	add_action('admin_menu', array(&$this, 'add_menu'));
		} 
		
        /**
         * hook into WP's admin_init action hook
         */
        public function admin_init()
        {
        	register_setting('wp_job_seeker-group', 'setting_a');
        	register_setting('wp_job_seeker-group', 'setting_b');

        	add_settings_section(
        	    'wp_job_seeker-section', 
        	    '', 
        	    array(&$this, 'settings_section_seeker_template'), 
        	    'wp_job_seeker'
        	);
            add_settings_field(
                'wp_job_seeker-setting_a', 
                'Setting A', 
                array(&$this, 'settings_field_input_text'), 
                'wp_job_seeker', 
                'wp_job_seeker-section',
                array(
                    'field' => 'setting_a'
                )
            );
            add_settings_field(
                'wp_job_seeker-setting_b', 
                'Setting B', 
                array(&$this, 'settings_field_input_text'), 
                'wp_job_seeker', 
                'wp_job_seeker-section',
                array(
                    'field' => 'setting_b'
                )
            );
        } 
        
        public function settings_section_seeker_template()
        {           
            echo 'These settings do things for the WP Job Seeker.';
        }
        
        /**
         * This function provides text inputs for settings fields
         */
        public function settings_field_input_text($args)
        {            
            $field = $args['field'];
            $value = get_option($field);
            echo sprintf('<input type="text" name="%s" id="%s" value="%s" />', $field, $field, $value);
        } 
        
        /**
         * add a menu
         */		
        public function add_menu()
        {
        	add_options_page(
        	    'WP Job Seeker Settings', 
        	    'WP Job Seeker', 
        	    'manage_options', 
        	    'wp_job_seeker', 
        	    array(&$this, 'plugin_settings_page')
        	);
        } 
    
        /**
         * Menu Callback
         */		
        public function plugin_settings_page()
        {
        	if(!current_user_can('manage_options'))
        	{
        		wp_die(__('You do not have sufficient permissions to access this page.'));
        	}
        	include(sprintf("%s/templates/settings.php", dirname(__FILE__)));
        } 
   } 
}