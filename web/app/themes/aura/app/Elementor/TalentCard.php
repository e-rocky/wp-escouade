<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class TalentCard extends Widget_Base
{
    public function get_name()
    {
        return 'aura-talent-card';
    }

    public function get_title()
    {
        return __('Carte talent — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-person';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'talent', 'équipe', 'collaborateur'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content', ['label' => __('Contenu', 'sage')]);

        $this->add_control('firstname', [
            'label' => __('Prénom', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Minh', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('lastname', [
            'label' => __('Nom', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Nguyên', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('role', [
            'label' => __('Fonction', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Lead Developer', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('image', [
            'label' => __('Image', 'sage'),
            'type' => Controls_Manager::MEDIA,
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('quote', [
            'label' => __('Citation', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('J’aime l’équilibre entre autonomie et travail collectif.', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->end_controls_section();

        $this->start_controls_section('style_variant', ['label' => __('Style', 'sage')]);

        $this->add_control('color_variant', [
            'label' => __('Couleur', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'green',
            'options' => [
                'green' => __('Vert', 'sage'),
                'pink' => __('Rose', 'sage'),
                'blue' => __('Bleu', 'sage'),
            ],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $isEditMode = \Elementor\Plugin::$instance->editor->is_edit_mode();
        $variant = in_array($settings['color_variant'] ?? '', ['green', 'pink', 'blue'], true)
            ? $settings['color_variant']
            : 'green';
        $image = $settings['image'] ?? [];
        $imageUrl = $image['url'] ?? '';
        $imageAlt = $image['alt'] ?? trim(($settings['firstname'] ?? '') . ' ' . ($settings['lastname'] ?? ''));

        $this->add_render_attribute('firstname', 'class', 'firstname');
        $this->add_inline_editing_attributes('firstname', 'basic');
        $this->add_render_attribute('lastname', 'class', 'lastname');
        $this->add_inline_editing_attributes('lastname', 'basic');
        $this->add_inline_editing_attributes('role', 'basic');
        $this->add_render_attribute('quote', 'class', 'c--3');
        $this->add_inline_editing_attributes('quote', 'advanced');
?>
        <div class="card talent-card talent-card--<?php echo esc_attr($variant); ?>">
            <div class="talent-card__content">
                <div class="talent-card__header c--4 text-center">
                    <?php if (! empty($settings['firstname']) || ! empty($settings['lastname']) || $isEditMode) : ?>
                        <h3 class="name title title--h3 c--4">
                            <span <?php $this->print_render_attribute_string('firstname'); ?>><?php echo esc_html($settings['firstname'] ?? ''); ?></span>
                            <span <?php $this->print_render_attribute_string('lastname'); ?>><?php echo esc_html($settings['lastname'] ?? ''); ?></span>
                        </h3>
                    <?php endif; ?>
                    <?php if (! empty($settings['role']) || $isEditMode) : ?>
                        <div <?php $this->print_render_attribute_string('role'); ?>><?php echo esc_html($settings['role']); ?></div>
                    <?php endif; ?>
                </div>

                <?php if ($imageUrl !== '') : ?>
                    <div class="talent-card__body">
                        <div class="img-container">
                            <img src="<?php echo esc_url($imageUrl); ?>" alt="<?php echo esc_attr($imageAlt); ?>">
                            <img src="<?php echo esc_url($imageUrl); ?>" alt="" aria-hidden="true">
                        </div>
                    </div>
                <?php endif; ?>

                <?php if (! empty($settings['quote']) || $isEditMode) : ?>
                    <div class="talent-card__footer">
                        <blockquote>
                            <i class="es-icon-quotes" aria-hidden="true"></i>
                            <div <?php $this->print_render_attribute_string('quote'); ?>><?php echo wp_kses_post($settings['quote']); ?></div>
                        </blockquote>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }
}
