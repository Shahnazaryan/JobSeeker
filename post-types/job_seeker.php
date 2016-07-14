<?php
if(!class_exists('Post_Type_Template'))
{
	class Post_Type_Template
	{
		const POST_TYPE	= "job_seeker";
		private $_meta	= array(
			'seeker_position',
			'seeker_email',
			'seeker_phone',
			'seeker_mobile',
			'seeker_skype',
			'seeker_facebook',
			'seeker_google',
			'seeker_linkedin',
			'seeker_pinterest',
			'seeker_website',
		);
		
    	/**
    	 * The Constructor
    	 */
    	public function __construct()
    	{
    		add_action('init', array(&$this, 'init'));
    		add_action('admin_init', array(&$this, 'admin_init'));
    	} 

    	/**
    	 * hook into WP's init action hook
    	 */
    	public function init()
    	{
    		$this->create_post_type();
    		add_action('save_post', array(&$this, 'save_post'));
			add_action('admin_init', array(&$this, 'change_excerpt_box_title'));
			add_filter( 'enter_title_here', array(&$this,'custom_enter_title') );			
			add_filter('single_template', array(&$this, 'custom_template' ));
    	} 

    	/**
    	 * Create the post type
    	 */
    	public function create_post_type()
    	{
    		register_post_type(self::POST_TYPE,
    			array(
					'labels' => array(
						'name'          => __( 'Job Seeker','seeker'),
						'singular_name' => __( 'Job Seeker','seeker'),
						'add_new'       => __('Add New Job Seeker','seeker'),
						'add_new_item'          =>  __('Add Job Seeker','seeker'),
						'edit'                  =>  __('Edit' ,'seeker'),
						'edit_item'             =>  __('Edit Job Seeker','seeker'),
						'new_item'              =>  __('New Job Seeker','seeker'),
						'view'                  =>  __('View','seeker'),
						'view_item'             =>  __('View Job Seeker','seeker'),
						'search_items'          =>  __('Search Job Seeker','seeker'),
						'not_found'             =>  __('No Job Seeker found','seeker'),
						'not_found_in_trash'    =>  __('No Job Seeker found','seeker'),
						'parent'                =>  __('Parent Job Seeker','seeker')
					),
					'public' => true,
					'has_archive' => true,
					'rewrite' => array('slug' => 'job-seeker'),
					'supports' => array('title', 'thumbnail'),
					'can_export' => true,
					'menu_icon'=> 'dashicons-id' /*plugins_url().'/job_seeker/img/seeker.png'*/
				)
    		);
    	}
		
		public function change_excerpt_box_title() {
			add_meta_box('postexcerpt', __('About Seeker'), array(&$this, 'post_excerpt_meta_boxx'), 'job_seeker', 'normal', 'high');
		}
		
		public function post_excerpt_meta_boxx($post) {
			?>
			<label class="screen-reader-text" for="excerpt"><?php _e('Excerpt') ?></label><textarea rows="1" cols="40" name="excerpt" id="excerpt"><?php echo $post->post_excerpt;?></textarea>
			<?php
		}
		public function custom_enter_title( $input ) {
			global $post_type;

			if ( is_admin() && 'job_seeker' == $post_type )
				return __( 'Add New Seeker Name here', 'seeker' );

			return $input;
		}
		
    	/**
    	 * Save the metaboxes for this custom post type
    	 */
    	public function save_post($post_id)
    	{
            if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            {
                return;
            }
            
    		if(isset($_POST['post_type']) && $_POST['post_type'] == self::POST_TYPE && current_user_can('edit_post', $post_id))
    		{
    			foreach($this->_meta as $field_name)
    			{    					
					update_post_meta($post_id, $field_name, $_POST[$field_name]);					
    			}
    		}
    		else
    		{
    			return;
    		} 
    	} 

    	/**
    	 * hook into WP's admin_init action hook
    	 */
    	public function admin_init()
    	{			    		
    		add_action('add_meta_boxes', array(&$this, 'add_meta_boxes'));
    	} 
			
    	/**
    	 * hook into WP's add_meta_boxes action hook
    	 */
    	public function add_meta_boxes()
    	{
    		add_meta_box( 
    			sprintf('wp_plugin_template_%s_section', self::POST_TYPE),
    			sprintf('%s Information', ucwords(str_replace("_", " ", self::POST_TYPE))),
    			array(&$this, 'add_inner_meta_boxes'),
    			self::POST_TYPE
    	    );					
    	} 

		/**
		 * called off of the add meta box
		 */		
		public function add_inner_meta_boxes($post)
		{		
			include(sprintf("%s/../templates/%s_metabox.php", dirname(__FILE__), self::POST_TYPE));			
		}
		
		public function custom_template( $single ) {
			global $wp_query, $post;
			/* Checks for single template by post type */
			if ($post->post_type == 'job_seeker' ) {
				return plugin_dir_path( __FILE__ )  . '../templates/single-job_seeker.php';
			}
			return $single;
		}	
			
	} 
} 
