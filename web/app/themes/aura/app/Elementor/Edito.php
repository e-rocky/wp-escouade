<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class Edito extends Widget_Base
{
    public function get_name()
    {
        return 'aura-edito';
    }
    public function get_title()
    {
        return __('Édito — Aura', 'sage');
    }
    public function get_icon()
    {
        return 'eicon-image-box';
    }
    public function get_categories()
    {
        return ['general'];
    }
    public function get_keywords()
    {
        return ['aura', 'édito', 'carte', 'image', 'carrière'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content', ['label' => __('Contenu', 'sage')]);
        $this->add_control('image', [
            'label' => __('Image', 'sage'),
            'type' => Controls_Manager::MEDIA,
            'default' => ['url' => get_theme_file_uri('resources/images/content/edito-img-3.png')],
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('badge', [
            'label' => __('Badge', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Un climat favorisant la motivation', 'sage'),
            'label_block' => true,
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('title', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Des conditions qui valorisent l’engagement et le potentiel', 'sage'),
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('title_tag', [
            'label' => __('Balise du titre', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => array_combine(['h2', 'h3', 'h4', 'h5', 'h6'], ['H2', 'H3', 'H4', 'H5', 'H6']),
        ]);
        $this->add_control('text', [
            'label' => __('Texte', 'sage'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => '<p>Nous croyons que le potentiel s’exprime pleinement lorsque les conditions sont réunies pour s’investir durablement.</p><p>Escouade offre un accompagnement personnalisé, des projets stimulants et une attention portée au bien-être professionnel.</p><p>Cet équilibre favorise l’engagement et la performance sur le long terme.</p>',
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('button_text', [
            'label' => __('Libellé du bouton', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Déposer ma candidature', 'sage'),
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

        $this->start_controls_section('layout', ['label' => __('Mise en page', 'sage')]);
        $this->add_control('image_position', [
            'label' => __('Position de l’image', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'left',
            'options' => ['left' => __('Gauche', 'sage'), 'right' => __('Droite', 'sage')],
        ]);
        $this->add_control('theme', [
            'label' => __('Variante de couleur', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'green',
            'options' => [
                'pink_blue' => __('Rose + Bleu', 'sage'),
                'blue_green' => __('Bleu + Vert', 'sage'),
                'blue_pink' => __('Bleu + rose', 'sage'),
            ],
        ]);
        $this->add_control('transparent_background', [
            'label' => __('Background transparent', 'sage'),
            'type' => Controls_Manager::SWITCHER,
            'label_on' => __('Oui', 'sage'),
            'label_off' => __('Non', 'sage'),
            'return_value' => 'yes',
            'default' => '',
        ]);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
        $title_tag = in_array($settings['title_tag'] ?? '', ['h2', 'h3', 'h4', 'h5', 'h6'], true)
            ? $settings['title_tag']
            : 'h2';
        $themes = [
            'pink_blue' => ['title' => 'c--5-2', 'button' => 'bgc--2'],
            'blue_green' => ['title' => 'c--2-1a', 'button' => 'bgc--1a'],
            'blue_pink' => ['title' => 'c--2-5', 'button' => 'bgc--5'],
        ];
        $theme = $themes[$settings['theme'] ?? ''] ?? $themes['blue_pink'];
        $reverse_class = ($settings['image_position'] ?? 'left') === 'right' ? ' md:flex-row-reverse' : '';
        $button_url = $settings['button_link']['url'] ?? '';
        $has_badge = trim((string) ($settings['badge'] ?? '')) !== '';

        $this->add_render_attribute('badge', 'class', 'tag');
        $this->add_inline_editing_attributes('badge', 'none');
        $this->add_render_attribute('title', 'class', ['title', 'title--h2', $theme['title']]);
        $this->add_inline_editing_attributes('title', 'basic');
        $this->add_render_attribute('text', 'class', 'text');
        $this->add_inline_editing_attributes('text', 'advanced');
        $this->add_inline_editing_attributes('button_text', 'none');

        if ($button_url !== '') {
            $this->add_link_attributes('button', $settings['button_link']);
        }
        $this->add_render_attribute('button', 'class', ['btn', 'c--4', $theme['button'], 'btn-shadow-sm']);
        $this->add_render_attribute('button', 'title', $settings['button_text'] ?? '');
        $this->add_render_attribute('card', 'class', ['block', 'edito-card']);
        if (($settings['transparent_background'] ?? '') !== 'yes') {
            $this->add_render_attribute('card', 'class', ['bgc', 'bgc--4']);
        }
?>
        <div <?php $this->print_render_attribute_string('card'); ?>>
            <div class="edito-card__content flex flex-col md:flex-row<?php echo esc_attr($reverse_class); ?>">
                <?php if (! empty($settings['image']['url'])) : ?>
                    <div class="edito-card__header">
                        <figure class="img-container">
                            <?php if (! empty($settings['image']['id'])) : ?>
                                <?php echo wp_get_attachment_image((int) $settings['image']['id'], 'full'); ?>
                            <?php else : ?>
                                <img src="<?php echo esc_url($settings['image']['url']); ?>" alt="<?php echo esc_attr($settings['image']['alt'] ?? ''); ?>">
                            <?php endif; ?>
                        </figure>
                    </div>
                <?php endif; ?>
                <div class="edito-card__body">
                    <div class="content">
                        <?php if ($has_badge) : ?>
                            <ul class="taglist mb-0 flex flex-wrap gap-[10px] mb-[20px]">
                                <li><span <?php $this->print_render_attribute_string('badge'); ?>><?php echo esc_html($settings['badge']); ?></span></li>
                            </ul>
                        <?php endif; ?>
                        <?php if (! empty($settings['title']) || $is_edit_mode) : ?>
                            <<?php echo $title_tag; ?> <?php $this->print_render_attribute_string('title'); ?>><?php echo esc_html($settings['title'] ?? ''); ?></<?php echo $title_tag; ?>>
                        <?php endif; ?>
                        <div <?php $this->print_render_attribute_string('text'); ?>><?php echo wp_kses_post($settings['text'] ?? ''); ?></div>
                        <?php if (! empty($settings['button_text'])) : ?>
                            <div class="actions">
                                <a <?php $this->print_render_attribute_string('button'); ?>><span <?php $this->print_render_attribute_string('button_text'); ?>><?php echo esc_html($settings['button_text'] ?? ''); ?></span><i class="es-icon-chevron-right"></i></a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
