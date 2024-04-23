<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;
use SuperbThemesCustomizer\CustomizerPanels;

class CustomizerSections
{
    const HEADER_METASLIDER = 'superbthemes_customizer_section_header_metaslider';
    const HEADER_DEFAULT = 'superbthemes_customizer_section_header_default';
    const GENERAL = 'superbthemes_customizer_section_general';
    const NAVIGATION = 'superbthemes_customizer_section_navigation';
    const WIDGETS = 'superbthemes_customizer_section_widgets';
    const BLOG = 'superbthemes_customizer_section_blog';
    const SINGLE = 'superbthemes_customizer_section_single';
    const SIDEBAR = 'superbthemes_customizer_section_sidebar';
    const FOOTER = 'superbthemes_customizer_section_footer';
    const PAGE_404 = 'superbthemes_customizer_section_404';
    const COPYRIGHT = 'superbthemes_customizer_section_copyright';
    const WOOCOMMERCE = 'superbthemes_customizer_section_woocommerce';
    const COLOR_SCHEME = 'superbthemes_customizer_section_color_scheme';
    const SHORTPIXEL = 'superbthemes_customizer_section_shortpixel';

    public function __construct()
    {
        new CustomizerItem(self::SHORTPIXEL, array(
            "type" => CustomizerType::SECTION,
            "label" =>  __('Image Optimization', 'minimalist-blogger-x'),
            "parents" => array(""),
            "priority" => 1
        ));

        new CustomizerItem(self::NAVIGATION, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Navigation', 'minimalist-blogger-x'),
            "description" => __('Customize the navigation.', 'minimalist-blogger-x'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));

        if (class_exists("MetaSliderPlugin") || class_exists("MetaSliderPro")) {
            new CustomizerItem(self::HEADER_METASLIDER, array(
                "type" => CustomizerType::SECTION,
                "label" => __('MetaSlider Header', 'minimalist-blogger-x'),
                "description" => __('MetaSlider Header requires the MetaSlider plugin. Using the MetaSlider header will replace the default theme header.', 'minimalist-blogger-x'),
                "parents" => array(CustomizerPanels::HEADER)
            ));
        }
        new CustomizerItem(self::HEADER_DEFAULT, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Header', 'minimalist-blogger-x'),
            "description" => __('Customize the default theme header. These settings do not apply if you\'re using the MetaSlider header.', 'minimalist-blogger-x'),
            "parents" => array(CustomizerPanels::HEADER)
        ));

        new CustomizerItem(self::BLOG, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Blog', 'minimalist-blogger-x'),
            "description" => __('Customize the blog feed.', 'minimalist-blogger-x'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
        new CustomizerItem(self::SINGLE, array(
            "type" => CustomizerType::SECTION,
            "label" => __('Posts / Pages', 'minimalist-blogger-x'),
            "description" => __('Customize Posts and Pages.', 'minimalist-blogger-x'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));

        new CustomizerItem(self::PAGE_404, array(
            "type" => CustomizerType::SECTION,
            "label" => __('404 Page', 'minimalist-blogger-x'),
            "description" => __('Customize the 404 Not found page.', 'minimalist-blogger-x'),
            "parents" => array(CustomizerPanels::LAYOUT)
        ));
    }
}
