<?php

class Test_Meta_Box {

	function __construct() {

		add_action( 'add_meta_boxes_page', array( $this, 'register_meta_boxes' ) );
		add_action( 'save_post_page', array( $this, 'save_meta_box' ) );

	}

	function register_meta_boxes( $post ) {
		if ( 'page-templates/home-template.php' == get_page_template_slug( $post->ID ) ) {
			add_meta_box(
				'test-meta-box',
				__( 'Test Text', 'blank-theme' ),
				array( $this, 'render_meta_box' ),
				'page',
				'normal',
				'default'
			);
		}
	}

	function render_meta_box( $post ) {

		wp_nonce_field( 'test_meta_box', 'test_meta_box_nonce' );

		$test_text = get_post_meta( $post->ID, '_test_text', true );

		?>

		<input type="text" name="test-text" value="<?php echo $test_text; ?>">

		<?php
	}

	function save_meta_box( $post_id ) {

		if ( ! isset( $_POST['test_meta_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['test_meta_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'test_meta_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTO_SAVE' ) && DOING_AUTO_SAVE ) {
			return $post_id;
		}

		if ( 'page' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		$test_text = sanitize_text_field( $_POST['test-text'] );

		update_post_meta( $post_id, '_test_text', $test_text );

	}
}

new Test_Meta_Box();
