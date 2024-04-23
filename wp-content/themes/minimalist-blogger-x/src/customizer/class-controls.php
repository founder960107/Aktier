<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;
use SuperbThemesCustomizer\CustomizerPanels;
use SuperbThemesCustomizer\CustomizerSections;

class CustomizerControls
{
    const GENERAL_LAYOUT_MODE = 'general_layout_mode';
    const GENERAL_DEFAULTMODE = 'general_layout_defaultmode';
    const GENERAL_BOXMODE = 'general_layout_boxmode';
    const GENERAL_BOXMODE_HIDE_MOBILE = 'general_layout_boxmode_hide_mobile';
    const GENERAL_BORDERMODE = 'general_layout_bordermode';
    const GENERAL_BORDERMODE_HIDE_MOBILE = 'general_layout_bordermode_hide_mobile';
    const GENERAL_BORDER_RADIUS_ELEMENTS = '--minimalist-blogger-x-element-border-radius';
    const GENERAL_BORDER_RADIUS_BUTTONS = '--minimalist-blogger-x-button-border-radius';
    //
    const UPPERWIDGETS_FRONTPAGE_ONLY = 'upperwidgets_frontpage_only';

    const HEADER_METASLIDER_SHORTCODE = 'header_metaslider_overwrite';
    const HEADER_METASLIDER_ONLY_FRONTPAGE = 'only_show_header_frontpage_metaslider';

    const HEADER_ONLY_FRONTPAGE = 'only_show_header_frontpage';
    const HEADER_TITLE = 'header_img_text';
    const BEFORE_TITLE = 'before_title';
    const HEADER_TAGLINE = 'header_img_text_tagline';
    const HEADER_TAGLINE_HIDE_MOBILE = 'hide_tagline_mobile';
    const HEADER_BUTTON_TEXT = 'header_img_button_text';
    const HEADER_BUTTON_LINK = 'header_img_button_link';
    const HEADER_BUTTON_HIDE_MOBILE = 'hide_button_mobile';

    const SITE_IDENTITY_LOGO_HEIGHT = '--minimalist-blogger-x-logo-height';
    const SITE_IDENTITY_HIDE_TAGLINE = 'navigation_hide_tagline';
    const SITE_IDENTITY_HIDE_LOGO_MOBILE = 'navigation_hide_logo_mobile';

    const NAVIGATION_HIDE_CART = 'navigation_hide_cart';
    const NAVIGATION_LAYOUT_STYLE = 'navigation_layout_style';
    const NAVIGATION_LAYOUT_CHOICE_SMALL = 'navigation_layout_style_choice_small';
    const NAVIGATION_LAYOUT_CHOICE_LARGE = 'navigation_layout_style_choice_large';
    const NAVIGATION_LAYOUT_CHOICE_BUSINESS = 'navigation_layout_style_choice_business';
    const NAVIGATION_AUTHOR_IMAGE = 'navigation_large_author_image';
    const NAVIGATION_AUTHOR_NAME = 'navigation_large_author_name';
    const NAVIGATION_AUTHOR_TAGLINE = 'navigation_large_author_tagline';
    const NAVIGATION_RIGHTALIGNED_BUTTON_TEXT = 'navigation_large_rightalignedbutton_text';
    const NAVIGATION_RIGHTALIGNED_BUTTON_LINK = 'navigation_large_rightalignedbutton_link';
    const NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK = 'navigation_large_rightalignedbutton_link_targetblank';
    const NAVIGATION_SEARCHBAR_ENABLED = 'navigation_searchbar_enabled';

    const SIDEBAR_WOOCOMMERCE_HIDE = 'hide_wc_sidebar';

    const FOOTER_GOTOTOP_HIDE = 'footer_go_to_top_hide';

    const COPYRIGHT_TEXT = 'footer_copyright_text';

    const BLOGFEED_SHOW_FULL_POSTS = 'show_except_or_full';
    ////
    const BLOGFEED_COLUMNS_STYLE = 'blogfeed_columns_style';
    //
    const BLOGFEED_ONE_COLUMNS = 'blogfeed_onecolumn';
    const BLOGFEED_TWO_COLUMNS = 'blogfeed_twocolumn';
    const BLOGFEED_THREE_COLUMNS = 'blogfeed_three_columns';
    const BLOGFEED_TWO_COLUMNS_MASONRY = 'blogfeed_twocolumn_masonry';
    const BLOGFEED_THREE_COLUMNS_MASONRY = 'blogfeed_three_colums_masonry';
    const BLOGFEED_ONE_COLUMN_ALTERNATIVE = 'blogfeed_onecolumn_alternative';
    /////
    const BLOGFEED_HIDE_SIDEBAR = 'blogfeed_show_sidebar';
    const BLOGFEED_HIDE_BYLINE_IMAGE = 'blogfeed_hide_authorimage';
    const BLOGFEED_HIDE_BYLINE_AUTHOR = 'blogfeed_hide_abouttheauthor';
    const BLOGFEED_SHOW_READMORE_BUTTON = 'blogfeed_show_readmore_button';
    const BLOGFEED_HIDE_CATEGORY_FEATURED_IMAGE = 'blogfeed_hide_category_featuredimage';
    ////
    const BLOGFEED_FEATURED_IMAGE_STYLE = 'blogfeed_featured_image_style';
    //
    const BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE = 'blogfeed_featured_image_style_fullimage';
    const BLOGFEED_FEATURED_IMAGE_CHOICE_COVER_IMAGE = 'blogfeed_featured_image_style_cover';
    const BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR = 'blogfeed_featured_image_style_coverblur';
    ////
    const BLOGFEED_FEATURED_IMAGE_PLACEHOLDER = 'blogfeed_featured_image_placeholder';
    //

    ////
    const SINGLE_FEATURED_IMAGE_STYLE = 'SINGLE_featured_image_style';
    //
    const SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE = 'SINGLE_featured_image_style_fullimage';
    const SINGLE_FEATURED_IMAGE_CHOICE_COVER_IMAGE = 'SINGLE_featured_image_style_cover';
    const SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE_COVER_BLUR = 'SINGLE_featured_image_style_coverblur';
    ////
    const SINGLE_HIDE_BYLINE_IMAGE = 'single_hide_bylineauthorimage';
    const SINGLE_HIDE_BYLINE_AUTHOR = 'single_hide_bylineauthor';
    const SINGLE_DISPLAY_ABOUT_AUTHOR = 'postpage_show_author';
    const SINGLE_HIDE_RELATED_POSTS = 'postpage_show_hide_relatedposts';
    const SINGLE_HIDE_NEXT_PREV = 'postpage_hide_nextprev';
    const SINGLE_HIDE_CATEGORIES_TAGS = 'show_posts_categories_tags';
    const SINGLE_HIDE_SIDEBAR = 'postpage_hide_sidebar';

    //
    const PAGE_404_HIDE_POSTS = 'page_404_hide_recent_posts';


    const RANGE_VARIABLE_CONTROLS = array(
        self::SITE_IDENTITY_LOGO_HEIGHT,
        self::GENERAL_BORDER_RADIUS_ELEMENTS,
        self::GENERAL_BORDER_RADIUS_BUTTONS
    );

    private static $CONTROL_DEFAULTS = array(
        self::SITE_IDENTITY_LOGO_HEIGHT => 65,
        self::BLOGFEED_COLUMNS_STYLE => self::BLOGFEED_ONE_COLUMNS,
        self::BLOGFEED_FEATURED_IMAGE_STYLE => self::BLOGFEED_FEATURED_IMAGE_CHOICE_FULL_IMAGE,
        self::SINGLE_FEATURED_IMAGE_STYLE => self::SINGLE_FEATURED_IMAGE_CHOICE_FULL_IMAGE,
        self::NAVIGATION_LAYOUT_STYLE => self::NAVIGATION_LAYOUT_CHOICE_LARGE,
        self::BLOGFEED_HIDE_SIDEBAR => "",
        self::SINGLE_HIDE_SIDEBAR => "",
        self::SINGLE_HIDE_RELATED_POSTS => "1",
        self::NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK => "1",
        self::NAVIGATION_SEARCHBAR_ENABLED => "",
        self::GENERAL_LAYOUT_MODE => self::GENERAL_BORDERMODE,
        self::GENERAL_BOXMODE_HIDE_MOBILE => "1",
        self::GENERAL_BORDERMODE_HIDE_MOBILE => "",
        self::GENERAL_BORDER_RADIUS_ELEMENTS => 0,
        self::GENERAL_BORDER_RADIUS_BUTTONS => 0,
        self::SITE_IDENTITY_HIDE_TAGLINE => "",
        self::BLOGFEED_SHOW_READMORE_BUTTON => "1",
        self::FOOTER_GOTOTOP_HIDE => "1",
        self::SINGLE_HIDE_BYLINE_IMAGE => "1",
        self::BLOGFEED_HIDE_BYLINE_IMAGE => "1",
        self::PAGE_404_HIDE_POSTS => "1",
        self::BLOGFEED_HIDE_CATEGORY_FEATURED_IMAGE => "1",
        self::SITE_IDENTITY_HIDE_LOGO_MOBILE => ""
    );

    public function __construct($colorScheme)
    {
        /*
        *
        * COLOR SCHEME
        *
        */
        $dark_variants = array();
        foreach ($colorScheme->GetColors() as $customizerColor) {
            $dark_variants[] = $customizerColor->GetDarkId();
            $this->CreateColorCustomizerItem($customizerColor, in_array($customizerColor->GetId(), $dark_variants, true));
        }

        /*
        */

        /*
        *
        * GENERAL
        *
        */
        new CustomizerItem(self::GENERAL_LAYOUT_MODE, array(
            "type" => CustomizerType::CONTROL_RADIO,
            "label" => __('Layout Mode', 'minimalist-blogger-x'),
            "description" => __('Select the layout mode of the theme.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::GENERAL,
            "default" => self::$CONTROL_DEFAULTS[self::GENERAL_LAYOUT_MODE],
            "choices" => array(
                self::GENERAL_DEFAULTMODE => "Simple Layout",
                self::GENERAL_BOXMODE => "Boxed Layout",
                self::GENERAL_BORDERMODE => "Border Layout"
            )
        ));

        new CustomizerItem(self::GENERAL_BOXMODE_HIDE_MOBILE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Disable Boxed Layout on Mobile', 'minimalist-blogger-x'),
            "description" => __('When this setting is enabled, and Boxed Layout is enabled, the boxed layout will not be applied on mobile devices and other low-width screens.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::GENERAL,
            "default" => self::$CONTROL_DEFAULTS[self::GENERAL_BOXMODE_HIDE_MOBILE],
            "conditions" => array(
                self::GENERAL_LAYOUT_MODE => array(
                    self::GENERAL_BOXMODE
                )
            )
        ));

        new CustomizerItem(self::GENERAL_BORDERMODE_HIDE_MOBILE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Disable Border Layout on Mobile', 'minimalist-blogger-x'),
            "description" => __('When this setting is enabled, and Border Layout is enabled, the border layout will not be applied on mobile devices and other low-width screens.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::GENERAL,
            "default" => self::$CONTROL_DEFAULTS[self::GENERAL_BORDERMODE_HIDE_MOBILE],
            "conditions" => array(
                self::GENERAL_LAYOUT_MODE => array(
                    self::GENERAL_BORDERMODE
                )
            )
        ));



        new CustomizerItem(self::GENERAL_BORDER_RADIUS_ELEMENTS, array(
            "type" => CustomizerType::CONTROL_RANGE,
            "label" => __('Border Radius - Elements', 'minimalist-blogger-x'),
            "description" => __('Sets the border radius for elements in the theme', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::GENERAL,
            "default" => self::$CONTROL_DEFAULTS[self::GENERAL_BORDER_RADIUS_ELEMENTS],
            "range" => array(
                'min' => 0,
                'max' => 50,
                'step' => 1
            )
        ));

        new CustomizerItem(self::GENERAL_BORDER_RADIUS_BUTTONS, array(
            "type" => CustomizerType::CONTROL_RANGE,
            "label" => __('Border Radius - Buttons', 'minimalist-blogger-x'),
            "description" => __('Sets the border radius for buttons in the theme', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::GENERAL,
            "default" => self::$CONTROL_DEFAULTS[self::GENERAL_BORDER_RADIUS_BUTTONS],
            "range" => array(
                'min' => 0,
                'max' => 50,
                'step' => 1
            )
        ));

        /*
        *
        * UPPER WIDGETS
        *
        */
        new CustomizerItem(self::UPPERWIDGETS_FRONTPAGE_ONLY, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Only Display Header Widgets on Front Page', 'minimalist-blogger-x'),
            "description" => __('When this setting is enabled, header widgets will only be shown on the front page.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::WIDGETS,
            "default" => 0
        ));


        /*
        *
        * HEADER METASLIDER
        *
        */
        new CustomizerItem(self::HEADER_METASLIDER_SHORTCODE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('MetaSlider Shortcode', 'minimalist-blogger-x'),
            "description" => __('Add your MetaSlider slider shortcode in this field to use the Slider as your header. This will be used instead of the default theme header.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_METASLIDER,
            "priority" => 1,
        ));
        new CustomizerItem(self::HEADER_METASLIDER_ONLY_FRONTPAGE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Show header on all pages', 'minimalist-blogger-x'),
            "description" => __('Enabling this option will display the MetaSlider header on all pages.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_METASLIDER,
            "default" => 0,
        ));

        /*
        *
        * HEADER DEFAULT
        *
        */
        /* Header */
        new CustomizerItem(self::HEADER_ONLY_FRONTPAGE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Show header on all pages', 'minimalist-blogger-x'),
            "description" => __('Enabling this option will display the header on all pages.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
            "default" => 0,
        ));
        new CustomizerItem(self::BEFORE_TITLE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Text Before Title', 'minimalist-blogger-x'),
            "description" => __('This text displayed in your header, above the title.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_TITLE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Title', 'minimalist-blogger-x'),
            "description" => __('The title text displayed in your header.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_TAGLINE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Tagline', 'minimalist-blogger-x'),
            "description" => __('The tagline text displayed in your header.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_BUTTON_TEXT, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Button Text', 'minimalist-blogger-x'),
            "description" => __('The button text displayed in your header.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_BUTTON_LINK, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Button Link', 'minimalist-blogger-x'),
            "description" => __('The link used by the button in your header.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
        ));
        new CustomizerItem(self::HEADER_BUTTON_HIDE_MOBILE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Header Button on Mobile', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the header button on mobile- and other small screen devices.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
            "default" => 0
        ));
        new CustomizerItem(self::HEADER_TAGLINE_HIDE_MOBILE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Header Tagline on Mobile', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the header tagline on mobile- and other small screen devices.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::HEADER . CustomizerSections::HEADER_DEFAULT,
            "default" => 0
        ));

        /*
        *
        * SITE IDENTITY
        *
        */
        new CustomizerItem(self::SITE_IDENTITY_LOGO_HEIGHT, array(
            "type" => CustomizerType::CONTROL_RANGE,
            "label" => __('Logo Height', 'minimalist-blogger-x'),
            "description" => __('Sets the height limit for the logo image, if once is selected.', 'minimalist-blogger-x'),
            "section" => 'title_tagline',
            "priority" => 1,
            "default" => self::$CONTROL_DEFAULTS[self::SITE_IDENTITY_LOGO_HEIGHT],
            "range" => array(
                'min' => 25,
                'max' => 200,
                'step' => 1
            )
        ));


        new CustomizerItem(self::SITE_IDENTITY_HIDE_LOGO_MOBILE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Logo on Mobile', 'minimalist-blogger-x'),
            "section" => 'title_tagline',
            "priority" => 1,
            "default" => self::$CONTROL_DEFAULTS[self::SITE_IDENTITY_HIDE_LOGO_MOBILE]
        ));

        new CustomizerItem(self::SITE_IDENTITY_HIDE_TAGLINE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Tagline Only', 'minimalist-blogger-x'),
            "section" => 'title_tagline',
            "default" => self::$CONTROL_DEFAULTS[self::SITE_IDENTITY_HIDE_TAGLINE]
        ));


        /*
        *
        * NAVIGATION
        *
        */
        /* Layout */

        new CustomizerItem(self::NAVIGATION_AUTHOR_IMAGE, array(
            "type" => CustomizerType::CONTROL_IMAGE,
            "label" => __('Author Image', 'minimalist-blogger-x'),
            "description" => __('If the Full Navigation Layout is active, sets the author image in the top left side of the navigation layout.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "default" => "",
            "priority" => 1
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_NAME, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Author Name', 'minimalist-blogger-x'),
            "description" => __('If the Full Navigation Layout is active, sets the author name in the top left side of the navigation.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1
        ));

        new CustomizerItem(self::NAVIGATION_AUTHOR_TAGLINE, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Author Tagline', 'minimalist-blogger-x'),
            "description" => __('If the Full Navigation Layout is active, sets the author tagline in the top left side of the navigation.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1
        ));

        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_TEXT, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Right-Aligned Button Text', 'minimalist-blogger-x'),
            "description" => __('If the Full Navigation Layout is active, sets the text of the button in the top right side of the navigation.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1
        ));

        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_LINK, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Right-Aligned Button Link', 'minimalist-blogger-x'),
            "description" => __('If the Full Navigation Layout is active, sets the link of the button in the top right side of the navigation.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1
        ));
        new CustomizerItem(self::NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Open Link in new Window/Tab', 'minimalist-blogger-x'),
            "description" => __('When this setting is enabled, the link of the button will be opened in a new window/tab when clicked.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::NAVIGATION,
            "priority" => 1,
            "default" => self::$CONTROL_DEFAULTS[self::NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK]
        ));


        /*
        *
        * SIDEBAR
        *
        */
        /* Layout */
        new CustomizerItem(self::SIDEBAR_WOOCOMMERCE_HIDE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Sidebar on WooCommerce Pages', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the sidebar on WooCommerce pages.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SIDEBAR,
            "default" => 0
        ));
        new CustomizerItem(self::BLOGFEED_HIDE_SIDEBAR, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Sidebar on Blog Feed, Search Page and Archive Pages', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the sidebar on the blog feed, search page and archive pages and use the full width of the page for the page content.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SIDEBAR,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_HIDE_SIDEBAR]
        ));

        new CustomizerItem(self::SINGLE_HIDE_SIDEBAR, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Sidebar on Posts & Pages', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the sidebar on the posts and pages and use the full width of the page for the page content.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SIDEBAR,
            "default" => self::$CONTROL_DEFAULTS[self::SINGLE_HIDE_SIDEBAR]
        ));

        /*
        *
        * FOOTER
        *
        */
        /* Layout */
        new CustomizerItem(self::FOOTER_GOTOTOP_HIDE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide "Go To Top" Button', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the "Go To Top" button in the footer.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::FOOTER,
            "default" => self::$CONTROL_DEFAULTS[self::FOOTER_GOTOTOP_HIDE]
        ));


        /*
        *
        * PAGE_404
        *
        */
        /* Layout */
        new CustomizerItem(self::PAGE_404_HIDE_POSTS, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Recent Posts', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the recent posts on the 404 page.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::PAGE_404,
            "default" => self::$CONTROL_DEFAULTS[self::PAGE_404_HIDE_POSTS]
        ));
        /*



        /*
        *
        * COPYRIGHT
        *
        */
        new CustomizerItem(self::COPYRIGHT_TEXT, array(
            "type" => CustomizerType::CONTROL_TEXT,
            "label" => __('Copyright Text', 'minimalist-blogger-x'),
            "description" => __('Replaces the copyright text in the footer.', 'minimalist-blogger-x'),
            "section" => CustomizerSections::COPYRIGHT,
            "priority" => 1,
        ));


        /*
        *
        * BLOG FEED
        *
        */
        /* Layout */
        new CustomizerItem(self::BLOGFEED_SHOW_FULL_POSTS, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Show Full Posts', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will display the full posts instead of excerpts.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => 0
        ));

        new CustomizerItem(self::BLOGFEED_SHOW_READMORE_BUTTON, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Show "Continue reading" Button', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will add a "Continue reading" button below every blog post excerpt, if "Show Full Posts" is not enabled.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_SHOW_READMORE_BUTTON]
        ));

        new CustomizerItem(self::BLOGFEED_HIDE_BYLINE_IMAGE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Author Image from Byline', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the author image from the byline.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_HIDE_BYLINE_IMAGE]
        ));

        new CustomizerItem(self::BLOGFEED_HIDE_BYLINE_AUTHOR, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Author Name from Byline', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the author name from the byline.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => 0
        ));

        new CustomizerItem(self::BLOGFEED_HIDE_CATEGORY_FEATURED_IMAGE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Category', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the post category shown on the featured image.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::BLOG,
            "default" => self::$CONTROL_DEFAULTS[self::BLOGFEED_HIDE_CATEGORY_FEATURED_IMAGE]
        ));


        /*
        *
        * SINGLE / POSTS & PAGES / POSTS / PAGES
        *
        */
        /* Layout */
        new CustomizerItem(self::SINGLE_HIDE_BYLINE_IMAGE, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Author Image from Byline', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the author image from the byline.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => self::$CONTROL_DEFAULTS[self::SINGLE_HIDE_BYLINE_IMAGE]
        ));

        new CustomizerItem(self::SINGLE_HIDE_BYLINE_AUTHOR, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Author Name from Byline', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the author name from the byline.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => 0
        ));

        new CustomizerItem(self::SINGLE_DISPLAY_ABOUT_AUTHOR, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Display About The Author Section', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will display a section with information about the author.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => 0
        ));
        new CustomizerItem(self::SINGLE_HIDE_RELATED_POSTS, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Related Posts', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the related posts section.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => self::$CONTROL_DEFAULTS[self::SINGLE_HIDE_RELATED_POSTS]
        ));
        new CustomizerItem(self::SINGLE_HIDE_NEXT_PREV, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Next/Previous Post Buttons', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the "Next" and "Previous" Post Pagination Buttons.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => 0
        ));
        new CustomizerItem(self::SINGLE_HIDE_CATEGORIES_TAGS, array(
            "type" => CustomizerType::CONTROL_CHECKBOX,
            "label" => __('Hide Categories and Tags', 'minimalist-blogger-x'),
            "description" => __('Enabling this setting will hide the categories- and tags sections.', 'minimalist-blogger-x'),
            "section" => CustomizerPanels::LAYOUT . CustomizerSections::SINGLE,
            "default" => 0
        ));
    }

    private function CreateColorCustomizerItem($customizerColor, $is_dark_variant = false)
    {
        new CustomizerItem($customizerColor->GetId(), array(
            "type" => CustomizerType::CONTROL_COLOR,
            "label" => $customizerColor->GetLabel(),
            "description" => $customizerColor->GetDescription(),
            "section" => $is_dark_variant ? 'minimalist-blogger-x-color-scheme-dark-variations' : CustomizerSections::COLOR_SCHEME,
            "default" => $customizerColor->GetDefault(),
            "conditions" => $customizerColor->GetConditions()
        ));
    }

    public static function OverwriteDefault($control, $value)
    {
        self::$CONTROL_DEFAULTS[$control] = $value;
    }

    public static function GetSelectedOrDefault($control)
    {
        $theme_mod = \get_theme_mod($control);
        if (($theme_mod || empty($theme_mod)) && $theme_mod !== false) {
            return $theme_mod;
        }

        return self::GetDefault($control);
    }

    public static function GetDefault($control)
    {
        if (isset(self::$CONTROL_DEFAULTS[$control])) {
            return self::$CONTROL_DEFAULTS[$control];
        }
        // No default for control found
        // Maybe a color control 
        return CustomizerController::GetColorScheme()->MaybeGetDefault($control);
    }
}
