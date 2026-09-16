<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

class Breadcrumb extends Widget_Base
{
    public function get_name()
    {
        return 'aura-breadcrumb';
    }

    public function get_title()
    {
        return __('Fil d’Ariane — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-navigation-horizontal';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'breadcrumb', 'navigation', 'fil', 'ariane'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('breadcrumb_content', [
            'label' => __('Fil d’Ariane', 'sage'),
        ]);

        $this->add_control('home_label', [
            'label' => __('Libellé de l’accueil', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Accueil', 'sage'),
        ]);

        $items = new Repeater();
        $items->add_control('label', [
            'label' => __('Libellé', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Page', 'sage'),
            'dynamic' => ['active' => true],
            'label_block' => true,
        ]);
        $items->add_control('link', [
            'label' => __('Lien', 'sage'),
            'type' => Controls_Manager::URL,
            'dynamic' => ['active' => true],
            'label_block' => true,
        ]);

        $this->add_control('items', [
            'label' => __('Étapes', 'sage'),
            'type' => Controls_Manager::REPEATER,
            'fields' => $items->get_controls(),
            'title_field' => '{{{ label }}}',
            'description' => __('La dernière étape représente la page actuelle. Sans URL, une étape s’affiche comme texte.', 'sage'),
            'default' => [
                ['label' => __('Rejoignez-nous', 'sage')],
                [
                    'label' => __('Nos offres d’emploi', 'sage'),
                    'link' => ['url' => get_post_type_archive_link('job-offer') ?: ''],
                ],
                ['label' => __('Développeur Back-end PHP', 'sage')],
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $items = array_values(array_filter($settings['items'] ?? [], static function ($item) {
            return trim($item['label'] ?? '') !== '';
        }));
        $home_label = $settings['home_label'] ?: __('Accueil', 'sage');
        ?>
        <div class="block breadcrumb-block">
            <div class="breadcrumb-block__content uk-container">
                <nav class="breadcrumb-block__body" aria-label="<?php echo esc_attr__('Fil d’Ariane', 'sage'); ?>">
                    <ul>
                        <li>
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr($home_label); ?>" aria-label="<?php echo esc_attr($home_label); ?>">
                                <i class="es-icon-home" aria-hidden="true"></i>
                            </a>
                        </li>
                        <?php foreach ($items as $index => $item) : ?>
                            <li class="separator" aria-hidden="true"><i class="es-icon-caret"></i></li>
                            <li>
                                <?php if (! empty($item['link']['url'])) : ?>
                                    <?php
                                    $key = 'breadcrumb-link-' . $index;
                                    $this->add_link_attributes($key, $item['link']);
                                    $this->add_render_attribute($key, 'title', $item['label']);
                                    if ($index === count($items) - 1) {
                                        $this->add_render_attribute($key, 'aria-current', 'page');
                                    }
                                    ?>
                                    <a <?php $this->print_render_attribute_string($key); ?>><?php echo esc_html($item['label']); ?></a>
                                <?php else : ?>
                                    <span<?php echo $index === count($items) - 1 ? ' aria-current="page"' : ''; ?>><?php echo esc_html($item['label']); ?></span>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>
        </div>
        <?php
    }
}
