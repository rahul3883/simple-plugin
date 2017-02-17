<?php
/**
 * The template part for displaying Testimonials.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Blank Theme
 */

$prefix = 'fb_';

$args = array(
	'post_type'			=> 'sp_testimonials',
	'posts_per_page'	=> -1,
);

$testimonials = new WP_Query( $args );

if ( $testimonials->have_posts() ) {
	?>

	<div id="sp-testimonials-container" class="sp-section-container sp-slider-container">
		<div class="sp-content-wrapper">

			<section class="sp-testimonials">

				<header	class="sp-page-header">
					<h2 class="sp-page-title"><?php _e( 'What Clients Say', 'simple-plugin' ); ?></h2>
				</header>

				<div class="st-page-content row">

					<div class="large-2 medium-2 small-2 column">
						<img src="<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_ARROW; ?>" id="sp-slider-tm-arrow-left" class="sp-slider-arrow sp-arrow-left" alt="Left" onmouseover="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_HOVER_ARROW; ?>'" onmouseout="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_ARROW; ?>'">
					</div>

					<div id="sp-slider-testimonial" class="sp-slider sp-slider-testimonials large-8 medium-8 small-8 column">

						<?php

						while ( $testimonials->have_posts() ) {
							$testimonials->the_post();
							?>

								<div class="sp-slider-tm-content">

										<p class="sp-testimonial-text">
											<?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 40 ) ); ?>
										</p>
										<p class="sp-testimonial-name">
											<?php echo get_post_meta( get_the_ID(), '_testimonial_name_key', true ); ?>
										</p>

								</div>

								<?php
						}
						?>

					</div>

					<div class="large-2 medium-2 small-2 column">
						<img src="<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW; ?>" id="sp-slider-tm-arrow-right" class="sp-slider-arrow sp-arrow-right" alt="Right" onmouseover="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_HOVER_ARROW; ?>'" onmouseout="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW; ?>'">
					</div>

				</div>

			</section>

		</div>
	</div>

<?php }
