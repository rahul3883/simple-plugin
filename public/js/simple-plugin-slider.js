( function( $ ) {
    'use strict';

    window.SimplePlugin = {

		post_type_settings: {

			'fb_sp_slider': {
				'href': main_slider.ajax_url,
				'prev_arrow_id': 'sp-slider-arrow-left',
				'next_arrow_id': 'sp-slider-arrow-right'
			},
			'fb_sp_testimonials': {
				'href': testimonials_slider.ajax_url,
				'prev_arrow_id': 'sp-slider-tm-arrow-left',
				'next_arrow_id': 'sp-slider-tm-arrow-right'
			}

		},

        init: function() {

            // Enable to trigger slider
            this.createSlider();

			$( '.fancybox' ).click( function() {

				var id = $( this ).attr( 'id' );
				var post_type_settings = window.SimplePlugin.post_type_settings;

				$.post( post_type_settings[ id ].href, {}, function( response ) {

					response = $( '<div />' ).html( response );

					$.fancybox( response, {
						width: 1000,
						height: 'auto',
						autoSize: false,

						afterShow: function() {

							response.find( '.sp-slider' ).slick( {
								cssEase: 'linear',
								infinite: true,
								slidesToShow: 1,
								slidesToScroll: 1,
								prevArrow: $(this).siblings().find( '.sp-arrow-left' ),
								nextArrow: $(this).siblings().find( '.sp-arrow-right' )
							} );

						}

					} );
				} );

			} );

        },

        createSlider: function() {

			var sliders = $( '.sp-slider-all' );

			$.each( sliders, function() {

				$(this).slick( {
					cssEase: 'linear',
					infinite: true,
					slidesToShow: 2,
					slidesToScroll: 1,
					prevArrow: $(this).siblings().find( '.sp-arrow-left' ),
					nextArrow: $(this).siblings().find( '.sp-arrow-right' )
				} );

			} );

			sliders = $( '.sp-slider-main' );

			$.each( sliders, function() {

				$(this).slick( {
					cssEase: 'linear',
					infinite: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					prevArrow: $(this).siblings().find( '.sp-arrow-left' ),
					nextArrow: $(this).siblings().find( '.sp-arrow-right' )
				} );

			} );

			sliders = $( '.sp-slider-testimonials' );

			$.each( sliders, function() {

				$(this).slick( {
					cssEase: 'linear',
					infinite: true,
					slidesToShow: 1,
					slidesToScroll: 1,
					prevArrow: $(this).siblings().find( '.sp-arrow-left' ),
					nextArrow: $(this).siblings().find( '.sp-arrow-right' )
				} );

			} );

        }
    };

    window.SimplePlugin.init();

} )( jQuery );
