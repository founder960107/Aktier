<?php

namespace SuperbThemesCustomizer\Modules\Navigation;

use SuperbThemesCustomizer\CustomizerControls;

class NavigationLayoutLarge
{
    private $SoMeButtonText = false;
    private $AuthorImage = false;
    private $AuthorName = false;
    private $AuthorTagline = false;
    private $HasAuthor = false;
    private $HasButton = false;

    public function __construct()
    {
        $this->AuthorImage = CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_AUTHOR_IMAGE);
        $this->AuthorName = CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_AUTHOR_NAME);
        $this->AuthorTagline = CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_AUTHOR_TAGLINE);
        $this->SoMeButtonText = CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_RIGHTALIGNED_BUTTON_TEXT);

        $this->HasAuthor = $this->AuthorImage || $this->AuthorName || $this->AuthorTagline;
        $this->HasButton = !empty($this->SoMeButtonText);

        $this->Render();
    }

    public function Render()
    {
?>
        <nav id="primary-site-navigation" class="primary-menu main-navigation clearfix">
            <?php new NavigationMobile(); ?>
            <div class="top-nav-wrapper">
                <div class="content-wrap navigation-layout-large">
                    <div class="header-content-container navigation-layout-large">
                        <?php if ($this->HasAuthor || $this->HasButton) : ?>
                            <div class="header-content-author-container">
                                <?php if (false !== $this->AuthorImage && !empty($this->AuthorImage)) : ?>
                                    <div class="header-author-container-img-wrapper" <?php echo 'style="background-image: url(' . esc_url(wp_get_attachment_image_url($this->AuthorImage)) . ')"'; ?>>
                                    </div>
                                <?php endif; ?>
                                <div class="header-author-container-text-wrapper">
                                    <span class="header-author-name"><?php echo esc_html($this->AuthorName); ?></span>
                                    <span class="header-author-tagline"><?php echo esc_html($this->AuthorTagline); ?></span>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="logo-container navigation-layout-large <?= $this->HasAuthor || $this->HasButton ? '' : 'header-has-no-side-elements'; ?>">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php endif; ?>
                            <a class="logofont site-title" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                            <?php if (CustomizerControls::GetSelectedOrDefault(CustomizerControls::SITE_IDENTITY_HIDE_TAGLINE) != '1') : ?>
                                <p class="logodescription site-description"><?php bloginfo('description'); ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ($this->HasAuthor || $this->HasButton) : ?>
                            <div class="header-content-some-container">
                                <?php
                                if ($this->HasButton) :
                                    $some_link = CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_RIGHTALIGNED_BUTTON_LINK);
                                    $some_link = $some_link === false || empty($some_link) ? "#" : $some_link;
                                    $some_link_target_blank = CustomizerControls::GetSelectedOrDefault(CustomizerControls::NAVIGATION_RIGHTALIGNED_BUTTON_TARGETBLANK);
                                ?>
                                    <a href="<?php echo esc_url($some_link); ?>" <?php if ($some_link_target_blank == '1') : ?>target="_blank" <?php endif; ?>><?php echo esc_html($this->SoMeButtonText); ?></a>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <?php new NavigationMenu(); ?>
                </div>
            </div>
        </nav>
<?php
    }
}
