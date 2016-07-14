<?php 
	print'
		<p class="meta-options">
		<label for="seeker_position">'.__('Position:','seeker').' </label><br />
		<input type="text" id="seeker_position" size="58" name="seeker_position" value="'.  esc_html(get_post_meta($post->ID, 'seeker_position', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_email">'.__('Email:','seeker').' </label><br />
		<input type="text" id="seeker_email" size="58" name="seeker_email" value="'.  esc_html(get_post_meta($post->ID, 'seeker_email', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_phone">'.__('Phone: ','seeker').'</label><br />
		<input type="text" id="seeker_phone" size="58" name="seeker_phone" value="'.  esc_html(get_post_meta($post->ID, 'seeker_phone', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_mobile">'.__('Mobile:','seeker').' </label><br />
		<input type="text" id="seeker_mobile" size="58" name="seeker_mobile" value="'.  esc_html(get_post_meta($post->ID, 'seeker_mobile', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_skype">'.__('Skype: ','seeker').'</label><br />
		<input type="text" id="seeker_skype" size="58" name="seeker_skype" value="'.  esc_html(get_post_meta($post->ID, 'seeker_skype', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_facebook">'.__('Facebook: ','seeker').'</label><br />
		<input type="text" id="seeker_facebook" size="58" name="seeker_facebook" value="'.  esc_html(get_post_meta($post->ID, 'seeker_facebook', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_twitter">'.__('Google +: ','seeker').'</label><br />
		<input type="text" id="seeker_google" size="58" name="seeker_google" value="'.  esc_html(get_post_meta($post->ID, 'seeker_google', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_linkedin">'.__('Linkedin: ','seeker').'</label><br />
		<input type="text" id="seeker_linkedin" size="58" name="seeker_linkedin" value="'.  esc_html(get_post_meta($post->ID, 'seeker_linkedin', true)).'">
		</p>
		<p class="meta-options">
		<label for="seeker_pinterest">'.__('Pinterest: ','seeker').'</label><br />
		<input type="text" id="seeker_pinterest" size="58" name="seeker_pinterest" value="'.  esc_html(get_post_meta($post->ID, 'seeker_pinterest', true)).'">
		</p>
		<p class="meta-options">
			<label for="seeker_website">'.__('Website (without http): ','seeker').'</label><br />
			<input type="text" id="seeker_website" size="58" name="seeker_website" value="'.  esc_html(get_post_meta($post->ID, 'seeker_website', true)).'">
		</p>
	';	
?>
