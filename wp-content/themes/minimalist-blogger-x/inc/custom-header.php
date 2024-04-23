<?php

/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package minimalist-blogger-x
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses minimalist_blogger_x_theme_header_style()
 */
function minimalist_blogger_x_theme_custom_header_setup()
{
	add_theme_support('custom-header', apply_filters('minimalist_blogger_x_theme_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'height'             	 => 400,
		'width'             	 => 1800,
		'flex-height'            => true,
		'flex-width'            => true,
		'default-image'			=> '',
		'wp-head-callback'       => 'minimalist_blogger_x_theme_header_style',
	) ) );
	register_default_headers( array(
		'header-bg' => array(
			'url'           => '%s/img/header-image.png',
			'thumbnail_url' => '%s/img/header-image.png',
			'description'   => _x( 'Default', 'Default header image', 'minimalist-blogger-x' )
		),	
	) );
}
add_action('after_setup_theme', 'minimalist_blogger_x_theme_custom_header_setup');

if (!function_exists('minimalist_blogger_x_theme_header_style')) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see minimalist_blogger_x_theme_custom_header_setup().
	 */
	function minimalist_blogger_x_theme_header_style()
	{
		$header_text_color = get_header_textcolor();
		$header_image = get_header_image();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if (empty($header_image) && $header_text_color == get_theme_support('custom-header', 'default-text-color')) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
?>
		<style type="text/css">
			.site-title a,
			.site-description,
			.logofont,
			.site-title,
			.logodescription {
				color: #<?php echo esc_attr($header_text_color); ?>;
			}

			<?php if (!display_header_text()) : ?>.logofont,
			.logodescription {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				display: none;
			}

			<?php
			endif;

			if (!display_header_text()) : ?>.logofont,
			.site-title,
			p.logodescription {
				position: absolute;
				clip: rect(1px, 1px, 1px, 1px);
				display: none;
			}

			<?php
			else :
			?>.site-title a,
			.site-title,
			.site-description,
			.logodescription {
				color: #<?php echo esc_attr($header_text_color); ?>;
			}

			<?php endif; ?>
		</style>
<?php
	}
endif;
