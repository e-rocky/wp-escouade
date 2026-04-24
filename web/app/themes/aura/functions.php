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
                sprintf('Error locating <code>%s</code> for inclusion.', $file)
            );
        }
    });

collect(['job-offer'])
    ->each(function ($file) {
        if (! locate_template($file = "app/post-types/{$file}.php", true, true)) {
            wp_die(
                sprintf('Error locating <code>%s</code> for inclusion.', $file)
            );
        }
    });


collect(['job-department', 'job-duration', 'job-language', 'job-level', 'job-location', 'job-stack', 'job-workplace', 'job-urgent'])
    ->each(function ($file) {
        if (! locate_template($file = "app/taxonomy/{$file}.php", true, true)) {
            wp_die(
                sprintf('Error locating <code>%s</code> for inclusion.', $file)
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

add_action('enqueue_block_assets', function () {
    wp_enqueue_style(
        'auraEditorStyle',
        Vite::asset('resources/css/editor.css'),
        [],
        null
    );

    wp_enqueue_script(
        'auraEditorScript',
        Vite::asset('resources/js/editor.js'),
        ['wp-blocks', 'wp-element', 'wp-i18n', 'wp-components', 'wp-dom-ready'],
        null,
        true
    );
});

add_filter('wp_script_attributes', function ($attributes) {
    if (($attributes['id'] ?? '') !== 'auraEditorScript-js') {
        return $attributes;
    }

    $attributes['type'] = 'module';

    return $attributes;
});

add_action('enqueue_block_editor_assets', function () {
    wp_add_inline_script(
        'wp-blocks',
        'window.aura = ' . json_encode([
            'src' => ['uri' => get_theme_file_uri('/'),],
            'build' => ['uri' => get_theme_file_uri('public/build/')],
        ]) . ';',
        'before'
    );
});

// Exemple : pré-remplir un champ caché "page-title" avec le titre de la page dans Contact Form 7
add_filter('wpcf7_form_hidden_fields', function ($hidden_fields) {
    if (is_singular()) {
        $hidden_fields['post_title'] = get_the_title();
        $hidden_fields['site_title'] = get_bloginfo('name');
    }
    return $hidden_fields;
});

function my_scripts()
{
    wp_enqueue_script(
        'auraScript',
        get_template_directory_uri() . '/js/script.js',
        array(),
        null,
        true
    );

    wp_localize_script('auraScript', 'wpAura', array(
        'translations' => array(
            'wpcf7_message'  => array(
                'dropzone' => array(
                    'error' => __("Échec de l'opération. Veuillez réessayer ou contactez le support.", 'aura'),
                    'success' => __("%s importé avec succès", 'aura'),
                ),
            ),
        ),
    ));
}
add_action('wp_enqueue_scripts', 'my_scripts');
