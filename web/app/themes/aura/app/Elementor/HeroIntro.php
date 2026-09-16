<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class HeroIntro extends Widget_Base
{
    public function get_name()
    {
        return 'aura-hero-intro';
    }

    public function get_title()
    {
        return __('Intro — Aura', 'sage');
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
        return ['aura', 'intro', 'hero', 'image', 'carriere'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content', ['label' => __('Contenu', 'sage')]);
        $this->add_control('heading', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Envie de rejoindre <em>l’Escouade</em> ?', 'sage'),
            'description' => __('Utilisez <em> pour mettre une partie du titre en évidence.', 'sage'),
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('heading_tag', [
            'label' => __('Balise du titre', 'sage'),
            'type' => Controls_Manager::SELECT,
            'options' => array_combine(['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], ['H1', 'H2', 'H3', 'H4', 'H5', 'H6']),
            'default' => 'h2',
        ]);
        $this->add_control('body', [
            'label' => __('Texte', 'sage'),
            'type' => Controls_Manager::WYSIWYG,
            'default' => '<p>Chez Escouade, nous croyons que la réussite d’un projet repose avant tout sur les personnes.</p><p>Basée à Madagascar, notre société réunit des développeurs passionnés et les connecte à des projets stimulants portés par nos partenaires en Europe.</p>',
            'dynamic' => ['active' => true],
        ]);
        $this->add_control('image', [
            'label' => __('Image', 'sage'),
            'type' => Controls_Manager::MEDIA,
            'default' => ['url' => get_theme_file_uri('resources/images/content/edito-img-1.png')],
            'dynamic' => ['active' => true],
        ]);
        $this->end_controls_section();

        $this->start_controls_section('buttons', ['label' => __('Boutons', 'sage')]);
        foreach (['primary' => __('Nos offres d’emploi', 'sage'), 'secondary' => __('Candidature spontanée', 'sage')] as $key => $label) {
            $this->add_control($key . '_text', [
                'label' => $key === 'primary' ? __('Bouton principal', 'sage') : __('Bouton secondaire', 'sage'),
                'type' => Controls_Manager::TEXT,
                'default' => $label,
                'description' => __('Laissez le libellé vide pour masquer ce bouton.', 'sage'),
                'dynamic' => ['active' => true],
            ]);
            $this->add_control($key . '_link', [
                'label' => __('Lien', 'sage'),
                'type' => Controls_Manager::URL,
                'default' => ['url' => $key === 'primary' ? (get_post_type_archive_link('job-offer') ?: '#') : '#'],
                'dynamic' => ['active' => true],
            ]);
        }
        $this->end_controls_section();

        $this->start_controls_section('layout', ['label' => __('Mise en page', 'sage')]);
        $this->add_control('background', [
            'description' => __('Appliqué au conteneur Elementor parent direct. Si plusieurs widgets Intro partagent ce conteneur, le premier définit le fond. Enregistrez et rechargez l’aperçu pour voir le changement.', 'sage'),
            'label' => __('Arrière-plan', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'bgi--4',
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
            'description' => __('Classes supplémentaires séparées par des espaces. Les styles correspondants doivent déjà exister.', 'sage'),
        ]);
        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $is_edit_mode = \Elementor\Plugin::$instance->editor->is_edit_mode();
        $this->add_render_attribute('heading', 'class', ['title', 'title--h2', 'c--3']);
        $this->add_inline_editing_attributes('heading', 'basic');
        $this->add_render_attribute('body', 'class', 'text');
        $this->add_inline_editing_attributes('body', 'advanced');
        $tag = in_array($settings['heading_tag'], ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true) ? $settings['heading_tag'] : 'h2';
        $image = $settings['image'] ?? [];
        $buttons = [];
        foreach (['primary' => 'btn c--4 bgc--5-2 btn-shadow-sm w-a', 'secondary' => 'btn c--1-2 bgc--1-2 bdc--1-2 btn-shadow-sm w-a'] as $key => $classes) {
            if (trim($settings[$key . '_text'] ?? '') === '' || empty($settings[$key . '_link']['url'])) {
                continue;
            }
            $this->add_link_attributes($key, $settings[$key . '_link']);
            $this->add_render_attribute($key, 'class', $classes);
            $this->add_render_attribute($key, 'title', $settings[$key . '_text']);
            $buttons[] = $key;
        }
?>
        <div class="block hero-intro-block">
            <div class="hero-intro-block__content uk-container <?php echo esc_attr($settings['container_classes'] ?? ''); ?>">
                <div class="hero-intro-block__body">
                    <div class="card hero-intro-card">
                        <div class="hero-intro-card__background scale-x-[-1]"></div>
                        <div class="hero-intro-card__content flex flex-col lg:flex-row-reverse">
                            <?php if (! empty($image['url'])) : ?>
                                <div class="hero-intro-card__header">
                                    <figure class="img-container">
                                        <?php if (! empty($image['id'])) : ?>
                                            <?php echo wp_get_attachment_image((int) $image['id'], 'full'); ?>
                                        <?php else : ?>
                                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt'] ?? ''); ?>">
                                        <?php endif; ?>
                                    </figure>
                                </div>
                            <?php endif; ?>
                            <div class="hero-intro-card__body">
                                <div class="rte rte--em-c-2">
                                    <?php if (! empty($settings['heading']) || $is_edit_mode) : ?>
                                        <<?php echo $tag; ?> <?php $this->print_render_attribute_string('heading'); ?>><?php echo wp_kses($settings['heading'] ?? '', ['em' => [], 'strong' => [], 'br' => []]); ?></<?php echo $tag; ?>>
                                    <?php endif; ?>
                                    <div <?php $this->print_render_attribute_string('body'); ?>><?php echo wp_kses_post($settings['body'] ?? ''); ?></div>
                                    <?php if ($buttons) : ?>
                                        <div class="actions flex flex-col sm:flex-row md:flex-wrap items-stretch gap-[20px]">
                                            <?php foreach ($buttons as $key) : ?>
                                                <a <?php $this->print_render_attribute_string($key); ?>><?php echo esc_html($settings[$key . '_text']); ?></a>
                                            <?php endforeach; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}
