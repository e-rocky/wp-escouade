<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Numbers extends Widget_Base
{
    public function get_name()
    {
        return 'aura-numbers';
    }

    public function get_title()
    {
        return __('Chiffres clés — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-counter';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'chiffres', 'numbers', 'statistiques'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('header', ['label' => __('En-tête', 'sage')]);
        foreach (['heading' => ['Titre', 'Quelques chiffres clés'], 'subtitle' => ['Sous-titre', 'qui nous définissent']] as $key => $field) {
            $this->add_control($key, [
                'label' => $field[0],
                'type' => Controls_Manager::TEXT,
                'default' => $field[1],
                'label_block' => true,
                'dynamic' => ['active' => true],
            ]);
        }
        $this->add_control('heading_tag', [
            'label' => __('Balise du titre', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => array_combine(['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], ['H1', 'H2', 'H3', 'H4', 'H5', 'H6']),
        ]);
        $this->end_controls_section();

        $this->start_controls_section('numbers_section', ['label' => __('Chiffres', 'sage')]);
        $number = new Repeater();
        $number->add_control('value', [
            'label' => __('Valeur', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => '10',
            'dynamic' => ['active' => true],
        ]);
        $number->add_control('suffix', [
            'label' => __('Suffixe', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => '+',
            'description' => __('Par exemple : +, %, ou vide.', 'sage'),
        ]);
        $number->add_control('label', [
            'label' => __('Libellé', 'sage'),
            'type' => Controls_Manager::TEXT,
            'label_block' => true,
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('numbers', [
            'label' => __('Liste des chiffres', 'sage'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $number->get_controls(),
            'title_field' => '{{{ value }}}{{{ suffix }}} — {{{ label }}}',
            'default' => [
                ['value' => '10', 'suffix' => '+', 'label' => __('Ans d’expertise', 'sage')],
                ['value' => '20', 'suffix' => '+', 'label' => __('Collaborateurs', 'sage')],
                ['value' => '90', 'suffix' => '%', 'label' => __('hybride / remote', 'sage')],
                ['value' => '50', 'suffix' => '+', 'label' => __('Projets livrés', 'sage')],
            ],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('layout', ['label' => __('Mise en page', 'sage')]);
        $this->add_control('background', [
            'description' => __('Appliqué au conteneur Elementor parent direct. Le premier widget Intro ou Chiffres clés définit le fond du conteneur. Enregistrez et rechargez l’aperçu pour voir le changement.', 'sage'),
            'label' => __('Arrière-plan', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'bgi--5',
            'options' => [
                '' => __('Aucun', 'sage'),
                'bgi--1' => __('Fond 1', 'sage'),
                'bgi--2' => __('Fond 2', 'sage'),
                'bgi--3' => __('Fond 3', 'sage'),
                'bgi--4' => __('Fond 4', 'sage'),
                'bgi--5' => __('Fond 5', 'sage'),
                'bgi--6' => __('Fond 6', 'sage'),
            ],
        ]);
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
        $tag = in_array($settings['heading_tag'] ?? '', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? $settings['heading_tag'] : 'h2';
        ?>
        <div class="block numbers-block">
            <div class="numbers-block__content uk-container text-center flex flex-col gap-[32px] <?php echo esc_attr($settings['container_classes'] ?? ''); ?>">
                <?php if (! empty($settings['heading']) || ! empty($settings['subtitle'])) : ?>
                    <div class="numbers-block__header">
                        <<?php echo $tag; ?> class="title title--h2 c--4 [&_small]:font-500">
                            <span><?php echo esc_html($settings['heading'] ?? ''); ?></span>
                            <?php if (! empty($settings['subtitle'])) : ?>
                                <small><span><?php echo esc_html($settings['subtitle']); ?></span></small>
                            <?php endif; ?>
                        </<?php echo $tag; ?>>
                    </div>
                <?php endif; ?>
                <?php if (! empty($settings['numbers'])) : ?>
                    <div class="numbers-block__body">
                        <div class="card numbers-card">
                            <div class="numbers-card__content">
                                <div class="numbers-card__body grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 w-full justify-between" data-uk-grid="margin: spacer;">
                                    <?php foreach ($settings['numbers'] as $number) : ?>
                                        <div class="number">
                                            <div class="number-value">
                                                <span><?php echo esc_html($number['value'] ?? ''); ?></span><?php if (isset($number['suffix']) && $number['suffix'] !== '') : ?><sup><span><?php echo esc_html($number['suffix']); ?></span></sup><?php endif; ?>
                                            </div>
                                            <div class="number-label"><span><?php echo esc_html($number['label'] ?? ''); ?></span></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
