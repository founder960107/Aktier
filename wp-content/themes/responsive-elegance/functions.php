<?php
require_once get_template_directory() . '/vendor/autoload.php';
// Get customizer options
use SuperbThemesCustomizer\CustomizerControls;

// New color variables
if (method_exists(CustomizerControls::class, "OverwriteDefault")) {
    CustomizerControls::OverwriteDefault(CustomizerControls::NAVIGATION_LAYOUT_STYLE, "navigation_layout_style_choice_small");
    CustomizerControls::OverwriteDefault(CustomizerControls::BLOGFEED_SHOW_READMORE_BUTTON, "1");
    CustomizerControls::OverwriteDefault(CustomizerControls::SITE_IDENTITY_HIDE_TAGLINE, "1");
    CustomizerControls::OverwriteDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE, "blogfeed_twocolumn_masonry");
    CustomizerControls::OverwriteDefault(CustomizerControls::BLOGFEED_HIDE_CATEGORY_FEATURED_IMAGE, "0");
    CustomizerControls::OverwriteDefault(CustomizerControls::UPPERWIDGETS_FRONTPAGE_ONLY, "0");
    CustomizerControls::OverwriteDefault(CustomizerControls::SINGLE_HIDE_RELATED_POSTS, "0");
    CustomizerControls::OverwriteDefault(CustomizerControls::BLOGFEED_HIDE_SIDEBAR, "blogfeed_show_sidebar");
    CustomizerControls::OverwriteDefault('--minimalist-blogger-x-dark-1', "#333");
    CustomizerControls::OverwriteDefault('--minimalist-blogger-x-element-border-radius', "3px");


}


// Get stylesheet
add_action('wp_enqueue_scripts', 'responsive_elegance_enqueue_styles');
function responsive_elegance_enqueue_styles()
{
    wp_enqueue_style('responsive-elegance-parent-style', get_template_directory_uri() . '/style.css');
}



// New fonts
function responsive_elegance_enqueue_assets()
{
    // Include the file.
    require_once get_theme_file_path('webfont-loader/wptt-webfont-loader.php');
    // Load the webfont.
    wp_enqueue_style(
        'responsive-elegance-fonts',
        wptt_get_webfont_url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap'),
        array(),
        '1.0'
    );
}
add_action('wp_enqueue_scripts', 'responsive_elegance_enqueue_assets');



function responsive_elegance()
{
    add_theme_support('custom-header', apply_filters('responsive_elegance_theme_custom_header_args', array(
        'default-image'          => '',
        'default-text-color'     => '000000',
        'height'                 => 400,
        'width'                  => 1800,
        'flex-height'            => true,
        'flex-width'            => true,
        'default-image'         => '',
        'wp-head-callback'       => 'responsive_elegance_theme_header_style',
    ) ) );
    register_default_headers( array(
        'header-bg' => array(
            'url'           => get_theme_file_uri( '/img/bg-img-min.png' ),
            'thumbnail_url' => get_theme_file_uri( '/img/bg-img-min.png' ),
            'description'   => _x( 'Default', 'Default header image', 'responsive-elegance' )
        ),  
    ) );
}
add_action('after_setup_theme', 'responsive_elegance', 9999999);

if (!function_exists('responsive_elegance_theme_header_style')) :
    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see responsive_elegance().
     */
    function responsive_elegance_theme_header_style()
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
