<?php

/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package minimalist-blogger-x
 */

use SuperbThemesCustomizer\CustomizerControls;

$minimalist_blogger_x_theme_is_related_posts = isset($args['is_related_posts']) && !!$args['is_related_posts'];
$minimalist_blogger_x_theme_featured_image_style = CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE);
$minimalist_blogger_x_theme_thumbnail_url = \get_the_post_thumbnail_url(get_the_id(), 'minimalist-blogger-x-noresize');
$minimalist_blogger_x_theme_hide_author_name = CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_HIDE_BYLINE_AUTHOR) == "1" || !!$minimalist_blogger_x_theme_is_related_posts;
$minimalist_blogger_x_theme_hide_author_image = CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_HIDE_BYLINE_IMAGE) == "1" || !!$minimalist_blogger_x_theme_is_related_posts;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('posts-entry fbox'); ?>>

	<?php if (has_post_thumbnail()) : ?>
		<div class="featured-thumbnail">
			<div class="featured-thumbnail-cropped" <?php if ($minimalist_blogger_x_theme_featured_image_style === CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE) {
				echo 'style="background-image: url(' . esc_url($minimalist_blogger_x_theme_thumbnail_url) . ')"';
			} ?>>
			<?php
			if ($minimalist_blogger_x_theme_featured_image_style === CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) {
				?>
				<span class="featured-img-bg-blur" <?php echo 'style="background-image: url(' . esc_url($minimalist_blogger_x_theme_thumbnail_url) . ')"'; ?>></span>
				<?php
			}
			if ($minimalist_blogger_x_theme_featured_image_style !== CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE) {
				the_post_thumbnail('minimalist-blogger-x-noresize');
			}
			?>
		</div>
	</div>
<?php endif; ?>

<header class="entry-header">
	<?php
	if (is_singular()) :
		the_title('<h1 class="entry-title">', '</h1>');
	else :
		the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
	endif;
	?>
	<?php
	if ('post' === get_post_type()) : ?>
		<div class="entry-meta">
			<div class="blog-data-wrapper">
				<div class='post-meta-inner-wrapper'>
					<?php echo __(' Posted on', 'minimalist-blogger-x') ?>
					<?php minimalist_blogger_x_theme_posted_on(); ?>
					<?php if (!$minimalist_blogger_x_theme_hide_author_name) : ?>
						<span class="post-author-data">
							<?php esc_html_e('By ', 'minimalist-blogger-x'); ?><?php the_author(); ?>
						<?php endif; ?>
						<?php if (!$minimalist_blogger_x_theme_hide_author_name) : ?>
						</span>
					<?php endif; ?>
					<?php if (!$minimalist_blogger_x_theme_hide_author_image) : ?>
						<span class="post-author-img">
							<?php echo get_avatar(get_the_author_meta('ID'), 24); ?>
						</span>
					<?php endif; ?>
				</div>
			</div>
		</div><!-- .entry-meta -->
	<?php endif; ?>
</header><!-- .entry-header -->

<div class="entry-content">
	<?php
	the_content();

	wp_link_pages(array(
		'before' => '<div class="page-links">' . esc_html__('Pages:', 'minimalist-blogger-x'),
		'after'  => '</div>',
	));

	if (is_single()) : ?>
		<?php if (get_theme_mod('show_posts_categories_tags') == '') : ?>
			<div class="category-and-tags">
				<?php the_category(' '); ?>
				<?php if (has_tag()) : ?>
					<?php the_tags('', ''); ?>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	<?php endif; ?>


</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->