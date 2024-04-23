<?php

use SuperbThemesCustomizer\CustomizerControls;
use SuperbThemesCustomizer\CustomizerController;

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimalist-blogger-x
 */

get_header(); ?>


<div id="content" class="page-content"> <?php $minimalist_blogger_x_theme_container_class = !is_page_template('elementor_header_footer') ? 'content-wrap' : 'content-none'; ?>
    <div class="<?php echo esc_html($minimalist_blogger_x_theme_container_class); ?>">
        <div id="primary" class="left-content <?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_HIDE_SIDEBAR) == '1' || !is_active_sidebar('sidebar-1')) : ?>fullwidth-area-blog<?php endif; ?> add-blog-to-sidebar">
            <main id="main" class="main">
                <?php CustomizerController::MaybeGetMasonryColumnOutput(); ?>
                <?php echo do_shortcode('[custom_video]');?>

            </main><!-- #main -->
        </div><!-- #primary -->

        <?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_HIDE_SIDEBAR) == '1') : ?>
        <?php else : ?>
            <aside id="secondary" class="right-content">
            <?php
                // Custom query to fetch 6 recent articles
                $args = array(
                    'post_type'      => 'article', // Replace 'article' with your custom post type slug
                    'posts_per_page' => 6,          // Number of articles to display
                    'orderby'        => 'date',     // Order by date
                    'order'          => 'DESC',      // Show newest articles first
                    'tax_query'      => array(
                        array(
                            'taxonomy' => 'article_category',  // Replace 'article_category' with your custom taxonomy slug
                            'field'    => 'slug',
                            'terms'    => 'news',              // Slug of the 'news' category
                        ),
                    ),
                );

                $recent_articles = new WP_Query( $args );

                // Check if there are any recent articles
                if ( $recent_articles->have_posts() ) :
                    ?>
                    <section class="recent-articles">
                        <div class="subtitle-container">
                            <p class="subtitle">Marknadsnyheter</p>
                        </div>
                            <?php
                            // Start the loop
                            while ( $recent_articles->have_posts() ) : $recent_articles->the_post();
                                ?>
                                    <div class="article">
                                        <div class="article-thumbnail article__column__left">
                                            <?php
                                            if ( has_post_thumbnail() ) {
                                                the_post_thumbnail( 'thumbnail' ); // Display the featured image
                                            } else {
                                                // Display a default image or leave empty
                                            }
                                            ?>
                                        </div>
                                        <div class=" article__column__right">
                                            <h3 class="article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <div class="article-content">
                                                <?php the_excerpt(); // Display the excerpt of the article ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                            endwhile;
                            ?>
                    </section>
                    <?php
                    // Restore original post data
                    wp_reset_postdata();
                endif;
                ?>
        <?php endif; ?>
    </aside>


    </div>
</div>

<?php get_footer(); ?>