<?php

$prefix = 'fb_';

$custom_query = new WP_Query( array( 'post_type' => 'sp_slider' ) );

if ( $custom_query->have_posts() ) {
	?>

	<div id="sp-slider-container" class="sp-section-container sp-slider-container">

		<div id="sp-slider" class="sp-slider-main sp-slider">

			<?php

			while ( $custom_query->have_posts() ) {
				$custom_query->the_post();
				?>

					<div class="sp-slides">

						<?php the_post_thumbnail( 'st-slider' ); ?>
						<div class="sp-slider-content-wrapper">
							<div class="sp-content-wrapper sp-slider-content-wrapper-inner">

								<h3 class="sp-slider-title">

									<?php the_title(); ?>

								</h3>
								<p class="sp-slider-content">

									<?php echo wp_kses_post( wp_trim_words( get_the_content(), 15 ) ); ?>

								</p>
								<a class="sp-slider-button" href="<?php the_permalink(); ?>">

									<?php echo esc_html__( 'Learn More', 'simple-plugin' ); ?>

								</a>

							</div>

							<span class="sp-helper-span"></span>

						</div>

					</div>

					<?php
			}
			?>

		</div>

		<div id="sp-slider-navigator" class="sp-slider-navigator">
			<img src="<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_ARROW; ?>" id="sp-slider-arrow-left" class="sp-slider-arrow sp-arrow-left" alt="Left" onmouseover="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_HOVER_ARROW; ?>'" onmouseout="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_LEFT_ARROW; ?>'">
			<img src="<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW; ?>" id="sp-slider-arrow-right" class="sp-slider-arrow sp-arrow-right" alt="Right" onmouseover="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_HOVER_ARROW; ?>'" onmouseout="this.src='<?php echo SIMPLE_PLUGIN_SLIDER_RIGHT_ARROW; ?>'">
		</div>

	</div>

<?php }
