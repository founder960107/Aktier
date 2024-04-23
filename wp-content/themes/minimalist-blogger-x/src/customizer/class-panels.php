<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerItem;
use SuperbThemesCustomizer\Utils\CustomizerType;

class CustomizerPanels
{
    const LAYOUT = 'superbthemes_customizer_panel_LAYOUT';
    const WOOCOMMERCE = 'superbthemes_customizer_panel_WOOCOMMERCE';
    const NAVIGATION = 'superbthemes_customizer_panel_NAVIGATION';
    const HEADER = 'superbthemes_customizer_panel_HEADER';

    const SHOULD_REFOCUS_TO_PANEL = array();

    public function __construct()
    {
        new CustomizerItem(self::LAYOUT, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Layout', 'minimalist-blogger-x'),
            "description" => __('Layout Customization', 'minimalist-blogger-x')
        ));
        new CustomizerItem(self::WOOCOMMERCE, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('WooCommerce', 'minimalist-blogger-x'),
            "description" => __('WooCommerce Customization', 'minimalist-blogger-x')
        ));
        new CustomizerItem(self::NAVIGATION, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Navigation', 'minimalist-blogger-x'),
            "description" => __('Navigation Customization', 'minimalist-blogger-x')
        ));
        new CustomizerItem(self::HEADER, array(
            "type" => CustomizerType::PANEL,
            "label" =>  __('Header', 'minimalist-blogger-x'),
            "description" => __('Header Customization', 'minimalist-blogger-x')
        ));
    }
}
