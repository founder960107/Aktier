<?php

/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package minimalist-blogger-x
 */

/**
|------------------------------------------------------------------------------
| Related Posts
|------------------------------------------------------------------------------
|
| You can show related posts by Categories or Tags.
| It has two options to show related posts
|
| 1. Thumbnail related posts (default)
| 2. List of related posts
|
| @return void
|
 */

if (!function_exists('minimalist_blogger_x_theme_related_posts')) :

    function minimalist_blogger_x_theme_related_posts()
    {
        global $post;

        $taxonomy = 'cat';
        $numberRelated = 9;

        $args =  array();

        if ($taxonomy == 'tag') {
            $tags = wp_get_post_tags($post->ID);
            $arr_tags = array();

            foreach ($tags as $tag) {
                array_push($arr_tags, $tag->term_id);
            }

            if (!empty($arr_tags)) {
                $args = array(
                    'tag__in'            => $arr_tags,
                    'post__not_in'        => array($post->ID),
                    'posts_per_page'    => $numberRelated,
                );
            }
        } else {
            $args = array(
                'category__in'        => wp_get_post_categories($post->ID),
                'posts_per_page'    => $numberRelated,
                'post__not_in'        => array($post->ID)
            );
        }

        if (!empty($args)) {
            $posts = get_posts($args);

            if ($posts) {
?>

                <div class="fbox posts-related clearfix">
                    <div class="swidget">
                        <h3 class="related-title"><?php esc_html_e('Related Post', 'minimalist-blogger-x') ?></h3>
                    </div>
                    <?php
                    $related_style = 'grid';
                    if ($related_style == 'grid') :
                    ?>
                        <ul class="grid-related-posts">
                            <?php
                            foreach ($posts as $p) {
                            ?>
                                <li>
                                    <div class="thumbnail">
                                        <?php if (has_post_thumbnail($p->ID)) : ?>
                                            <a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>">
                                                <?php echo get_the_post_thumbnail($p->ID, 'minimalist-blogger-x-small'); ?>
                                            </a>
                                        <?php else : ?>
                                            <a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>">
                                                <img class="wp-post-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/nothumb-related-posts.jpg" />
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                    <a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>"><?php echo esc_html(get_the_title($p->ID)) ?></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    <?php
                    elseif ($related_style == 'list') :
                    ?>
                        <ul class="list-related-posts">
                            <?php
                            foreach ($posts as $p) {
                            ?>
                                <li>
                                    <?php if (has_post_thumbnail($p->ID)) : ?>
                                        <div class="featured-thumbnail">
                                            <a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>">
                                                <?php echo get_the_post_thumbnail($p->ID, 'minimalist-blogger-x-small') ?>
                                            </a>
                                        </div>
                                    <?php else : ?>
                                        <div class="featured-thumbnail">
                                            <a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>">
                                                <img class="wp-post-image" src="<?php echo esc_url(get_template_directory_uri()); ?>/images/nothumb-related-posts.jpg" />
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="related-data">
                                        <a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>"><?php echo esc_html(get_the_title($p->ID)) ?></a>
                                        <?php the_excerpt(); ?>
                                    </div>
                                </li>
                            <?php
                            }
                            ?>

                        </ul>

                    <?php
                    else :
                    ?>

                        <ul class="nothumb-related-posts">
                            <?php
                            foreach ($posts as $p) {
                            ?>
                                <li>

                                    <a href="<?php echo esc_url(get_the_permalink($p->ID)) ?>"><?php echo esc_html(get_the_title($p->ID)); ?></a>

                                </li>
                            <?php
                            }
                            ?>
                        </ul>

                    <?php endif; ?>

                </div>

<?php
            }
        }
    }
endif;


if (!function_exists('minimalist_blogger_x_theme_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function minimalist_blogger_x_theme_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date('c')),
            esc_html(get_the_modified_date())
        );

        $posted_on = '<a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . $time_string . '</a>';

        $byline = '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>';

        echo '<span class="posted-on">' . $posted_on . '</span>'; // WPCS: XSS OK.
    }
endif;

if (!function_exists('minimalist_blogger_x_theme_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function minimalist_blogger_x_theme_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'minimalist-blogger-x'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf('<span class="cat-links">' . esc_html__('Posted in %1$s', 'minimalist-blogger-x') . '</span>', $categories_list); // WPCS: XSS OK.
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(', ', 'list item separator', 'minimalist-blogger-x'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('Tagged %1$s', 'minimalist-blogger-x') . '</span>', $tags_list); // WPCS: XSS OK.
            }
        }

        if (!is_single() && !post_password_required() && (comments_open() || get_comments_number())) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'minimalist-blogger-x'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    esc_html(get_the_title())
                )
            );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
                wp_kses(
                    /* translators: %s: Name of current post. Only visible to screen readers */
                    __('Edit <span class="screen-reader-text">%s</span>', 'minimalist-blogger-x'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                esc_html(get_the_title())
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;
