<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Includes\Elements\Container;

class ContainerCustom extends Container
{
    public static function get_type()
    {
        return 'container-custom';
    }

    public function get_name()
    {
        return 'container-custom';
    }

    public function get_title()
    {
        return __('Container Custom — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-container';
    }

    public function get_keywords()
    {
        return array_merge(parent::get_keywords(), [
            'Aura',
            'Custom',
            'Personnalisé',
        ]);
    }

    protected function register_controls()
    {
        parent::register_controls();

        $this->remove_control('content_width');

        $this->start_controls_section('section_slider_layout', [
            'label' => __('Slider UIkit', 'sage'),
            'tab' => Controls_Manager::TAB_LAYOUT,
        ]);

        $this->add_responsive_control('slider_child_width', [
            'label' => __('Largeur des éléments', 'sage'),
            'type' => Controls_Manager::SELECT,
            'options' => $this->get_child_width_options(),
            'default' => '1-3',
            'device_args' => [
                'tablet' => ['default' => '1-2'],
                'mobile' => ['default' => '1-1'],
            ],
            'description' => __('Nombre d’éléments visibles par viewport.', 'sage'),
        ]);

        $this->end_controls_section();
    }

    protected function add_render_attributes()
    {
        parent::add_render_attributes();

        $this->add_render_attribute('_wrapper', [
            'class' => 'container-custom uk-slider',
            'data-uk-slider' => '',
            'role' => 'region',
            'aria-roledescription' => 'carousel',
        ]);
    }

    protected function is_boxed_container(array $settings)
    {
        return false;
    }

    public function before_render()
    {
        parent::before_render();

        $widthClasses = implode(' ', $this->get_child_width_classes());
        ?>
        <div class="container-custom__slider-items uk-slider-items <?php echo esc_attr($widthClasses); ?>" aria-live="polite">
        <?php
    }

    public function after_render()
    {
        ?>
        </div>
        <?php
        parent::after_render();
    }

    private function get_child_width_options(): array
    {
        return [
            '1-1' => __('1 élément', 'sage'),
            '1-2' => __('2 éléments', 'sage'),
            '1-3' => __('3 éléments', 'sage'),
            '1-4' => __('4 éléments', 'sage'),
            '1-5' => __('5 éléments', 'sage'),
            '1-6' => __('6 éléments', 'sage'),
        ];
    }

    private function get_child_width_classes(): array
    {
        $settings = $this->get_settings_for_display();
        $allowed = array_keys($this->get_child_width_options());
        $mobile = in_array($settings['slider_child_width_mobile'] ?? '', $allowed, true)
            ? $settings['slider_child_width_mobile']
            : '1-1';
        $tablet = in_array($settings['slider_child_width_tablet'] ?? '', $allowed, true)
            ? $settings['slider_child_width_tablet']
            : '1-2';
        $desktop = in_array($settings['slider_child_width'] ?? '', $allowed, true)
            ? $settings['slider_child_width']
            : '1-3';

        return [
            'uk-child-width-' . $mobile,
            'uk-child-width-' . $tablet . '@s',
            'uk-child-width-' . $desktop . '@l',
        ];
    }
}
