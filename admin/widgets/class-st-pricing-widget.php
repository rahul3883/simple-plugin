<?php

class St_Pricing_Widget extends WP_Widget {

	function __construct() {

		$args = array(
			'description'	=> esc_html__( 'SimpleTheme Pricing Widget', 'blank-theme' ),
		);

		parent::__construct(
			'st_pricing_widget',
			__( 'Pricing', 'blank-theme' ),
			$args
		);

	}

	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', ! empty( $instance['title'] ) ? $instance['title'] :  '', $instance, $this->id_base );

		echo $args['before_widget'];
		if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$plan_color_class	= ! empty( $instance['plan_color_class'] ) ? $instance['plan_color_class'] : '';
		$plan_name 				= ! empty( $instance['plan_name'] ) ? $instance['plan_name'] : '';
		$plan_price 			= ! empty( $instance['plan_price'] ) ? $instance['plan_price'] : '';
		$plan_features 		= ! empty( $instance['plan_features'] ) ? $instance['plan_features'] : '';
		$plan_button_text	= ! empty( $instance['plan_button_text'] ) ? $instance['plan_button_text'] : '';
		$plan_link				= ! empty( $instance['plan_link'] ) ? $instance['plan_link'] : '';

		$plan_features = explode( "\n", $plan_features );

		?>

		<div class="plan-name-wrapper <?php echo $plan_color_class; ?>">
			<h3 class="plan-name nomargin"><?php echo $plan_name; ?></h3>
		</div>
		<div class="plan-price-wrapper">
			<h4 class="plan-price nomargin"><?php echo $plan_price; ?></h4>
		</div>
		<ul class="plan-features nopadding nomargin">

			<?php
			foreach ( $plan_features as $feature ) {
			?>
				<li><?php echo $feature; ?></li>
			<?php
			}
			?>

		</ul>
		<div class="plan-button-wrapper">
			<a class="plan-button <?php echo $plan_color_class; ?>" href="<?php echo $plan_link; ?>"><?php echo $plan_button_text; ?></a>
		</div>

		<?php

		echo $args['after_widget'];

	}

	public function form( $instance ) {

		$color_class_name	= array( 'light_black_color', 'light_blue_color' );
		$title						= ! empty( $instance['title'] ) ? $instance['title'] : '';
		$plan_color_class	= ! empty( $instance['plan_color_class'] ) ? $instance['plan_color_class'] : '';
		$plan_name 				= ! empty( $instance['plan_name'] ) ? $instance['plan_name'] : '';
		$plan_price 			= ! empty( $instance['plan_price'] ) ? $instance['plan_price'] : '';
		$plan_features 		= ! empty( $instance['plan_features'] ) ? $instance['plan_features'] : '';
		$plan_button_text	= ! empty( $instance['plan_button_text'] ) ? $instance['plan_button_text'] : '';
		$plan_link				= ! empty( $instance['plan_link'] ) ? $instance['plan_link'] : '';
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo $title; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'plan_color_class' ) ); ?>"><?php _e( 'Color Class', 'blank-theme' ); ?>:</label>
			<select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'plan_color_class' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'plan_color_class' ) ); ?>">

				<?php foreach ( $color_class_name as $class ) { ?>
					<option <?php selected( $plan_color_class, $class ) ?> value="<?php echo $class; ?>"><?php echo $class; ?></option>
				<?php } ?>

			</select>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'plan_name' ) ); ?>"><?php _e( 'Plan Name', 'blank-theme' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'plan_name' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'plan_name' ) ); ?>" value="<?php echo $plan_name; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'plan_price' ) ); ?>"><?php _e( 'Price', 'blank-theme' ); ?>:</label>
			<input class="widefat" type="text" id="<?php echo esc_attr( $this->get_field_id( 'plan_price' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'plan_price' ) ); ?>" value="<?php echo $plan_price; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'plan_features' ) ); ?>"><?php _e( 'Features', 'blank-theme' ); ?>:</label>
			<textarea rows="8" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'plan_features' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'plan_features' ) ); ?>"><?php echo $plan_features; ?></textarea>
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'plan_button_text' ) ); ?>"><?php _e( 'Button Text', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'plan_button_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'plan_button_text' ) ); ?>" value="<?php echo $plan_button_text; ?>">
		</p>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'plan_link' ) ); ?>"><?php _e( 'Button Link', 'blank-theme' ); ?>:</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'plan_link' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'plan_link' ) ); ?>" value="<?php echo $plan_link; ?>">
		</p>

		<?php

	}

	public function update( $new_instance, $old_instance ) {
		$instance = array(
			'title'							=> ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '',
			'plan_color_class'	=> ( ! empty( $new_instance['plan_color_class'] ) ) ? strip_tags( $new_instance['plan_color_class'] ) : '',
			'plan_name'					=> ( ! empty( $new_instance['plan_name'] ) ) ? strip_tags( $new_instance['plan_name'] ) : '',
			'plan_price'				=> ( ! empty( $new_instance['plan_price'] ) ) ? strip_tags( $new_instance['plan_price'] ) : '',
			'plan_features'			=> ( ! empty( $new_instance['plan_features'] ) ) ? strip_tags( $new_instance['plan_features'] ) : '',
			'plan_button_text'	=> ( ! empty( $new_instance['plan_button_text'] ) ) ? strip_tags( $new_instance['plan_button_text'] ) : '',
			'plan_link'					=> ( ! empty( $new_instance['plan_link'] ) ) ? strip_tags( $new_instance['plan_link'] ) : '',
		) ;
		return $instance;
	}
}

add_action( 'widgets_init', function() {
	register_widget( 'St_Pricing_Widget' );
} );
