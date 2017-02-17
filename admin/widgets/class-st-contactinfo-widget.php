<?php

class St_ContactInfo_Widget extends WP_Widget {

	function __construct() {

		$args = array(
			'description' => esc_html__( 'Contact Details Widget', 'blank-theme' ),
		);

		parent::__construct(
			'st_contactus_widget',
			__( 'Contact Information', 'blank-theme' ),
			$args
		);

	}

	public function widget( $args, $instance ) {

		$title								= apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] :  '', $instance, $this->id_base );
		$contact_head 				= ! empty( $instance['contact_head'] ) ? $instance['contact_head'] : '';
		$contact_text					= ! empty( $instance['contact_text'] ) ? $instance['contact_text'] : '';
		$link_facebook				= ! empty( $instance['link_facebook'] ) ? $instance['link_facebook'] : '';
		$link_twitter					= ! empty( $instance['link_twitter'] ) ? $instance['link_twitter'] : '';
		$link_google_plus			= ! empty( $instance['link_google_plus'] ) ? $instance['link_google_plus'] : '';
		$contact_website_name	= ! empty( $instance['contact_website_name'] ) ? $instance['contact_website_name'] : '';
		$contact_website_link	= ! empty( $instance['contact_website_link'] ) ? $instance['contact_website_link'] : '';
		$contact_number				= ! empty( $instance['contact_number'] ) ? $instance['contact_number'] : '';
		$contact_email				= ! empty( $instance['contact_email'] ) ? $instance['contact_email'] : '';

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		?>

		<h3 id="st-footer-contact-head" class="st-contact-head nomargin-bottom"><?php echo $contact_head; ?></h3>
		<p id="st-footer-contact-text" class="st-contact-text large-10 medium-10 small-10"><?php echo $contact_text; ?></p>

		<div class="st-social-links">
			<a id="st-footer-facebook" href="<?php echo $link_facebook; ?>">
				<img src="<?php echo BLANK_THEME_IMAGE_DIRECTORY . '/Facebook.png'; ?>" alt="Facebook">
			</a>

			<a id="st-footer-twitter" href="<?php echo $link_twitter; ?>">
				<img src="<?php echo BLANK_THEME_IMAGE_DIRECTORY . '/Twitter.png'; ?>" alt="Twitter">
			</a>

			<a id="st-footer-google-plus" href="<?php echo $link_google_plus; ?>">
				<img src="<?php echo BLANK_THEME_IMAGE_DIRECTORY . '/g+.png'; ?>" alt="Google Plus">
			</a>
		</div>

		<a id="st-footer-website-text" class="st-contact-info" href="<?php echo $contact_website_link; ?>"><?php echo $contact_website_name; ?></a>
		<a id="st-footer-contact-number" class="st-contact-info" href="tel:<?php echo $contact_number; ?>"><?php echo $contact_number; ?></a>
		<a id="st-footer-email" class="st-contact-info" href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>

		<?php
		echo $args['after_widget'];

	}

	public function form( $instance ) {

		$title 								= ! empty( $instance['title'] ) ? $instance['title'] : '';
		$contact_head 				= ! empty( $instance['contact_head'] ) ? $instance['contact_head'] : '';
		$contact_text					= ! empty( $instance['contact_text'] ) ? $instance['contact_text'] : '';
		$link_facebook				= ! empty( $instance['link_facebook'] ) ? $instance['link_facebook'] : '';
		$link_twitter					= ! empty( $instance['link_twitter'] ) ? $instance['link_twitter'] : '';
		$link_google_plus			= ! empty( $instance['link_google_plus'] ) ? $instance['link_google_plus'] : '';
		$contact_website_name	= ! empty( $instance['contact_website_name'] ) ? $instance['contact_website_name'] : '';
		$contact_website_link	= ! empty( $instance['contact_website_link'] ) ? $instance['contact_website_link'] : '';
		$contact_number				= ! empty( $instance['contact_number'] ) ? $instance['contact_number'] : '';
		$contact_email				= ! empty( $instance['contact_email'] ) ? $instance['contact_email'] : '';

		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo $title; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_head' ) ); ?>"><?php _e( 'Head', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_head' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_head' ) ); ?>" value="<?php echo $contact_head; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_text' ) ); ?>"><?php _e( 'Text', 'blank-theme' ); ?>:</label>
			<textarea rows="6" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_text' ) ); ?>"><?php echo $contact_text; ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link_facebook' ) ); ?>"><?php _e( 'Facebook Link', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_facebook' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_facebook' ) ); ?>" value="<?php echo $link_facebook; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link_twitter' ) ); ?>"><?php _e( 'Twitter Link', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_twitter' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_twitter' ) ); ?>" value="<?php echo $link_twitter; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'link_google_plus' ) ); ?>"><?php _e( 'Google Plus Link', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'link_google_plus' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'link_google_plus' ) ); ?>" value="<?php echo $link_google_plus; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_website_name' ) ); ?>"><?php _e( 'Website Name', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_website_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_website_name' ) ); ?>" value="<?php echo $contact_website_name; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_website_link' ) ); ?>"><?php _e( 'Website Link', 'blank-theme' ); ?>:</label>
			<input type="url" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_website_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_website_link' ) ); ?>" value="<?php echo $contact_website_link; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_number' ) ); ?>"><?php _e( 'Contact Number', 'blank-theme' ); ?>:</label>
			<input type="tel" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_number' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_number' ) ); ?>" value="<?php echo $contact_number; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>"><?php _e( 'Email', 'blank-theme' ); ?>:</label>
			<input type="email" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'contact_email' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'contact_email' ) ); ?>" value="<?php echo $contact_email; ?>">
		</p>

		<?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'title'									=> ! empty( $new_instance['title'] ) ? $new_instance['title'] : '',
			'contact_head'					=> ! empty( $new_instance['contact_head'] ) ? $new_instance['contact_head'] : '',
			'contact_text'					=> ! empty( $new_instance['contact_text'] ) ? $new_instance['contact_text'] : '',
			'link_facebook'					=> ! empty( $new_instance['link_facebook'] ) ? $new_instance['link_facebook'] : '',
			'link_twitter'					=> ! empty( $new_instance['link_twitter'] ) ? $new_instance['link_twitter'] : '',
			'link_google_plus'			=> ! empty( $new_instance['link_google_plus'] ) ? $new_instance['link_google_plus'] : '',
			'contact_website_name'	=> ! empty( $new_instance['contact_website_name'] ) ? $new_instance['contact_website_name'] : '',
			'contact_website_link'	=> ! empty( $new_instance['contact_website_link'] ) ? $new_instance['contact_website_link'] : '',
			'contact_number'				=> ! empty( $new_instance['contact_number'] ) ? $new_instance['contact_number'] : '',
			'contact_email'					=> ! empty( $new_instance['contact_email'] ) ? $new_instance['contact_email'] : '',
		);
		return $instance;
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'St_ContactInfo_Widget' );
} );
