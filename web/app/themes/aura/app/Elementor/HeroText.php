<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class HeroText extends Widget_Base
{
    public function get_name()
    {
        return 'aura-hero-text';
    }

    public function get_title()
    {
        return __('Hero texte — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-heading';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'hero', 'titre', 'surtitre', 'accueil'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content', [
            'label' => __('Contenu', 'sage'),
        ]);

        $this->add_control('eyebrow', [
            'label' => __('Surtitre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Une <strong>Escouade</strong>, c’est <em>plus qu’une équipe</em> :', 'sage'),
            'description' => __('Les balises <strong> et <em> sont autorisées.', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('title', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('c’est une aventure humaine', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('heading_tag', [
            'label' => __('Niveau du titre', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h1',
            'options' => [
                'h1' => 'H1',
                'h2' => 'H2',
            ],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('button', [
            'label' => __('Bouton', 'sage'),
        ]);

        $this->add_control('button_text', [
            'label' => __('Libellé', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Rejoindre l’aventure', 'sage'),
            'description' => __('Laissez le champ vide pour masquer le bouton.', 'sage'),
            'label_block' => true,
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('button_link', [
            'label' => __('Lien', 'sage'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '#'],
            'dynamic' => ['active' => true],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
        $heading_tag = in_array($settings['heading_tag'] ?? '', ['h1', 'h2'], true)
            ? $settings['heading_tag']
            : 'h1';

        $this->add_render_attribute('eyebrow', 'class', 'block');
        $this->add_inline_editing_attributes('eyebrow', 'basic');
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_inline_editing_attributes('button_text', 'none');

        if (! empty($settings['button_link']['url'])) {
            $this->add_link_attributes('button', $settings['button_link']);
        }

        $this->add_render_attribute('button', 'class', ['btn', 'c--4', 'bgc--5-2', 'btn--lg', 'btn-shadow-lg']);
        $this->add_render_attribute('button', 'title', $settings['button_text'] ?? '');
        ?>
        <div class="block hero-text-block">
            <div class="hero-text-block__content min-h-[60vh] gap-[70px] uk-container" uk-scrollspy="cls:uk-animation-fade" data-uk-parallax="y: 50vh; opacity: 1, 0; start: 0; end: 10vh; blur: 0, 0, 20px; scale: 1, 0.5;">
                <div class="hero-text-block__body">
                    <<?php echo $heading_tag; ?> class="title title--h1 rte rte--em-c-5">
                        <?php if (! empty($settings['eyebrow']) || $is_edit_mode) : ?>
                            <small <?php $this->print_render_attribute_string('eyebrow'); ?>><?php echo wp_kses($settings['eyebrow'] ?? '', ['strong' => [], 'em' => [], 'br' => []]); ?></small>
                        <?php endif; ?>
                        <?php if (! empty($settings['title']) || $is_edit_mode) : ?>
                            <span <?php $this->print_render_attribute_string('title'); ?>><?php echo esc_html($settings['title'] ?? ''); ?></span>
                        <?php endif; ?>
                    </<?php echo $heading_tag; ?>>
                </div>

                <?php if (! empty($settings['button_text'])) : ?>
                    <div class="hero-text-block__footer flex justify-center">
                        <a <?php $this->print_render_attribute_string('button'); ?>><span <?php $this->print_render_attribute_string('button_text'); ?>><?php echo esc_html($settings['button_text']); ?></span> <i class="es-icon-chevron-right" aria-hidden="true"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
