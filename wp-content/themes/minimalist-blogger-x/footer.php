<?php

use SuperbThemesCustomizer\CustomizerControls;

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package minimalist-blogger-x
 */

?>


<footer id="colophon" class="site-footer clearfix">


	<?php if (is_active_sidebar('footerwidget-1')) : ?>
		<div class="content-wrap">
			<div class="site-footer-widget-area">
				<?php dynamic_sidebar('footerwidget-1'); ?>
			</div>
		</div>

	<?php endif; ?>


	<div class="site-info">
		<?php if (get_theme_mod('footer_copyright_text')) : ?>
			<?php echo wp_kses_post(get_theme_mod('footer_copyright_text')) ?>
		<?php else : ?>
			&copy;<?php echo date('Y'); ?> <?php bloginfo('name'); ?>
			<!-- Delete below lines to remove copyright from footer -->
			<span class="footer-info-right">
				<?php echo __(' | WordPress Theme by', 'minimalist-blogger-x') ?> <a href="<?php echo esc_url('https://superbthemes.com/', 'minimalist-blogger-x'); ?>" rel="nofollow noopener"><?php echo __(' SuperbThemes', 'minimalist-blogger-x') ?></a>
			</span>
			<!-- Delete above lines to remove copyright from footer -->

		<?php endif; ?>
	</div><!-- .site-info -->

	<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::FOOTER_GOTOTOP_HIDE) != "1") : ?>
		<a id="goTop" class="to-top" href="#" title="<?php esc_attr_e('To Top', 'minimalist-blogger-x'); ?>">
			<i class="fa fa-angle-double-up"></i>
		</a>
	<?php endif; ?>


</footer><!-- #colophon -->


<div id="smobile-menu" class="mobile-only"></div>
<div id="mobile-menu-overlay"></div>

<?php wp_footer(); ?>
</body>

</html>