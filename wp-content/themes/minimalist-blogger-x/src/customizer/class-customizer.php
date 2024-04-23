<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\CustomizerPanels;
use SuperbThemesCustomizer\CustomizerSections;
use SuperbThemesCustomizer\CustomizerControls;

use SuperbThemesCustomizer\CustomizerColorScheme;
use SuperbThemesCustomizer\Utils\CustomizerRefocusButton;

class CustomizerController
{
	private static $Instance;
	public static function GetInstance()
	{
		if (!isset(self::$Instance)) {
			self::$Instance = new self();
		}
		return self::$Instance;
	}

	private static $CustomizerObject = false;
	private static $COLOR_SCHEME = false;
	private static $RefocusButtons = array();

	public function __construct()
	{
		add_action('customize_register', array($this, 'superbthemes_customizer_customize_register_init'));
		add_action('customize_controls_print_styles', array($this, 'superbthemes_customizer_customizer_scripts'));
		add_action('customize_controls_print_footer_scripts', array($this, 'superbthemes_customizer_customizer_footer_scripts'));
		add_action('customize_preview_init', array($this, 'superbthemes_customizer_preview_scripts'));
		add_action('customize_controls_enqueue_scripts', array($this, 'superbthemes_customizer_scripts'));
		add_action('wp_head', array($this, 'superbthemes_customizer_css_final_output'));
		add_action('wp_enqueue_scripts', array($this, 'superbthemes_customizer_scripts_final_output'), 0);
	}

	public static function GetColorScheme()
	{
		if (!self::$COLOR_SCHEME) {
			self::$COLOR_SCHEME = new CustomizerColorScheme();
		}
		return self::$COLOR_SCHEME;
	}

	public function superbthemes_customizer_customize_register_init($wp_customize)
	{
		self::$CustomizerObject = $wp_customize;
		new CustomizerPanels();
		new CustomizerSections();
		new CustomizerControls(self::GetColorScheme());

		/* Overwrite values */
		$this->OverwriteValues();
		/* */

		self::$CustomizerObject = false;
	}


	private function OverwriteValues()
	{
		$wp_customize = self::$CustomizerObject;
		if (isset($wp_customize->selective_refresh)) {
			$wp_customize->selective_refresh->add_partial('blogname', array(
				'selector'        => '.logofont',
				'render_callback' => array($this, 'superbthemes_customizer_customize_partial_blogname'),
			));
			$wp_customize->selective_refresh->add_partial('blogdescription', array(
				'selector'        => '.logodescription',
				'render_callback' => array($this, 'superbthemes_customizer_customize_partial_blogdescription'),
			));
		}

		$wp_customize->get_control('custom_logo')->priority = 0;
		$wp_customize->get_section('background_image')->panel = 'minimalist-blogger-x-site-bg-panel';
		$wp_customize->get_control('background_color')->section = 'background_image';

		$wp_customize->get_control('header_textcolor')->section = CustomizerSections::COLOR_SCHEME;
		$wp_customize->get_control('header_textcolor')->label = __('Logo Text Color', 'minimalist-blogger-x');
		$wp_customize->get_control('header_textcolor')->description = __('Sets the text colors for the logo.', 'minimalist-blogger-x');
		$wp_customize->get_control('header_textcolor')->priority = 99;

		$wp_customize->get_control('header_image')->section = CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT;
		$wp_customize->get_section(CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT)->title = __('Default Header', 'minimalist-blogger-x');
	}

	public function superbthemes_customizer_preview_scripts()
	{
		wp_enqueue_script('minimalist-blogger-x-customizer-preview', get_template_directory_uri() . '/js/customizer-preview.js', array('customize-preview'), wp_get_theme()->Version, true);
		wp_localize_script('minimalist-blogger-x-customizer-preview', 'minimalist_blogger_x_theme_customizer_preview_variables', array(
			'COLOR_VARIABLES' => self::$COLOR_SCHEME->GetColorIdsNoVariants(),
			'COLOR_VARIABLES_VARIANTS' => self::$COLOR_SCHEME->GetColorIdsVariantsOnly(),
			'LAYOUT_VARIABLES' => array(
				'RANGE' => CustomizerControls::RANGE_VARIABLE_CONTROLS
			)
		));
	}

	public function superbthemes_customizer_scripts()
	{
		wp_enqueue_script('minimalist-blogger-x-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), wp_get_theme()->Version, true);
		wp_localize_script('minimalist-blogger-x-customizer', 'minimalist_blogger_x_theme_customizer_variables', array(
			'COLOR_VARIABLES_VARIANTS' => self::$COLOR_SCHEME->GetColorIdsVariantsOnly()
		));
	}

	public function superbthemes_customizer_customizer_scripts()
	{
		wp_enqueue_style('minimalist-blogger-x-customizer-css', get_template_directory_uri() . '/css/customizer.css', array(), wp_get_theme()->Version);
	}

	public function superbthemes_customizer_customizer_footer_scripts()
	{
		echo '<script id="superbthemes-customizer-refocus-buttons">';
		foreach (self::$RefocusButtons as $RefocusButton) {
			echo "
			wp.customize.control( '" . esc_attr($RefocusButton->GetWrapperId()) . "', function( control ) {
				control.container.find( '.superbthemes-customizer-refocus-button' ).on( 'click', function() {
					wp.customize." . esc_html($RefocusButton->GetType()) . "( '" . esc_attr($RefocusButton->GetRefocusId()) . "' ).focus();
					} );
					} );
					";
				}
				echo '</script>';
			}

			public static function AddRefocusButtonToScripts($button)
			{
				if ($button instanceof CustomizerRefocusButton) {
					self::$RefocusButtons[] = $button;
				}
			}

			public static function GetCustomizerObject()
			{
				return self::$CustomizerObject;
			}

	/**
	 * Render the site title for the selective refresh partial.
	 *
	 * @return void
	 */
	public function superbthemes_customizer_customize_partial_blogname()
	{
		bloginfo('name');
	}

	/**
	 * Render the site tagline for the selective refresh partial.
	 *
	 * @return void
	 */
	public function superbthemes_customizer_customize_partial_blogdescription()
	{
		bloginfo('description');
	}

	public function superbthemes_customizer_scripts_final_output()
	{
		if (
			CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
			CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
		) {
			wp_enqueue_script('minimalist-blogger-x-colcade-masonry', get_template_directory_uri() . '/js/lib/colcade.js', array('jquery'), wp_get_theme()->Version, false);
			wp_enqueue_script('minimalist-blogger-x-colcade-masonry-init', get_template_directory_uri() . '/js/colcade-init.js', false, wp_get_theme()->Version, true);
		}

		if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::GENERAL_LAYOUT_MODE) == CustomizerControls::GENERAL_DEFAULTMODE) {
			wp_enqueue_style('minimalist-blogger-x-simple', get_template_directory_uri() . '/css/simple-theme-mode.css', array(), wp_get_theme()->Version, 'all');
		} elseif (CustomizerControls::GetSelectedOrDefault(CustomizerControls::GENERAL_LAYOUT_MODE) == CustomizerControls::GENERAL_BOXMODE) {
			$boxmode_media_rule = CustomizerControls::GetSelectedOrDefault(CustomizerControls::GENERAL_BOXMODE_HIDE_MOBILE) == "1" ? "all and (min-width: 600px)" : "all";
			wp_enqueue_style('minimalist-blogger-x-boxed', get_template_directory_uri() . '/css/boxed-theme-mode.css', array(), wp_get_theme()->Version, $boxmode_media_rule);
		} elseif (CustomizerControls::GetSelectedOrDefault(CustomizerControls::GENERAL_LAYOUT_MODE) == CustomizerControls::GENERAL_BORDERMODE) {
			$bordermode_media_rule = CustomizerControls::GetSelectedOrDefault(CustomizerControls::GENERAL_BORDERMODE_HIDE_MOBILE) == "1" ? "all and (min-width: 600px)" : "all";
			wp_enqueue_style('minimalist-blogger-x-border', get_template_directory_uri() . '/css/border-theme-mode.css', array(), wp_get_theme()->Version, $bordermode_media_rule);
		}

		if (
			CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_LAYOUT_STYLE) === CustomizerControls::NAVIGATION_LAYOUT_CHOICE_BUSINESS
		) {
			wp_enqueue_script('minimalist-blogger-x-search-bar', get_template_directory_uri() . '/js/search-bar.js', false, wp_get_theme()->Version, true);
		}
	}

	public function superbthemes_customizer_css_final_output()
	{ ?>
		<style type="text/css">
			<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_LAYOUT_STYLE) === CustomizerControls::NAVIGATION_LAYOUT_CHOICE_BUSINESS) : ?><?php $ra_button_text = CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_RIGHTALIGNED_BUTTON_TEXT);
				$has_ra_button_text = $ra_button_text !== false && !empty($ra_button_text);
				if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_SEARCHBAR_ENABLED) == "1" || $has_ra_button_text) : ?>
					/** If button or search enabled */

					@media screen and (min-width: 1024px) {
						.wc-nav-content {
							display: -webkit-box;
							display: -ms-flexbox;
							display: flex;
							-webkit-box-pack: center;
							-ms-flex-pack: center;
							justify-content: center;
						}
					}

					.logo-container {
						max-width: 25%;
					}

					.center-main-menu {
						max-width: 75%;
					}

					.header-content-button-container {
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
						-webkit-box-align: center;
						-ms-flex-align: center;
						align-items: center;
						margin-left: 10px;
					}

					.header-content-button-container a {
						padding: 12px 22px;
						white-space: nowrap;
						-webkit-box-ordinal-group: 4;
						-ms-flex-order: 3;
						order: 3;
						margin-left: 10px;
					}

					.navigation-layout-search-bar-wrapper {
						position: relative;
					}

					.header-content-button-container .navigation-layout-search-button {
						-webkit-box-align: center;
						-ms-flex-align: center;
						align-items: center;
						border-radius: 50%;
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
						height: 50px;
						width: 50px;
						padding: 15px;
						-webkit-box-pack: center;
						-ms-flex-pack: center;
						justify-content: center;
						text-decoration: none;
						-webkit-transition: color .15s linear, background-color .15s linear, -webkit-box-shadow .15s linear, -webkit-transform .15s linear;
						transition: color .15s linear, background-color .15s linear, -webkit-box-shadow .15s linear, -webkit-transform .15s linear;
						-o-transition: color .15s linear, background-color .15s linear, box-shadow .15s linear, transform .15s linear;
						transition: color .15s linear, background-color .15s linear, box-shadow .15s linear, transform .15s linear;
						transition: color .15s linear, background-color .15s linear, box-shadow .15s linear, transform .15s linear, -webkit-box-shadow .15s linear, -webkit-transform .15s linear;
						background: var(--minimalist-blogger-x-light-2);
					}

					.header-content-button-container .navigation-layout-search-button svg {
						width: 100%;
						height: 100%;
					}

					.header-content-button-container .navigation-layout-search-button svg g {
						fill: var(--minimalist-blogger-x-primary);
					}


					.navigation-layout-search-bar-wrapper .navigation-layout-search-bar-input {
						position: absolute;
						right: 100%;
						height: 100%;
						-webkit-transition: visibility 0.1s, opacity 0.1s linear;
						-o-transition: visibility 0.1s, opacity 0.1s linear;
						transition: visibility 0.1s, opacity 0.1s linear;
						visibility: hidden;
						border: 2px solid var(--minimalist-blogger-x-primary);
						opacity: 0;

					}

					.navigation-layout-search-bar-wrapper .navigation-layout-search-bar-input.spbnl-search-bar-active {
						visibility: visible;
						opacity: 1;
					}

					@media screen and (max-width: 1023px) {
						.top-nav-wrapper .content-wrap .header-content-container {
							display: block;
						}

						.header-content-button-container {
							width: 100%;
							-ms-flex-wrap: wrap;
							flex-wrap: wrap;
							margin: 0 0 20px;
							display: -webkit-inline-box;
							display: -ms-inline-flexbox;
							display: inline-flex;
						}

						.header-content-button-container a {
							margin-left: 0px;
							margin-top: 20px;
						}

						.header-content-button-container form {
							display: none;
						}

						.center-main-menu {
							max-width: 100%;
						}
					}


					/** */
				<?php endif; ?><?php endif; ?>

				/**  */
				<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_LAYOUT_STYLE) === CustomizerControls::NAVIGATION_LAYOUT_CHOICE_LARGE) : ?>.logo-container.navigation-layout-large.header-has-no-side-elements {
					max-width: 100% !important;
				}

				.content-wrap.navigation-layout-large {
					width: 1480px;
					padding: 0;
				}

				.header-content-container.navigation-layout-large {
					padding: 25px 0 20px;
				}

				.header-content-author-container,
				.header-content-some-container {
					display: flex;
					align-items: center;
					min-width: 300px;
					max-width: 300px;
				}

				.header-content-some-container {
					justify-content: right;
				}

				.header-content-some-container a {
					text-align: center;
				}

				.logo-container.navigation-layout-large {
					text-align: center;
					width: 100%;
					max-width: calc(100% - 600px);
					padding: 0 10px;
				}

				.header-author-container-img-wrapper {
					min-width: 60px;
					min-height: 60px;
					max-width: 60px;
					max-height: 60px;
					margin-right: 10px;
					border-radius: 50%;
					border-style: solid;
					border-width: 2px;
					border-color: var(--minimalist-blogger-x-primary);
					overflow: hidden;
					background-size: contain;
					background-repeat: no-repeat;
					background-position: center;
				}

				.header-author-container-text-wrapper .header-author-name {
					display: block;
					font-size: var(--font-primary-medium);
					font-family: var(--font-primary);
					font-weight: var(--font-primary-bold);
					color: var(--minimalist-blogger-x-foreground);
				}

				.header-author-container-text-wrapper .header-author-tagline {
					margin: 0;
					font-family: var(--font-primary);
					font-size: var(--font-primary-small);
					display: block;
					color: var(--minimalist-blogger-x-foreground);
				}

				.logo-container a.custom-logo-link {
					margin-top: 0px;
				}

				.navigation-layout-large .site-title {
					font-weight: var(--font-secondary-bold);
					font-size: var(--font-primary-xxl);
					margin: 0 0 5px 0;
				}

				p.logodescription {
					margin-top: 0;
				}

				.header-content-some-container a {
					padding: 15px 25px;
					display: inline-block;
				}

				.header-content-some-container a:hover {
					background-color: var(--minimalist-blogger-x-primary-dark);
				}

				.navigation-layout-large .center-main-menu {
					max-width: 100%;
				}

				.navigation-layout-large .center-main-menu .pmenu {
					text-align: center;
					float: none;
				}

				.navigation-layout-large .center-main-menu .wc-nav-content {
					justify-content: center;
				}


				<?php endif; ?>.custom-logo-link img {
					width: auto;
					max-height: var(<?=esc_html(CustomizerControls::SITE_IDENTITY_LOGO_HEIGHT);?>);
				}
			
				<?php if(CustomizerControls::GetSelectedOrDefault(CustomizerControls::SITE_IDENTITY_HIDE_LOGO_MOBILE) == "1"): ?>
				@media (max-width: 1023px) {
					a.custom-logo-link {
						display:none !important;
					}
				}
				<?php endif; ?>
			
				<?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_ONE_COLUMN_ALTERNATIVE) : ?>.all-blog-articles article h2.entry-title {
					font-size: var(--font-primary-large);
					margin: 10px 0 0 0;
				}

				.entry-meta,
				.entry-meta a {
					font-weight: var(--font-primary-default);
					font-size: var(--font-primary-small);
				}



				@media (min-width: 700px) {
					.add-blog-to-sidebar .all-blog-articles .blogposts-list {
						-webkit-box-flex: 1;
						-ms-flex: 1 1 100%;
						flex: 1 1 100%;
						max-width: 100%;
					}

					.all-blog-articles article h2.entry-title {
						font-size: var(--font-primary-extra);
					}

					.add-blog-to-sidebar .all-blog-articles .blogposts-list .featured-img-box {
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
					}

					.add-blog-to-sidebar .all-blog-articles .blogposts-list .featured-img-box .featured-thumbnail {
						max-width: 45%;
						width: 100%;
						min-width: 45%;
					}

					.add-blog-to-sidebar .all-blog-articles .blogposts-list .featured-img-box .featured-thumbnail img {
						-o-object-fit: cover;
						object-fit: cover;
						height: 100%;
						min-width: 100%;
					}

					.add-blog-to-sidebar .all-blog-articles .blogposts-list .featured-img-box header.entry-header {
						padding-right: 25px;
					}

					.add-blog-to-sidebar .all-blog-articles .blogposts-list header.entry-header {
						display: -webkit-box;
						display: -ms-flexbox;
						display: flex;
						-ms-flex-wrap: wrap;
						flex-wrap: wrap;
					}

					.add-blog-to-sidebar .all-blog-articles .blogposts-list header.entry-header h2.entry-title {
						-webkit-box-ordinal-group: 3;
						-ms-flex-order: 2;
						order: 2;
					}

				}


				<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_ONE_COLUMNS) : ?>.all-blog-articles {
					display: block;
				}
				.all-blog-articles .featured-img-box {
					padding:30px 30px 0px 30px;
				}
				.all-blog-articles .post-meta-inner-wrapper {
					margin-top: 30px;
					display: inline-block;
					background: var(--minimalist-blogger-x-background);
					padding: 0px 19px;
				}
				.all-blog-articles .blog-data-wrapper:after {
					content: ' ';
					background: var(--minimalist-blogger-x-foreground);
					width: 100%;
					height: 1px;
					display: block;
					margin: -12px auto 0 auto;
					max-width: 75%;
				}
				.all-blog-articles .no-featured-img-box .blogpost-is-sticky-icon, 
				body:not(.woocommerce-page):not(.elementor-page) .all-blog-articles .blogpost-is-sticky-icon:not(.blogpost-is-sticky-icon-has-featured-image) {
					width: 100%;
					display: inline-block;
					margin-left: 0px;
					text-align: left;
					padding-left: 15px;
				}
				.all-blog-articles .blogposts-list,
				.add-blog-to-sidebar .all-blog-articles .blogposts-list {
					width: 100%;
					max-width: 100%;
					flex: 100%;
					text-align:center;
				}
				.all-blog-articles .post-meta-inner-wrapper {
					margin-top:20px;
				}
				.all-blog-articles .blogposts-list .entry-content {
					text-align:left;
					margin-top:20px;
				}
				.all-blog-articles article h2,
				.all-blog-articles .blogposts-list .entry-meta, .add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header .entry-meta{
					text-align:center;
				}
				.all-blog-articles .blog-data-wrapper {
					-webkit-box-pack:center;
					-ms-flex-pack:center;
					justify-content:center;
				}

				.all-blog-articles article h2.entry-title {
					font-size: var(--font-secondary-xl);
				}

				@media (max-width: 1100px) {
					.all-blog-articles article h2.entry-title {
						font-size: var(--font-secondary-xl);
					}
				}

				@media (max-width: 700px) {
					.all-blog-articles article h2.entry-title {
						font-size: var(--font-primary-large);
					}
					.all-blog-articles .featured-img-box {
						padding:20px 20px 0px 20px;
					}
					.post-meta-inner-wrapper,
					.post-meta-inner-wrapper * {
						margin-top:15px;
						font-size: var(--font-primary-normal);
					}
					.all-blog-articles .blog-data-wrapper:after {
						max-width:100%;
					}
					.all-blog-articles .post-meta-inner-wrapper {
						padding: 0px 10px;
					}
				}

				<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header {
					display: -webkit-box;
					display: -ms-flexbox;
					display: flex;
					-ms-flex-wrap: wrap;
					flex-wrap: wrap;
					width: 100%;
				}


				.all-blog-articles article h2.entry-title {
					font-size: var(--font-secondary-extra);
				}

				@media (max-width: 700px) {
					.all-blog-articles article h2.entry-title {
						font-size: var(--font-secondary-large);
					}
				}


				<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list {
					width: 31%;
					max-width: 31%;
					-webkit-box-flex: 31%;
					-ms-flex: 31%;
					flex: 31%;
					margin-bottom: 30px;
				}

				.all-blog-articles article h2.entry-title {
					font-size: var(--font-secondary-large);
				}

				.add-blog-to-sidebar .all-blog-articles .blogposts-list .entry-header {
					display: -webkit-box;
					display: -ms-flexbox;
					display: flex;
					-ms-flex-wrap: wrap;
					flex-wrap: wrap;
					width: 100%;
				}


				@media (max-width: 1024px) {
					.add-blog-to-sidebar .all-blog-articles .blogposts-list {
						width: 48%;
						max-width: 48%;
						-webkit-box-flex: 48%;
						-ms-flex: 48%;
						flex: 48%;
					}
				}

				@media (max-width: 600px) {
					.add-blog-to-sidebar .all-blog-articles .blogposts-list {
						width: 100%;
						max-width: 100%;
						-webkit-box-flex: 100%;
						-ms-flex: 100%;
						flex: 100%;
					}
				}

			<?php endif; ?><?php if (
				CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
				CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
			) : ?>.add-blog-to-sidebar .all-blog-articles .blogposts-list {
				width: 100%;
				max-width: 100%;
			}

			.all-blog-articles article h2.entry-title {
				font-size: var(--font-secondary-large);
			}

			.minimalist-blogger-x-colcade-column {
				-webkit-box-flex: 1;
				-webkit-flex-grow: 1;
				-ms-flex-positive: 1;
				flex-grow: 1;
				margin-right: 2%;
			}

			.minimalist-blogger-x-colcade-column.minimalist-blogger-x-colcade-last {
				margin-right: 0;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY) : ?>.minimalist-blogger-x-colcade-column {
				max-width: 48%;
			}


			.all-blog-articles article h2.entry-title {
				font-size: var(--font-secondary-extra);
			}

			@media (max-width: 700px) {
				.all-blog-articles article h2.entry-title {
					font-size: var(--font-secondary-large);
				}
			}

			@media screen and (max-width: 800px) {
				.minimalist-blogger-x-colcade-column {
					max-width: 100%;
					margin-right: 0;
				}

				.minimalist-blogger-x-colcade-column:not(.minimalist-blogger-x-colcade-first) {
					display: none !important;
				}

				.minimalist-blogger-x-colcade-column.minimalist-blogger-x-colcade-first {
					display: block !important;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE) === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY) : ?>.minimalist-blogger-x-colcade-column {
				max-width: 31%;
			}

			@media screen and (max-width: 1024px) {
				.minimalist-blogger-x-colcade-column {
					max-width: 48%;
				}

				.minimalist-blogger-x-colcade-column.minimalist-blogger-x-colcade-last {
					display: none;
				}
			}

			@media screen and (max-width: 600px) {
				.minimalist-blogger-x-colcade-column {
					max-width: 100%;
					margin-right: 0px;
				}

				.minimalist-blogger-x-colcade-column:not(.minimalist-blogger-x-colcade-first) {
					display: none !important;
				}

				.minimalist-blogger-x-colcade-column.minimalist-blogger-x-colcade-first {
					display: block !important;
				}
			}

			<?php endif; ?><?php if (get_theme_mod(CustomizerControls::SIDEBAR_WOOCOMMERCE_HIDE) == '1') : ?>.woocommerce-page .wc-sidebar-wrapper {
				display: none;
			}

			.woocommerce-page .featured-content {
				width: 100%;
				margin-right: 0px;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE) == CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE) : ?>.blogposts-list .featured-thumbnail {
				height: 220px;
				background-size: cover;
				background-position: center;
			}

			.related-posts-posts .blogposts-list .featured-thumbnail {
				height: 220px;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_FEATURED_IMAGE_STYLE) == CustomizerControls::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) : ?>.blogposts-list .featured-thumbnail {
				height: 220px;
				display: flex;
				align-items: center;
				justify-content: center;
				overflow: hidden;
			}

			.related-posts-posts .blogposts-list .featured-thumbnail {
				height: 220px;
			}

			.blogposts-list .featured-thumbnail img {
				z-index: 1;
				border-radius: 0;
				width: auto;
				height: auto;
				max-height: 100%;
			}

			.blogposts-list .featured-thumbnail .featured-img-category {
				z-index: 2;
			}

			.blogposts-list .featured-img-bg-blur {
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				background-size: cover;
				background-position: center;
				filter: blur(5px);
				opacity: .5;
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE) == CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE) : ?>.featured-thumbnail-cropped {
				height: 320px;
			}

			@media screen and (max-width: 1024px) {
				.featured-thumbnail-cropped {
					height: 300px;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::SINGLE_FEATURED_IMAGE_STYLE) == CustomizerControls::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR) : ?>.featured-thumbnail-cropped {
				position: relative;
				height: 320px;
				display: flex;
				align-items: center;
				justify-content: center;
				overflow: hidden;
			}

			@media screen and (max-width: 1024px) {
				.featured-thumbnail-cropped {
					height: 300px;
				}
			}

			.featured-thumbnail-cropped img {
				width: auto;
				height: auto;
				max-height: 100%;
			}

			.featured-thumbnail-cropped .featured-img-bg-blur {
				width: 100%;
				height: 100%;
				position: absolute;
				top: 0;
				left: 0;
				background-size: cover;
				background-position: center;
				filter: blur(5px);
				opacity: .5;
			}

			.featured-thumbnail-cropped img {
				z-index: 1;
			}

			<?php endif; ?><?php if (get_theme_mod(CustomizerControls::SINGLE_HIDE_NEXT_PREV) == '1') : ?>.nav-links,
			.single .navigation.post-navigation {
				display: none;
			}

			<?php endif; ?><?php if (get_theme_mod(CustomizerControls::HEADER_BUTTON_HIDE_MOBILE) == '1') : ?>@media (max-width:992px) {
				.header-button-wrap a {
					display: none;
				}
			}

			<?php endif; ?><?php if (get_theme_mod(CustomizerControls::HEADER_TAGLINE_HIDE_MOBILE) == '1') : ?>@media (max-width:992px) {
				.bottom-header-paragraph {
					display: none;
				}
			}

			<?php endif; ?><?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_HIDE_CATEGORY_FEATURED_IMAGE) == '1') : ?>.all-blog-articles .featured-img-category {
				display: none;
			}

		<?php endif; ?>

		/** COLOR SCHEME & LAYOUT VARIABLES **/
		:root {
			<?php
			foreach (self::GetColorScheme()->GetColors() as $customizerColor) {
				echo esc_html($customizerColor->GetId()) . ': ' . esc_html(CustomizerControls::GetSelectedOrDefault($customizerColor->GetId())) . ';';
			}
			foreach (CustomizerControls::RANGE_VARIABLE_CONTROLS as $customizerRangeVariable) {
				echo esc_html($customizerRangeVariable) . ': ' . absint(CustomizerControls::GetSelectedOrDefault($customizerRangeVariable)) . 'px;';
			}
			?>
		}

		/**  **/
	</style>

	<?php
}

public function superbthemes_customizer_blog_first_row_has_thumbnail()
{
	/* ** Only Display Navigation::before BG Color if First Row Has Thumbnail ** */
	global $wp_query;
	if (have_posts()) {
		$minimalist_blogger_x_theme_has_first_row_image = false;
		$minimalist_blogger_x_theme_has_first_row_current_idx = 0;
		switch (CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE)) {
			case CustomizerControls::BLOGFEED_ONE_COLUMNS:
			$minimalist_blogger_x_theme_has_first_row_idx_max = 1;
			break;
			case CustomizerControls::BLOGFEED_TWO_COLUMNS:
			$minimalist_blogger_x_theme_has_first_row_idx_max = 2;
			break;
			case CustomizerControls::BLOGFEED_THREE_COLUMNS:
			default:
			$minimalist_blogger_x_theme_has_first_row_idx_max = 3;
			break;
		}
		foreach ($wp_query->posts as $minimalist_blogger_x_theme_current_post_in_loop) {
			if ($minimalist_blogger_x_theme_has_first_row_current_idx >= $minimalist_blogger_x_theme_has_first_row_idx_max) {
				break;
			}
			$this_has_image = has_post_thumbnail($minimalist_blogger_x_theme_current_post_in_loop->ID);
			if ($this_has_image) {
				$minimalist_blogger_x_theme_has_first_row_image = true;
				break;
			}
			$minimalist_blogger_x_theme_has_first_row_current_idx++;
		}

		return $minimalist_blogger_x_theme_has_first_row_image;
	}
	/* **************************************************************************************** */
}

public static function MaybeGetMasonryColumnOutput()
{
	$selected_blog_style = CustomizerControls::GetSelectedOrDefault(CustomizerControls::BLOGFEED_COLUMNS_STYLE);
	if (
		$selected_blog_style === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ||
		$selected_blog_style === CustomizerControls::BLOGFEED_THREE_COLUMNS_MASONRY
	) {
		$col_amount = $selected_blog_style === CustomizerControls::BLOGFEED_TWO_COLUMNS_MASONRY ? 2 : 3;
		for ($i = 1; $i <= $col_amount; $i++) {
			echo '<div class="minimalist-blogger-x-colcade-column' . ($i === $col_amount ? ' minimalist-blogger-x-colcade-last' : ($i === 1 ? ' minimalist-blogger-x-colcade-first' : '')) . '"></div>';
		}
	}
}
}
