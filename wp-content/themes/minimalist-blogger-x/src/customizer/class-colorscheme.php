<?php

namespace SuperbThemesCustomizer;

use SuperbThemesCustomizer\Utils\CustomizerColor;

use SuperbThemesCustomizer\CustomizerControls;

class CustomizerColorScheme
{
    private $Colors = array();

    public function __construct()
    {
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-foreground',
            __('Foreground', 'minimalist-blogger-x'),
            __('Sets the foreground colors for the theme.', 'minimalist-blogger-x'),
            '#000000'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-button-text-color',
            __('Button Text', 'minimalist-blogger-x'),
            __('Sets the button text colors for the theme.', 'minimalist-blogger-x'),
            '#ffffff'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-background',
            __('Base Background', 'minimalist-blogger-x'),
            __('Sets the base background colors for the theme.', 'minimalist-blogger-x'),
            '#ffffff'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-background-elements',
            __('Boxed Background Color', 'minimalist-blogger-x'),
            __('Sets the background color for boxed mode elements when the boxed mode general layout setting is enabled.', 'minimalist-blogger-x'),
            '#fafafa',
            false,
            array(
                CustomizerControls::GENERAL_LAYOUT_MODE => array(
                    CustomizerControls::GENERAL_BOXMODE
                )
            )
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-border-mode-elements',
            __('Border Mode Color', 'minimalist-blogger-x'),
            __('Sets the colors for the border mode elements when the border mode general layout setting is enabled.', 'minimalist-blogger-x'),
            '#000000',
            false,
            array(
                CustomizerControls::GENERAL_LAYOUT_MODE => array(
                    CustomizerControls::GENERAL_BORDERMODE
                )
            )
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-primary',
            __('Primary', 'minimalist-blogger-x'),
            __('Sets the primary colors for the theme.', 'minimalist-blogger-x'),
            '#000000',
            '#1d1d1d'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-secondary',
            __('Secondary', 'minimalist-blogger-x'),
            __('Sets the secondary colors for the theme.', 'minimalist-blogger-x'),
            '#000000',
            '#000000'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-light-2',
            __('Light Color', 'minimalist-blogger-x'),
            __('Sets the light colors for the theme.', 'minimalist-blogger-x'),
            '#efefef'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-dark-1',
            __('Dark Color', 'minimalist-blogger-x'),
            __('Sets the dark colors for the theme.', 'minimalist-blogger-x'),
            '#717171'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-input-background-color',
            __('Input Field Background', 'minimalist-blogger-x'),
            __('Sets the background colors for input fields for the theme.', 'minimalist-blogger-x'),
            '#ffffff'
        ));
        //
        $this->AddColor(new CustomizerColor(
            '--minimalist-blogger-x-select-color',
            __('Select Color', 'minimalist-blogger-x'),
            __('Sets the background colors for select element for the theme.', 'minimalist-blogger-x'),
            '#efefef'
        ));
        //
    }

    /* ****************************** */

    public function GetColors()
    {
        return $this->Colors;
    }

    private function AddColor($color)
    {
        $this->Colors[$color->GetId()] = $color;
        if (false !== $color->GetDarkId()) {
            $this->Colors[$color->GetDarkId()] = new CustomizerColor(
                $color->GetDarkId(),
                'Dark Variant',
                'Sets the dark variant for the color.',
                $color->GetDarkDefault(),
                false,
                $color->GetConditions()
            );
        }
    }

    public function MaybeGetDefault($control_id)
    {
        if (isset($this->Colors[$control_id])) {
            return $this->Colors[$control_id]->GetDefault();
        }
        return false;
    }

    public function GetColorIdsNoVariants()
    {
        return array_map(function ($item) {
            return $item->GetId();
        }, array_values(array_filter($this->Colors, function ($item) {
            return false === $item->GetDarkId();
        })));
    }

    public function GetColorIdsVariantsOnly()
    {
        return array_map(function ($item) {
            if (false !== $item->GetDarkId())
                return array('REGULAR' => $item->GetId(), 'DARK' => $item->GetDarkId());
        }, array_values(array_filter($this->Colors, function ($item) {
            return false !== $item->GetDarkId();
        })));
    }
}
