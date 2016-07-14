<?php
/**
 * Template Name: Seeker Page Template
 *
 * A template used to demonstrate how to include the template
 * using this plugin.
 */
 
 get_header(); 
?>

	<!-- section -->
	<section>

		<h1>Job Seekers</h1>       
		<div id="listing_user"> 
			<?php				
				$args = array(
					'posts_per_page' => '5' ,
					'offset' => 0,
					'category' => '',
					'order' => 'DESC',
					'include' => '',
					'exclude' => '',
					'post_type' => 'job_seeker',
					'post_mime_type' => '',
					'post_parent' => '',
					'post_status' => 'publish',
					'suppress_filters' => 0
				);
			$seeker_selection = get_posts($args);			
		
			if ($seeker_selection) {
				foreach($seeker_selection as $post){
				
				global $options;
				$thumb_id            = get_post_thumbnail_id($post->ID);
				$thumb_prop    		 = get_the_post_thumbnail($post->ID, 'full');					
				$preview             = wp_get_attachment_image_src(get_post_thumbnail_id(), 'seeker');
				$trust_img 			 =  wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
				
				$seeker_skype        = esc_html(get_post_meta($post->ID, 'seeker_skype', true));
				$seeker_phone        = esc_html(get_post_meta($post->ID, 'seeker_phone', true));
				$seeker_mobile       = esc_html(get_post_meta($post->ID, 'seeker_mobile', true));
				$seeker_email        = esc_html(get_post_meta($post->ID, 'seeker_email', true));
				$seeker_posit        = esc_html(get_post_meta($post->ID, 'seeker_position', true));					
				$seeker_facebook     = esc_html(get_post_meta($post->ID, 'seeker_facebook', true));
				$seeker_google       = esc_html(get_post_meta($post->ID, 'seeker_google', true));
				$seeker_linkedin     = esc_html(get_post_meta($post->ID, 'seeker_linkedin', true));
				$seeker_pinterest    = esc_html(get_post_meta($post->ID, 'seeker_pinterest', true));
				$seeker_website      = esc_html(get_post_meta($post->ID, 'seeker_website', true));
				$name                = get_the_title();
				$link                = get_permalink();			
				$ID					 = $post->ID;
				$title			     = $post->post_title;
				$comm			     = $post->post_excerpt;
				
				?>
			<!-- article -->
				<article id="post-<?php echo $ID; ?>" <?php post_class(); ?>>
					<div class="seekerpic-wrapper">
						<div class="seeker-img-wrapper" data-link="<?php echo  $link; ?>">			
							<a href="<?php print $link;?>">
								 <?php the_post_thumbnail(array(150,150));?>
							</a>
							<div class="listing-cover"></div>
							<div class="listing-cover-title"><a href="<?php echo $link;?>"><?php echo $name;?></a></div>
						</div>
						<div class="seeker_unit_social_single">
							<div class="social-wrapper"> 
								<?php
									if($seeker_facebook!=''){
										print ' <a href="'. $seeker_facebook.'"><i class="fa fa-facebook"></i></a>';
									}
									if($seeker_google!=''){
										print ' <a href="'.$seeker_google.'"><i class="fa fa-google-plus"></i></a>';
									}				
									if($seeker_linkedin!=''){
										print ' <a href="'.$seeker_linkedin.'"><i class="fa fa-linkedin"></i></a>';
									}				
									if($seeker_pinterest!=''){
										 print ' <a href="'. $seeker_pinterest.'"><i class="fa fa-pinterest"></i></a>';
									}
								?>
							</div>
						</div>
					</div> 
					<div class="seeker_details">    
							<div class="mydetails">
								My details
							</div>
							<?php   
							print '<h3><a href="'.$link.'">' .$name. '</a></h3>
							<div class="seeker_position">'.$seeker_posit.'</div>';
							if ($seeker_phone) {
								print '<div class="seeker_detail"><i class="fa fa-phone"></i><a href="tel:' . $seeker_phone . '">' . $seeker_phone . '</a></div>';
							}
							if ($seeker_mobile) {
								print '<div class="seeker_detail"><i class="fa fa-mobile"></i><a href="tel:' . $seeker_mobile . '">' . $seeker_mobile . '</a></div>';
							}
							if ($seeker_email) {
								print '<div class="seeker_detail seeker_email_class"><i class="fa fa-envelope-o"></i><a href="mailto:' . $seeker_email . '">' . $seeker_email . '</a></div>';
							}
							if ($seeker_skype) {
								print '<div class="seeker_detail"><i class="fa fa-skype"></i>' . $seeker_skype . '</div>';
							}     
							if ($seeker_website) {
								print '<div class="seeker_detail"><i class="fa fa-edge"></i><a href="http://'.$seeker_website.'" target="_blank">'.$seeker_website.'</a></div>';
							}
							?>
					</div>  
					<div class="seeker_content">
						<h4><?php _e('About Me ','seeker'); ?></h4>    
						<p>	<?php echo $comm ?> </p>
					</div>
				</article>
			<!-- /article -->
			<?php }}	?>
		</div>
	</section><!-- /section -->


<?php get_footer(); ?>	