<?php

$args = array(
	'public'	=> true,
	'_builtin'	=> false,
);

$output = 'object';
$oparator = 'and';

$post_types = get_post_types( $args, $output, $oparator );

$accepted_post_types = array(
	'sp_slider',
	'sp_testimonials',
);

$prefix = 'fb_';
?>

<div id="sp-slider-all-container" class="sp-section-container sp-slider-container">

	<div id="sp-slider-all" class="sp-slider-all sp-slider">

		<?php

		foreach ( $post_types as $post_type ) {

			if ( in_array( $post_type->name, $accepted_post_types ) ) {
				?>

				<span id="<?php echo $prefix . $post_type->name ; ?>" class="fancybox">

					<div class="sp-slides">

						<h3 class="sp-slider-all-title">

							<?php echo $post_type->label; ?>

						</h3>

						<span class="sp-helper-span"></span>

					</div>

				</span>

				<?php
			}
		}

		?>

	</div>

	<div id="sp-slider-all-navigator" class="sp-slider-navigator">
		<img src="<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_ARROW; ?>" id="sp-slider-all-arrow-left" class="sp-slider-arrow sp-arrow-left" alt="Left" onmouseover="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_HOVER_ARROW; ?>'" onmouseout="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_ARROW; ?>'">
		<img src="<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW; ?>" id="sp-slider-all-arrow-right" class="sp-slider-arrow sp-arrow-right" alt="Right" onmouseover="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_HOVER_ARROW; ?>'" onmouseout="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW; ?>'">
	</div>

</div>
