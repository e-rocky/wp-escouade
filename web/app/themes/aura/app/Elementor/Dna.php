<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Dna extends Widget_Base
{
    public function get_name()
    {
        return 'aura-dna';
    }

    public function get_title()
    {
        return __('Notre ADN — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-inner-section';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'adn', 'dna', 'valeurs', 'cartes'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('header', ['label' => __('En-tête', 'sage')]);
        $this->add_control('heading', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Notre <em>ADN</em>', 'sage'),
            'description' => __('La balise <em> met une partie du titre en évidence.', 'sage'),
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('heading_tag', [
            'label' => __('Balise du titre', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => array_combine(['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], ['H1', 'H2', 'H3', 'H4', 'H5', 'H6']),
        ]);
        $this->add_control('intro', [
            'label' => __('Introduction', 'sage'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => '<p>Notre motivation est de faire progresser nos équipes autant que nos clients.<br>Le développement des compétences est un levier clé de performance.</p>',
            'dynamic' => ['active' => true],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('cards_section', ['label' => __('Cartes', 'sage')]);
        $card = new Repeater();
        $card->add_control('image', [
            'label' => __('Image', 'sage'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => ['active' => true],
        ]);
        $card->add_control('title', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Notre valeur', 'sage'),
            'label_block' => true,
            'dynamic' => ['active' => true],
        ]);
        $card->add_control('description', [
            'label' => __('Description', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('cards', [
            'label' => __('Nos valeurs', 'sage'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $card->get_controls(),
            'title_field' => '{{{ title }}}',
            'default' => [
                [
                    'title' => __('Engagé', 'sage'),
                    'description' => __('Au service des clients et des coéquipiers', 'sage'),
                    'image' => ['url' => get_theme_file_uri('resources/images/content/dna-target.png')],
                ],
                [
                    'title' => __('Dynamique', 'sage'),
                    'description' => __('Innovations portées par l’énergie collective', 'sage'),
                    'image' => ['url' => get_theme_file_uri('resources/images/content/dna-rocket.png')],
                ],
                [
                    'title' => __('Solidaire', 'sage'),
                    'description' => __('Soutien mutuel et esprit d’équipe', 'sage'),
                    'image' => ['url' => get_theme_file_uri('resources/images/content/dna-chain.png')],
                ],
            ],
        ]);
        $this->add_control('card_heading_tag', [
            'label' => __('Balise des titres des cartes', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h3',
            'options' => array_combine(['h2', 'h3', 'h4', 'h5', 'h6'], ['H2', 'H3', 'H4', 'H5', 'H6']),
        ]);
        $this->end_controls_section();

        $this->start_controls_section('layout', ['label' => __('Mise en page', 'sage')]);
        $this->add_control('container_classes', [
            'label' => __('Classes CSS du conteneur', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => '',
            'description' => __('Classes supplémentaires séparées par des espaces. Les styles doivent déjà exister dans le CSS compilé.', 'sage'),
        ]);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $heading = in_array($settings['heading_tag'] ?? '', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? $settings['heading_tag'] : 'h2';
        $card_heading = in_array($settings['card_heading_tag'] ?? '', ['h2', 'h3', 'h4', 'h5', 'h6'], true) ? $settings['card_heading_tag'] : 'h3';
        ?>
        <div class="block dna-block">
            <div class="dna-block__content uk-container flex flex-col gap-[64px] <?php echo esc_attr($settings['container_classes'] ?? ''); ?>">
                <?php if (! empty($settings['heading']) || ! empty($settings['intro'])) : ?>
                    <div class="dna-block__header text-center">
                        <?php if (! empty($settings['heading'])) : ?>
                            <<?php echo $heading; ?> class="title title--h2 c--2 rte--em-c-5 mb-0 text-[48px]"><?php echo wp_kses($settings['heading'], ['em' => [], 'strong' => [], 'br' => []]); ?></<?php echo $heading; ?>>
                        <?php endif; ?>
                        <?php echo wp_kses_post($settings['intro'] ?? ''); ?>
                    </div>
                <?php endif; ?>
                <?php if (! empty($settings['cards'])) : ?>
                    <div class="dna-block__body grid grid-cols-1 md:grid-cols-3 gap-[32px]">
                        <?php foreach ($settings['cards'] as $index => $card) : ?>
                            <?php
                            $title_key = $this->get_repeater_setting_key('title', 'cards', $index);
                            $description_key = $this->get_repeater_setting_key('description', 'cards', $index);
                            $this->add_inline_editing_attributes($title_key, 'none');
                            $this->add_inline_editing_attributes($description_key, 'none');
                            $is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
                            ?>
                            <div class="card dna-card flex-1 h-full">
                                <div class="dna-card__content">
                                    <?php if (! empty($card['image']['url'])) : ?>
                                        <div class="dna-card__header">
                                            <figure class="img-container">
                                                <?php if (! empty($card['image']['id'])) : ?>
                                                    <?php echo wp_get_attachment_image((int) $card['image']['id'], 'full'); ?>
                                                <?php else : ?>
                                                    <img decoding="async" src="<?php echo esc_url($card['image']['url']); ?>" alt="<?php echo esc_attr($card['image']['alt'] ?? ''); ?>">
                                                <?php endif; ?>
                                            </figure>
                                        </div>
                                    <?php endif; ?>
                                    <div class="dna-card__body">
                                        <?php if (! empty($card['title']) || $is_edit_mode) : ?>
                                            <<?php echo $card_heading; ?> class="title title--h3 c--2-5"><span <?php $this->print_render_attribute_string($title_key); ?>><?php echo esc_html($card['title'] ?? ''); ?></span></<?php echo $card_heading; ?>>
                                        <?php endif; ?>
                                        <?php if (! empty($card['description']) || $is_edit_mode) : ?>
                                            <p <?php $this->print_render_attribute_string($description_key); ?>><?php echo nl2br(esc_html($card['description'] ?? '')); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
