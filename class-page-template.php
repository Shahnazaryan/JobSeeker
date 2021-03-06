<?php

class Page_Template_Seeker {


    protected $plugin_slug;
	protected $templates;
	
	public function __construct() {

		$this->templates = array();
		$this->plugin_locale = 'seeker';
		

		add_filter('page_attributes_dropdown_pages_args', array( $this, 'register_project_templates' ) );
		add_filter('wp_insert_post_data', array( $this, 'register_project_templates' ) );
		add_filter('template_include', array( $this, 'view_project_template') );
		register_deactivation_hook( __FILE__, array( $this, 'deactivate' ) );
		$this->templates = array(
			'list-seekers.php'     => __( 'Seeker Page Template', $this->plugin_slug ),		
		);

		$templates = wp_get_theme()->get_page_templates();
		$templates = array_merge( $templates, $this->templates );
	}
	
   	/**
	 * @param $atts
	 * @return mixed
	 */
	public function register_project_templates( $atts ) {

		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		$templates = wp_cache_get( $cache_key, 'themes' );
		if ( empty( $templates ) ) {
			$templates = array();
		}

		wp_cache_delete( $cache_key , 'themes');
		
		$templates = array_merge( $templates, $this->templates );

		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;
	}

	/**
	 * @param $template
	 * @return string
	 */
	public function view_project_template( $template ) {

		global $post;

		if ( !isset( $post ) ) return $template;

		if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
			return $template;
		}

		$file = plugin_dir_path( __FILE__ ) . 'templates/' . get_post_meta( $post->ID, '_wp_page_template', true );

		if( file_exists( $file ) ) {
			return $file;
		}
		return $template;

	}
	

	/**
	 * @param $network_wide
	 */
	static function deactivate( $network_wide ) {
		foreach($this as $value) {
			page-template-seeker::delete_template( $value );
		}
		
		
	}

	/*--------------------------------------------*
	 * Delete Templates from Theme
	*---------------------------------------------*/
	public function delete_template( $filename ){				
		$theme_path = get_template_directory();
		$template_path = $theme_path . '/' . $filename;  
		if( file_exists( $template_path ) ) {
			unlink( $template_path );
		}


		wp_cache_delete( $cache_key , 'themes');
	}

	/**
	 * Retrieves and returns the slug of this plugin. This function should be called on an instance
	 * of the plugin outside of this class.
	 */
	public function get_locale() {
		return $this->plugin_slug;
	}

}
