<?php

use Roots\Acorn\Application;
use function Roots\asset;
use Illuminate\Support\Facades\Vite;

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our theme. We will simply require it into the script here so that we
| don't have to worry about manually loading any of our classes later on.
|
*/

if (! file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    wp_die(__('Error locating autoloader. Please run <code>composer install</code>.', 'sage'));
}

require $composer;

/*
|--------------------------------------------------------------------------
| Register The Bootloader
|--------------------------------------------------------------------------
|
| The first thing we will do is schedule a new Acorn application container
| to boot when WordPress is finished loading the theme. The application
| serves as the "glue" for all the components of Laravel and is
| the IoC container for the system binding all of the various parts.
|
*/

Application::configure()
    ->withProviders([
        App\Providers\ThemeServiceProvider::class,
    ])
    ->boot();

/*
|--------------------------------------------------------------------------
| Register Sage Theme Files
|--------------------------------------------------------------------------
|
| Out of the box, Sage ships with categorically named theme files
| containing common functionality and setup to be bootstrapped with your
| theme. Simply add (or remove) files from the array below to change what
| is registered alongside Sage.
|
*/

collect(['setup', 'filters'])
    ->each(function ($file) {
        if (! locate_template($file = "app/{$file}.php", true, true)) {
            wp_die(
                /* translators: %s is replaced with the relative file path */
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });

collect(['job-offer'])
    ->each(function ($file) {
        if (! locate_template($file = "app/post-types/{$file}.php", true, true)) {
            wp_die(
                sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file)
            );
        }
    });


add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'auraStyle',
        Vite::asset('src/style.scss'),
        [],
        null
    );
    wp_enqueue_style(
        'auraUno',
        Vite::asset("../../../../../../../../../../__uno.css"),
        [],
        null
    );
    wp_enqueue_script(
        'auraScript',
        Vite::asset('resources/js/app.js'),
        [],
        null,
        true
    );
});

add_filter('block_editor_settings_all', function ($settings) {
    $auraStyle = Vite::asset('src/style.scss');
    $auraUno = Vite::asset("../../../../../../../../../../__uno.css");

    $settings['styles'][] = [
        'css' => "@import url('{$auraStyle}')",
    ];

    $settings['styles'][] = [
        'css' => "@import url('{$auraUno}')",
    ];

    return $settings;
});

add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_style(
        'aura-editor',
        Vite::asset('resources/css/editor.css'),
        [],
        null
    );
    wp_add_inline_script(
        'wp-blocks',
        'window.auraBuildPath = ' . json_encode([
            'uri' => get_theme_file_uri('public/build/'),
        ]) . ';',
        'before'
    );
});


add_action('admin_head', function () {
    if ((get_current_screen()->is_block_editor())) {
    };
});
