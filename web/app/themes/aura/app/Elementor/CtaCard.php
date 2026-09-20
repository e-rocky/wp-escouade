<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class CtaCard extends Widget_Base
{
    public function get_name()
    {
        return 'aura-cta-card';
    }

    public function get_title()
    {
        return __('Carte CTA — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-call-to-action';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'cta', 'carte', 'appel à l’action', 'candidature'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content', [
            'label' => __('Contenu', 'sage'),
        ]);

        $this->add_control('title', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Osez faire le premier pas', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('title_tag', [
            'label' => __('Balise du titre', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => array_combine(
                ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'],
                ['H1', 'H2', 'H3', 'H4', 'H5', 'H6']
            ),
        ]);

        $this->add_control('text', [
            'label' => __('Texte', 'sage'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => '<p>Vous avez du potentiel, même sans offre publiée. Présentez votre profil et créez votre opportunité.</p>',
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('button_text', [
            'label' => __('Libellé du bouton', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Candidature spontanée', 'sage'),
            'label_block' => true,
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('button_link', [
            'label' => __('Lien du bouton', 'sage'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => '#'],
            'dynamic' => ['active' => true],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('images', [
            'label' => __('Images', 'sage'),
        ]);

        $this->add_control('image', [
            'label' => __('Image principale', 'sage'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => get_theme_file_uri('resources/images/content/intro-img-1.png'),
            ],
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('background_image', [
            'label' => __('Image d’arrière-plan', 'sage'),
            'type' => Controls_Manager::MEDIA,
            'default' => [
                'url' => get_theme_file_uri('resources/images/design/bg-6.png'),
            ],
            'dynamic' => ['active' => true],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
        $title_tag = in_array($settings['title_tag'] ?? '', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true)
            ? $settings['title_tag']
            : 'h2';

        $this->add_render_attribute('title', 'class', ['title', 'title--h1', 'c--4']);
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('text', 'class', 'text');
        $this->add_inline_editing_attributes('text', 'advanced');
        $this->add_inline_editing_attributes('button_text', 'none');

        if (! empty($settings['button_link']['url'])) {
            $this->add_link_attributes('button', $settings['button_link']);
        }

        $this->add_render_attribute('button', 'class', ['btn', 'btn--lg', 'c--4', 'bgc--5', 'btn-shadow-sm']);
        $this->add_render_attribute('button', 'title', $settings['button_text'] ?? '');
        ?>
        <div class="card cta-card">
            <?php if (! empty($settings['background_image']['url'])) : ?>
                <div class="cta-card__background scale-x-[-1]" aria-hidden="true">
                    <?php $this->render_image($settings['background_image'], true); ?>
                </div>
            <?php endif; ?>

            <div class="cta-card__content flex flex-col-reverse md:flex-row-reverse">
                <?php if (! empty($settings['image']['url'])) : ?>
                    <div class="cta-card__header">
                        <figure class="img-container">
                            <?php $this->render_image($settings['image']); ?>
                            <?php $this->render_image($settings['image'], true); ?>
                        </figure>
                    </div>
                <?php endif; ?>

                <div class="cta-card__body">
                    <div class="content">
                        <?php if (! empty($settings['title']) || $is_edit_mode) : ?>
                            <<?php echo $title_tag; ?> <?php $this->print_render_attribute_string('title'); ?>><?php echo esc_html($settings['title'] ?? ''); ?></<?php echo $title_tag; ?>>
                        <?php endif; ?>

                        <?php if (! empty($settings['text']) || $is_edit_mode) : ?>
                            <div <?php $this->print_render_attribute_string('text'); ?>><?php echo wp_kses_post($settings['text'] ?? ''); ?></div>
                        <?php endif; ?>

                        <?php if (! empty($settings['button_text'])) : ?>
                            <div class="actions flex flex-col sm:flex-row md:flex-wrap items-stretch gap-[20px]">
                                <a <?php $this->print_render_attribute_string('button'); ?>><span <?php $this->print_render_attribute_string('button_text'); ?>><?php echo esc_html($settings['button_text']); ?></span><i class="es-icon-chevron-right" aria-hidden="true"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    private function render_image(array $image, bool $decorative = false): void
    {
        if (! empty($image['id'])) {
            echo wp_get_attachment_image(
                (int) $image['id'],
                'full',
                false,
                $decorative ? ['alt' => '', 'aria-hidden' => 'true'] : []
            );
            return;
        }
        ?>
        <img src="<?php echo esc_url($image['url'] ?? ''); ?>" alt="<?php echo $decorative ? '' : esc_attr($image['alt'] ?? ''); ?>"<?php echo $decorative ? ' aria-hidden="true"' : ''; ?>>
        <?php
    }
}
