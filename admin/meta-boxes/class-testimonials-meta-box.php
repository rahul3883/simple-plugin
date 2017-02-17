<?php

class Testimonials_Meta_Box {

	function __construct() {
		add_action( 'add_meta_boxes_sp_testimonials', array( $this, 'register_meta_boxes' ) );
		add_action( 'save_post_sp_testimonials', array( $this, 'save_meta_box' ) );
	}

	function register_meta_boxes( $post ) {
		add_meta_box(
			'testimonials-meta-box',
			__( 'Person Information', 'blank-theme' ),
			array( $this, 'render_meta_box' ),
			'sp_testimonials',
			'normal',
			'default'
		);
	}

	function render_meta_box( $post ) {

		wp_nonce_field( 'testimonial_meta_box', 'testimonial_meta_box_nonce' );

		$name = get_metadata( 'slider', $post->ID, '_testimonial_name_key', true );
		$designation = get_metadata( 'slider', $post->ID, '_testimonial_designation_key', true );

		?>

		<p class="post-attributes-label-wrapper">
			<label class="post-attributes-label" for="testimonial-name"><?php _e( 'Name', 'blank-theme' ); ?></label>
		</p>
		<input id="testimonial-name" type="text" name="testimonial-name" value="<?php echo $name; ?>">

		<p class="post-attributes-label-wrapper">
			<label class="post-attributes-label" for="testimonial-designation"><?php _e( 'Designation', 'blank-theme' ); ?></label>
		</p>
		<input id="testimonial-designation" type="text" name="testimonial-designation" value="<?php echo $designation; ?>">

		<?php
	}

	function save_meta_box( $post_id ) {

		if ( ! isset( $_POST['testimonial_meta_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['testimonial_meta_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'testimonial_meta_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTO_SAVE' ) && DOING_AUTO_SAVE ) {
			return $post_id;
		}

		if ( 'sp_testimonials' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		$name = sanitize_text_field( $_POST['testimonial-name'] );
		$designation = sanitize_text_field( $_POST['testimonial-designation'] );

		update_metadata( 'slider', $post_id, '_testimonial_name_key', $name );
		update_metadata( 'slider', $post_id, '_testimonial_designation_key', $designation );

	}
}

new Testimonials_Meta_Box();
