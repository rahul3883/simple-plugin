<?php

class Team_Meta_Box {

	function __construct() {

		add_action( 'add_meta_boxes_sp_team', array( $this, 'register_meta_boxes' ) );
		add_action( 'save_post_sp_team', array( $this, 'save_meta_box' ) );

	}

	function register_meta_boxes( $post ) {
		add_meta_box(
			'team-meta-box',
			__( 'Designation', 'blank-theme' ),
			array( $this, 'render_meta_box' ),
			'sp_team',
			'normal',
			'default'
		);
	}

	function render_meta_box( $post ) {

		wp_nonce_field( 'team_meta_box', 'team_meta_box_nonce' );

		$designation = get_metadata( 'slider', $post->ID, '_team_member_designation', true );

		?>

		<input type="text" name="member-designation" value="<?php echo $designation; ?>">

		<?php
	}

	function save_meta_box( $post_id ) {

		if ( ! isset( $_POST['team_meta_box_nonce'] ) ) {
			return $post_id;
		}

		$nonce = $_POST['team_meta_box_nonce'];

		if ( ! wp_verify_nonce( $nonce, 'team_meta_box' ) ) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTO_SAVE' ) && DOING_AUTO_SAVE ) {
			return $post_id;
		}

		if ( 'sp_team' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		$designation = sanitize_text_field( $_POST['member-designation'] );

		update_metadata( 'slider', $post_id, '_team_member_designation', $designation );

	}
}

new Team_Meta_Box();
