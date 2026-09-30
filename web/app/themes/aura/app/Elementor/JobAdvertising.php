<?php

namespace App\Elementor;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

class JobAdvertising extends Widget_Base
{
    public function get_name()
    {
        return 'aura-job-advertising';
    }

    public function get_title()
    {
        return __('Offres d’emploi — Aura', 'sage');
    }

    public function get_icon()
    {
        return 'eicon-post-slider';
    }

    public function get_categories()
    {
        return ['general'];
    }

    public function get_keywords()
    {
        return ['aura', 'emploi', 'offres', 'recrutement', 'jobs'];
    }

    protected function register_controls()
    {
        $this->start_controls_section('content', ['label' => __('Contenu', 'sage')]);

        $this->add_control('title', [
            'label' => __('Titre', 'sage'),
            'type' => Controls_Manager::TEXTAREA,
            'default' => __('Rejoignez votre Escouade', 'sage'),
            'dynamic' => ['active' => true],
        ]);

        $this->add_control('title_tag', [
            'label' => __('Balise du titre', 'sage'),
            'type' => Controls_Manager::SELECT,
            'default' => 'h2',
            'options' => [
                'h1' => 'H1',
                'h2' => 'H2',
                'h3' => 'H3',
                'h4' => 'H4',
                'h5' => 'H5',
                'h6' => 'H6',
            ],
        ]);

        $this->add_control('jobs_count', [
            'label' => __('Nombre d’offres', 'sage'),
            'type' => Controls_Manager::NUMBER,
            'default' => 3,
            'min' => 1,
            'max' => 12,
            'step' => 1,
            'description' => __('Nombre des dernières offres publiées à afficher.', 'sage'),
        ]);

        $this->end_controls_section();

        $this->start_controls_section('button_section', ['label' => __('Bouton', 'sage')]);

        $this->add_control('button_label', [
            'label' => __('Libellé', 'sage'),
            'type' => Controls_Manager::TEXT,
            'default' => __('Voir toutes les offres d’emploi', 'sage'),
            'dynamic' => ['active' => true],
            'description' => __('Laissez vide pour masquer le bouton.', 'sage'),
        ]);

        $this->add_control('button_link', [
            'label' => __('Lien', 'sage'),
            'type' => Controls_Manager::URL,
            'default' => ['url' => get_post_type_archive_link('job-offer') ?: ''],
            'dynamic' => ['active' => true],
        ]);

        $this->end_controls_section();
    }

    protected function render()
    {
        $settings = $this->get_settings_for_display();
        $titleTag = in_array($settings['title_tag'] ?? '', ['h1', 'h2', 'h3', 'h4', 'h5', 'h6'], true)
            ? $settings['title_tag']
            : 'h2';
        $jobsCount = max(1, min(12, (int) ($settings['jobs_count'] ?? 3)));
        $buttonLabel = trim((string) ($settings['button_label'] ?? ''));
        $buttonUrl = $settings['button_link']['url'] ?? '';
        $illustrations = [
            'resources/images/content/job-advertising-img-1.png',
            'resources/images/content/job-advertising-img-2.png',
            'resources/images/content/job-advertising-img-3.png',
        ];
        $jobs = new \WP_Query([
            'post_type' => 'job-offer',
            'post_status' => 'publish',
            'posts_per_page' => $jobsCount,
            'orderby' => 'date',
            'order' => 'DESC',
            'no_found_rows' => true,
        ]);

        $this->add_render_attribute('title', 'class', ['title', 'title--h2-lg', 'rte', 'rte--em-c-5', 'c--4', 'mb-0']);
        $this->add_inline_editing_attributes('title', 'basic');

        if ($buttonLabel !== '' && $buttonUrl !== '') {
            $this->add_link_attributes('button', $settings['button_link']);
            $this->add_render_attribute('button', 'class', ['btn', 'btn--lg', 'c--4', 'bgc--5', 'btn-shadow-sm']);
            $this->add_render_attribute('button', 'title', $buttonLabel);
        }
?>
        <div class="block bgi bgi--5 job-advertising-block">
            <div class="job-advertising-block__content uk-container flex gap-[70px] flex-col">
                <?php if (! empty($settings['title'])) : ?>
                    <div class="block-header">
                        <<?php echo $titleTag; ?> <?php $this->print_render_attribute_string('title'); ?>><?php echo wp_kses($settings['title'], ['em' => [], 'strong' => [], 'br' => []]); ?></<?php echo $titleTag; ?>>
                    </div>
                <?php endif; ?>

                <?php if ($jobs->have_posts()) : ?>
                    <div class="job-advertising-block__body uk-slider uk-slider-container" data-uk-slider role="region" aria-roledescription="carousel">
                        <div class="slider uk-slider-items" aria-live="polite">
                            <?php $index = 0; ?>
                            <?php while ($jobs->have_posts()) : $jobs->the_post(); ?>
                                <?php
                                $jobTitle = get_the_title();
                                $illustration = \Roots\asset($illustrations[$index % count($illustrations)])->uri();
                                $logo = \Roots\asset('resources/images/design/logo--text.svg')->uri();
                                ?>
                                <div class="slide card job-advertising-card">
                                    <a href="<?php echo esc_url(get_permalink()); ?>" class="job-advertising-card__content c--4" title="<?php echo esc_attr($jobTitle); ?>">
                                        <div class="job-advertising-card__header">
                                            <figure class="img-container">
                                                <img src="<?php echo esc_url($logo); ?>" alt="<?php esc_attr_e('Escouade', 'sage'); ?>">
                                            </figure>
                                        </div>
                                        <div class="job-advertising-card__body">
                                            <strong class="title--overline"><?php esc_html_e('Nous recrutons', 'sage'); ?></strong>
                                            <h3 class="title color-inherit"><?php echo esc_html($jobTitle); ?></h3>
                                            <figure class="img-container">
                                                <img src="<?php echo esc_url($illustration); ?>" alt="<?php echo esc_attr($jobTitle); ?>">
                                            </figure>
                                        </div>
                                    </a>
                                </div>
                                <?php $index++; ?>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); ?>
                <?php endif; ?>

                <?php if ($buttonLabel !== '' && $buttonUrl !== '') : ?>
                    <div class="job-advertising-block__footer flex justify-center">
                        <a <?php $this->print_render_attribute_string('button'); ?>><?php echo esc_html($buttonLabel); ?><i class="es-icon-chevron-right"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php
    }
}
