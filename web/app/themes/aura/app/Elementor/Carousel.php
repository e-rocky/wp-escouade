<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Includes\Elements\Container;

class Carousel extends Container
{
    public static function get_type()
    {
        return 'aura-carousel';
    }

    public function get_name()
    {
        return 'aura-carousel';
    }

    public function get_title()
    {
        return __('Carousel — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-slider-push';
    }

    public function get_keywords()
    {
        return array_merge(parent::get_keywords(), ['aura', 'carousel', 'carrousel', 'slider', 'diapositives']);
    }

    protected function register_controls()
    {
        parent::register_controls();
        $this->remove_control('content_width');

        $this->register_slides_controls();
        $this->register_settings_controls();
        $this->register_navigation_controls();
    }

    private function register_slides_controls(): void
    {
        $this->start_controls_section('section_carousel_slides', [
            'label' => __('Diapositives', 'sage'),
            'tab' => Controls_Manager::TAB_LAYOUT,
        ]);

        $this->add_control('carousel_name', [
            'label' => __('Nom du carrousel', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Carrousel', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('carousel_elements', [
            'label' => __('Éléments du carrousel', 'sage'),
            'type' => Controls_Manager::RAW_HTML,
            'raw' => __('Les widgets enfants directs sont automatiquement utilisés comme diapositives. Le widget « Carte technologies — Aura » peut être ajouté depuis la fenêtre Structure.', 'sage'),
            'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
        ]);

        $this->add_responsive_control('slides_to_show', [
            'label' => __('Diapositives à l’affichage', 'sage'),
            'type' => Controls_Manager::SELECT,
            'options' => $this->get_slides_count_options(),
            'default' => '3',
            'device_args' => [
                'tablet' => ['default' => '2'],
                'mobile' => ['default' => '1'],
            ],
        ]);

        $this->add_control('slides_to_scroll', [
            'label' => __('Diapositives au défilement', 'sage'),
            'type' => Controls_Manager::NUMBER,
            'default' => 1,
            'min' => 1,
            'max' => 6,
            'step' => 1,
        ]);

        $this->add_control('equal_height', $this->switcher(__('Hauteur égale', 'sage'), 'yes', [
            'selectors' => [
                '{{WRAPPER}} > .aura-carousel__items' => 'align-items: stretch;',
                '{{WRAPPER}} > .aura-carousel__items > *' => 'height: auto; align-self: stretch;',
            ],
        ]));

        $this->end_controls_section();
    }

    private function register_settings_controls(): void
    {
        $this->start_controls_section('section_carousel_settings', [
            'label' => __('Réglages', 'sage'),
            'tab' => Controls_Manager::TAB_LAYOUT,
        ]);

        $this->add_control('autoplay', $this->switcher(__('Lecture automatique', 'sage'), 'yes'));

        $this->add_control('autoplay_interval', [
            'label' => __('Vitesse de défilement', 'sage'),
            'type' => Controls_Manager::NUMBER,
            'default' => 5000,
            'min' => 500,
            'max' => 30000,
            'step' => 100,
            'description' => __('Délai entre deux défilements, en millisecondes.', 'sage'),
            'condition' => ['autoplay' => 'yes'],
        ]);

        $this->add_control('pause_on_hover', $this->switcher(__('Pause au survol', 'sage'), 'yes'));
        $this->add_control('pause_on_interaction', $this->switcher(__('Pause sur interaction', 'sage'), 'yes'));
        $this->add_control('infinite', $this->switcher(__('Défilement infini', 'sage'), 'yes'));

        $this->add_control('transition_duration', [
            'label' => __('Durée de transition', 'sage'),
            'type' => Controls_Manager::NUMBER,
            'default' => 500,
            'min' => 100,
            'max' => 5000,
            'step' => 50,
            'description' => __('Durée cible en millisecondes.', 'sage'),
        ]);

        $this->add_control('direction', [
            'label' => __('Direction', 'sage'),
            'type' => Controls_Manager::CHOOSE,
            'default' => 'ltr',
            'options' => [
                'ltr' => ['title' => __('Gauche vers droite', 'sage'), 'icon' => 'eicon-arrow-right'],
                'rtl' => ['title' => __('Droite vers gauche', 'sage'), 'icon' => 'eicon-arrow-left'],
            ],
            'toggle' => false,
        ]);

        $this->end_controls_section();
    }

    private function register_navigation_controls(): void
    {
        $this->start_controls_section('section_carousel_navigation', [
            'label' => __('Navigation', 'sage'),
            'tab' => Controls_Manager::TAB_LAYOUT,
        ]);

        $this->add_control('show_arrows', $this->switcher(__('Flèches', 'sage'), 'yes'));
        $this->add_control('show_pagination', $this->switcher(__('Pagination', 'sage'), 'yes'));

        $this->end_controls_section();
    }

    protected function add_render_attributes()
    {
        parent::add_render_attributes();
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('_wrapper', [
            'class' => ['aura-carousel', 'uk-slider'],
            'data-uk-slider' => $this->get_slider_options($settings),
            'data-slides-to-scroll' => $this->bounded_integer($settings['slides_to_scroll'] ?? 1, 1, 6),
            'data-pause-on-interaction' => ($settings['pause_on_interaction'] ?? '') === 'yes' ? 'true' : 'false',
            'data-transition-duration' => $this->bounded_integer($settings['transition_duration'] ?? 500, 100, 5000),
            'dir' => ($settings['direction'] ?? '') === 'rtl' ? 'rtl' : 'ltr',
            'role' => 'region',
            'aria-roledescription' => 'carousel',
            'aria-label' => $settings['carousel_name'] ?? __('Carrousel', 'sage'),
        ]);
    }

    protected function is_boxed_container(array $settings)
    {
        return false;
    }

    protected function content_template()
    {
        ?>
        <#
        if (settings.background_video_link) {
            let videoAttributes = 'autoplay muted playsinline';
            if (!settings.background_play_once) {
                videoAttributes += ' loop';
            }
            view.addRenderAttribute('background-video-container', {'class': 'elementor-background-video-container'});
            if (!settings.background_play_on_mobile) {
                view.addRenderAttribute('background-video-container', 'class', 'elementor-hidden-mobile');
            }
        #>
            <div {{{ view.getRenderAttributeString('background-video-container') }}}>
                <div class="elementor-background-video-embed" role="presentation"></div>
                <video class="elementor-background-video-hosted" role="presentation" {{ videoAttributes }}></video>
            </div>
        <# } #>
        <div class="elementor-shape elementor-shape-top" aria-hidden="true"></div>
        <div class="elementor-shape elementor-shape-bottom" aria-hidden="true"></div>
        <div class="aura-carousel__items uk-slider-items" aria-live="polite"></div>
        <# if (settings.show_arrows === 'yes') { #>
            <button class="aura-carousel__arrow aura-carousel__arrow--previous uk-position-center-left uk-position-small" type="button" data-carousel-previous aria-label="<?php esc_attr_e('Diapositive précédente', 'sage'); ?>"><span data-uk-slidenav-previous></span></button>
            <button class="aura-carousel__arrow aura-carousel__arrow--next uk-position-center-right uk-position-small" type="button" data-carousel-next aria-label="<?php esc_attr_e('Diapositive suivante', 'sage'); ?>"><span data-uk-slidenav-next></span></button>
        <# } #>
        <# if (settings.show_pagination === 'yes') { #>
            <ul class="aura-carousel__pagination uk-slider-nav uk-dotnav uk-flex-center uk-margin"></ul>
        <# } #>
        <?php
    }

    public function before_render()
    {
        parent::before_render();
        $settings = $this->get_settings_for_display();
        $classes = array_merge(['aura-carousel__items', 'uk-slider-items'], $this->get_width_classes($settings));
        ?>
        <div class="<?php echo esc_attr(implode(' ', $classes)); ?>" aria-live="polite">
        <?php
    }

    public function after_render()
    {
        $settings = $this->get_settings_for_display();
        ?>
        </div>
        <?php if (($settings['show_arrows'] ?? '') === 'yes') : ?>
            <button class="aura-carousel__arrow aura-carousel__arrow--previous uk-position-center-left uk-position-small" type="button" data-carousel-previous aria-label="<?php esc_attr_e('Diapositive précédente', 'sage'); ?>"><span data-uk-slidenav-previous></span></button>
            <button class="aura-carousel__arrow aura-carousel__arrow--next uk-position-center-right uk-position-small" type="button" data-carousel-next aria-label="<?php esc_attr_e('Diapositive suivante', 'sage'); ?>"><span data-uk-slidenav-next></span></button>
        <?php endif; ?>
        <?php if (($settings['show_pagination'] ?? '') === 'yes') : ?>
            <ul class="aura-carousel__pagination uk-slider-nav uk-dotnav uk-flex-center uk-margin" aria-label="<?php esc_attr_e('Pagination du carrousel', 'sage'); ?>"></ul>
        <?php endif; ?>
        <?php
        parent::after_render();
    }

    private function switcher(string $label, string $default = '', array $extra = []): array
    {
        return array_merge([
            'label' => $label,
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Oui', 'sage'),
            'label_off' => __('Non', 'sage'),
            'return_value' => 'yes',
            'default' => $default,
        ], $extra);
    }

    private function get_slides_count_options(): array
    {
        return ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6'];
    }

    private function get_width_classes(array $settings): array
    {
        $mobile = $this->slides_count($settings['slides_to_show_mobile'] ?? '1', '1');
        $tablet = $this->slides_count($settings['slides_to_show_tablet'] ?? '2', '2');
        $desktop = $this->slides_count($settings['slides_to_show'] ?? '3', '3');

        return [
            'uk-child-width-1-' . $mobile,
            'uk-child-width-1-' . $tablet . '@s',
            'uk-child-width-1-' . $desktop . '@l',
        ];
    }

    private function slides_count($value, string $fallback): string
    {
        $value = (string) $value;
        return isset($this->get_slides_count_options()[$value]) ? $value : $fallback;
    }

    private function bounded_integer($value, int $minimum, int $maximum): int
    {
        return max($minimum, min($maximum, (int) $value));
    }

    private function get_slider_options(array $settings): string
    {
        $options = [
            'autoplay' => ($settings['autoplay'] ?? '') === 'yes' ? 'true' : 'false',
            'autoplay-interval' => $this->bounded_integer($settings['autoplay_interval'] ?? 5000, 500, 30000),
            'pause-on-hover' => ($settings['pause_on_hover'] ?? '') === 'yes' ? 'true' : 'false',
            'finite' => ($settings['infinite'] ?? '') === 'yes' ? 'false' : 'true',
        ];

        return implode('; ', array_map(
            static fn ($key, $value) => $key . ': ' . $value,
            array_keys($options),
            $options
        ));
    }
}
