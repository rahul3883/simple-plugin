<?php

class St_Pages_Widget extends WP_Widget {

	function __construct() {

		$args = array(
			'description'	=> esc_html__( 'Your site\'s particular page', 'blank-theme' ),
		);

		parent::__construct(
			'st_pages_widget',
			__( 'Page', 'blank-theme' ),
			$args
		);

	}

	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] :  '', $instance, $this->id_base );
		$page_id = ! empty( $instance['page_id'] ) ? $instance['page_id'] : '';

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$page_args = array(
			'p'	=> $page_id,
			'post_type'	=> 'page',
		);

		global $post;

		$page = new WP_Query( $page_args );
		$page->the_post();

		?>

		<?php echo get_the_post_thumbnail( $instance['page_id'], array( 99, 99 ), array( 'class' => 'st-widget-post-image' ) ); ?>
		<p class="st-widget-post-title">
			<?php the_title(); ?>
		</p>
		<p class="st-widget-post-content">
			<?php echo wp_kses_post( wp_trim_words( get_the_content(), 15 ) ); ?>
		</p>
		<a class="st-widget-post-readmore" href="<?php the_permalink(); ?>"><?php _e( 'Read More', 'blank-theme' ) ?></a>

		<?php

		echo $args['after_widget'];

	}

	public function form( $instance ) {

			$title		= ! empty( $instance['title'] ) ? $instance['title'] : '';
			$page_id	= ! empty( $instance['page_id'] ) ? $instance['page_id'] : '';
			?>

			<?php

				$args = array(
					'include' => array( 40, 42, 44, 47 ),
					'post_type' => 'page',
					'post_status' => 'publish',
				);

				$pages = get_pages( $args );

			?>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'blank-theme' ); ?>:</label>
				<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo $title; ?>">
			</p>

			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>"><?php _e( 'Page', 'blank-theme' ); ?>:</label>
				<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'page_id' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'page_id' ) ); ?>">

					<?php	foreach ( $pages as $page ) { ?>
			 				<option <?php selected( $page_id, $page->ID ); ?> value="<?php echo $page->ID; ?>"><?php echo $page->post_title; ?></option>
					<?php	} ?>

				</select>
			</p>

				<?php

	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] 		= ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['page_id']	= ( ! empty( $new_instance['page_id'] ) ) ? strip_tags( $new_instance['page_id'] ) : '';
		return $instance;
	}
}

add_action( 'widgets_init', function() {
		register_widget( 'St_Pages_Widget' );
} );
