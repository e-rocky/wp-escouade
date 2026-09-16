<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Inject styles into the block editor.
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = Vite::asset('resources/css/editor.css');

    $settings['styles'][] = [
        'css' => "@import url('{$style}')",
    ];

    return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    if (! get_current_screen()?->is_block_editor()) {
        return;
    }

    $dependencies = json_decode(Vite::content('editor.deps.json'));

    foreach ($dependencies as $dependency) {
        if (! wp_script_is($dependency)) {
            wp_enqueue_script($dependency);
        }
    }

    echo Vite::withEntryPoints([
        'resources/js/editor.js',
    ])->toHtml();
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);

add_filter('wp_nav_menu_items', function ($items, $args) {
    if ($args->theme_location === 'cta_navigation') {
        $items .= '<li class="lg:hidden"><a class="p-[10px]" id="menu-toggle" class="order-4" href="#menu" data-uk-icon="icon: menu; ratio:1.2"></a></li>';
    }
    return $items;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    register_nav_menus([
        'cta_navigation' => __('CTA Navigation', 'sage'),
    ]);


    register_nav_menus([
        'footer_social_navigation' => __('Footer Social Navigation', 'sage'),
    ]);

    register_nav_menus([
        'footer_navigation' => __('Footer Navigation', 'sage'),
    ]);


    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Job offer page - Our Benefits', 'sage'),
        'id' => 'sidebar-job-offer-our-benefits',
    ] +  [
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => '',
    ]);

    register_sidebar([
        'name' => __('Content - Footer', 'sage'),
        'id' => 'content-footer',
    ] + $config);
});


/**
 * Register the blocks
 *
 * @return void
 */
require_once __DIR__ . '/blocks/blocks.php';

add_action('elementor/widgets/register', function ($widgets_manager) {
    $widgets_manager->register(new \App\Elementor\Breadcrumb());
    $widgets_manager->register(new \App\Elementor\HeroIntro());
    $widgets_manager->register(new \App\Elementor\Dna());
});

// Apply the first Intro widget's background to its immediate Elementor container.
add_action('elementor/frontend/container/before_render', function ($container) {
    foreach ($container->get_children() as $child) {
        if ($child->get_name() !== 'aura-hero-intro') {
            continue;
        }

        $background = $child->get_settings_for_display('background');
        if (in_array($background, ['bgi--1', 'bgi--2', 'bgi--3', 'bgi--4', 'bgi--5', 'bgi--6'], true)) {
            $container->add_render_attribute('_wrapper', 'class', ['bgi', $background]);
        }

        break;
    }
});
