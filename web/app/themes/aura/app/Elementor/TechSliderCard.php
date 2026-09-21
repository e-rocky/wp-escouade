<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class TechSliderCard extends Widget_Base
{
    public function get_name()
    {
        return 'aura-tech-slider-card';
    }

    public function get_title()
    {
        return __('Carte technologies — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-logo';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'technologies', 'techno', 'slide', 'carousel', 'logos'];
    }

    public function has_widget_inner_wrapper(): bool
    {
        return false;
    }

    protected function add_render_attributes()
    {
        parent::add_render_attributes();
        $this->add_render_attribute('_wrapper', 'class', [
            'card',
            'tech-slider-card',
            'tech-slider-card__content',
        ]);
    }

    protected function register_controls()
    {
        $this->start_controls_section('content', [
            'label' => __('Contenu', 'sage'),
        ]);

        $this->add_control('title', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Les technologies <em>Frontend</em>', 'sage'),
            'description' => __('Utilisez <em> pour mettre une partie du titre en évidence.', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('subtitle', [
            'label' => __('Sous-titre', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('au cœur de nos réalisations', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('technologies_section', [
            'label' => __('Technologies', 'sage'),
        ]);

        $technology = new Repeater();
        $technology->add_control('logo', [
            'label' => __('Logo', 'sage'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => ['active' => true],
        ]);
        $technology->add_control('name', [
            'label' => __('Nom', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Technologie', 'sage'),
            'label_block' => true,
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('technologies', [
            'label' => __('Liste des technologies', 'sage'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $technology->get_controls(),
            'title_field' => '{{{ name }}}',
            'default' => $this->get_default_technologies(),
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();

        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_inline_editing_attributes('subtitle', 'none');
        ?>
        <div class="tech-slider-card__header flex flex-col md:flex-row justify-between px-[40px] md:items-center">
            <h2 class="title title--h2 rte rte--em-c-5 c--2">
                <?php if (! empty($settings['title']) || $is_edit_mode) : ?>
                    <span <?php $this->print_render_attribute_string('title'); ?>><?php echo wp_kses($settings['title'] ?? '', ['em' => [], 'strong' => [], 'br' => []]); ?></span>
                <?php endif; ?>
                <?php if (! empty($settings['subtitle']) || $is_edit_mode) : ?>
                    <small <?php $this->print_render_attribute_string('subtitle'); ?>><?php echo esc_html($settings['subtitle'] ?? ''); ?></small>
                <?php endif; ?>
            </h2>

            <ul class="nav flex gap-[10px] m-0 justify-start">
                <li>
                    <button class="btn c--4 bgc--1-2 btn-shadow-sm px-0 size-[48px] flex items-center justify-center" type="button" data-uk-slider-item="previous" aria-label="<?php esc_attr_e('Slide précédente', 'sage'); ?>">
                        <i class="es-icon-chevron-left" aria-hidden="true"></i>
                    </button>
                </li>
                <li>
                    <button class="btn c--4 bgc--1-2 btn-shadow-sm px-0 size-[48px] flex items-center justify-center" type="button" data-uk-slider-item="next" aria-label="<?php esc_attr_e('Slide suivante', 'sage'); ?>">
                        <i class="es-icon-chevron-right" aria-hidden="true"></i>
                    </button>
                </li>
            </ul>
        </div>

        <div class="tech-slider-card__body md:px-[10px] uk-child-width-1-1">
            <ul class="tech-list gap-[10px] gap-y-[20px] md:gap-y-[40px] lg:gap-y-[50px]">
                <?php foreach (($settings['technologies'] ?? []) as $index => $technology) : ?>
                    <?php
                    $name_key = $this->get_repeater_setting_key('name', 'technologies', $index);
                    $this->add_inline_editing_attributes($name_key, 'none');
                    ?>
                    <li class="tech-item">
                        <figure>
                            <?php if (! empty($technology['logo']['url'])) : ?>
                                <div class="img-container">
                                    <?php if (! empty($technology['logo']['id'])) : ?>
                                        <?php echo wp_get_attachment_image((int) $technology['logo']['id'], 'full'); ?>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url($technology['logo']['url']); ?>" alt="<?php echo esc_attr($technology['logo']['alt'] ?? ($technology['name'] ?? '')); ?>">
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                            <figcaption <?php $this->print_render_attribute_string($name_key); ?>><?php echo esc_html($technology['name'] ?? ''); ?></figcaption>
                        </figure>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }

    private function get_default_technologies(): array
    {
        $technologies = [
            'PHP' => 'tech-logo-php.png',
            '.NET' => 'tech-logo-asp_.net.png',
            'Java' => 'tech-logo-java.png',
            'Node JS' => 'tech-logo-nodejs.png',
            'Symfony' => 'tech-logo-symfony.png',
            'Laravel' => 'tech-logo-laravel.png',
            'Zend' => 'tech-logo-zend-framework.png',
            'Azure' => 'tech-logo-azure.png',
        ];

        return array_map(
            static fn ($name, $filename) => [
                'name' => $name,
                'logo' => ['url' => get_theme_file_uri('resources/images/content/' . $filename)],
            ],
            array_keys($technologies),
            array_values($technologies)
        );
    }
}
