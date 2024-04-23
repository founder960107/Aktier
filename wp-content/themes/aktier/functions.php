<?php
$base_url = 'http://localhost/wordpress/wp-content/uploads';
function add_google_fonts() { 
	wp_enqueue_style( 'google-fonts-oswald', 'http://fonts.googleapis.com/css?family=Lora|Oswald', false );
	wp_enqueue_style( 'google-fonts-satoshi', 'https://fonts.cdnfonts.com/css/satoshi', false );
  } 
add_action( 'wp_enqueue_scripts', 'add_google_fonts' );

function enqueue_custom_admin_styles() {
    // Enqueue your custom CSS stylesheet for the admin area
    wp_enqueue_style( 'custom-admin-style', get_stylesheet_directory_uri() . '/css/admin.css' );
}
// echo get_stylesheet_directory_uri();
add_action( 'admin_enqueue_scripts', 'enqueue_custom_admin_styles' );

// Add file upload field to custom settings page or Customizer
function custom_settings_page() {
    ?>
    <form method="post" enctype="multipart/form-data">
        <textarea name="news_content"></textarea>
        <input name="news_title"/>
        <input type="file" class="upload" name="custom_video">
        <input type="file" name="poster_image">
        <input type="submit" name="submit" value="Save">
    </form>
    <?php
}

// Save uploaded video file path
function save_custom_video() {
    if( isset($_POST['news_content']) ) {
        $news_content = $_POST['news_content'];
    }
    if( isset($_POST['news_content']) ) {
        $news_title = $_POST['news_title'];
    }
    if ( isset( $_FILES['custom_video'] ) ) {
        $video_file = $_FILES['custom_video'];
    if ( isset( $_FILES['poster_image'] ) ) {
        $poster_file = $_FILES['poster_image'];
    $upload_dir = wp_upload_dir(); // Get upload directory

    // Move uploaded file to the upload directory
    $moved = move_uploaded_file( $video_file['tmp_name'], $upload_dir['path'] . '/' . $video_file['name'] );

    // Check if file move was successful
    // if ( $moved ) {
        $video_url = 'http://localhost/wordpress/wp-content/uploads/videos/' . $video_file['name'];

        $poster_url = 'http://localhost/wordpress/wp-content/uploads/videos/' . $poster_file['name'];

        update_option( 'custom_video_url', $video_url );
        update_option( 'poster_url', $poster_url);
        update_option( 'news_content', $news_content);
        update_option( 'news_title', $news_title);
    // }
    }
}
}

// Retrieve saved video file path
function get_custom_video_path() {
    return get_option( 'custom_video_url' );
}
function get_poster_path() {
    return get_option( 'poster_url' );
}
function get_news_title() {
    return get_option( 'news_title' );
}
function get_news_content() {
    return get_option( 'news_content' );
}

function display_custom_video() {
    $video_path = get_custom_video_path();
    $poster_path = get_poster_path();
    $news_content = get_news_content();
    $news_title = get_news_title();
    if ( $video_path && $poster_path ) {
        echo '<div class="subtitle-container"><p class="subtitle" style="margin-bottom:14px;">Marknadsnyheter</p></div>';
        echo '<p class="news-title">'.$news_title.'</p>';
        echo '<p class="news-content">'.$news_content.'</p>';
        echo '<figure class="wp-block-video" style="margin:0;">';
        echo '<video controls poster="' . esc_url($poster_path) . '" src="' . esc_url( $video_path ) . '" type="video/mp4">';
        echo 'Your browser does not support the video tag.';
        echo '</video>';
    }
}

// Hook functions
add_action( 'admin_menu', function() {
    add_menu_page( 'Custom Settings', 'Custom Settings', 'manage_options', 'custom-settings', 'custom_settings_page' );
} );
add_action( 'admin_init', 'save_custom_video' );

function custom_video_shortcode() {
    ob_start();
    display_custom_video();
    return ob_get_clean();
}

add_shortcode( 'custom_video', 'custom_video_shortcode' );
