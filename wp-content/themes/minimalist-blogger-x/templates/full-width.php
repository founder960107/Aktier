<?php
/* Template Name: Full Width */

/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimalist-blogger-x
 */

get_header(); ?>
<div id="content" class="site-content clearfix"> <?php $minimalist_blogger_x_theme_container_class = !is_page_template('elementor_header_footer') ? 'content-wrap' : 'content-none'; ?>
    <div class="<?php echo esc_html($minimalist_blogger_x_theme_container_class); ?>">

        <div id="primary" class="full-width-template featured-content content-area">
            <main id="main" class="site-main">

                <?php
                while (have_posts()) : the_post();

                    get_template_part('template-parts/content', 'single');

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) :
                        comments_template();
                    endif;

                endwhile; // End of the loop.
                ?>

            </main><!-- #main -->
        </div><!-- #primary -->

    </div>
</div><!-- #content -->

<?php get_footer();
