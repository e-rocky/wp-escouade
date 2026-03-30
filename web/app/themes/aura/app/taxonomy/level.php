<?php

/**
 * Custom taxonomy
 *
 * @package level
 */

/**
 * Registers the `level` taxonomy,
 * for use with 'job-offer'.
 */
function level_init()
{
    register_taxonomy(
        'level',
        array('job-offer'),
        array(
            'hierarchical'          => false,
            'public'                => true,
            'show_in_nav_menus'     => true,
            'show_ui'               => true,
            'show_admin_column'     => false,
            'query_var'             => true,
            'rewrite'               => true,
            'capabilities'          => array(
                'manage_terms' => 'edit_posts',
                'edit_terms'   => 'edit_posts',
                'delete_terms' => 'edit_posts',
                'assign_terms' => 'edit_posts',
            ),
            'labels'                => array(
                'name'                       => __('Niveauxes', 'YOUR-TEXTDOMAIN'),
                'singular_name'              => _x('Niveaux', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
                'search_items'               => __('Search Niveauxes', 'YOUR-TEXTDOMAIN'),
                'popular_items'              => __('Popular Niveauxes', 'YOUR-TEXTDOMAIN'),
                'all_items'                  => __('All Niveauxes', 'YOUR-TEXTDOMAIN'),
                'parent_item'                => __('Parent Niveaux', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'          => __('Parent Niveaux:', 'YOUR-TEXTDOMAIN'),
                'edit_item'                  => __('Edit Niveaux', 'YOUR-TEXTDOMAIN'),
                'update_item'                => __('Update Niveaux', 'YOUR-TEXTDOMAIN'),
                'view_item'                  => __('View Niveaux', 'YOUR-TEXTDOMAIN'),
                'add_new_item'               => __('Add New Niveaux', 'YOUR-TEXTDOMAIN'),
                'new_item_name'              => __('New Niveaux', 'YOUR-TEXTDOMAIN'),
                'separate_items_with_commas' => __('Separate Niveauxes with commas', 'YOUR-TEXTDOMAIN'),
                'add_or_remove_items'        => __('Add or remove Niveauxes', 'YOUR-TEXTDOMAIN'),
                'choose_from_most_used'      => __('Choose from the most used Niveauxes', 'YOUR-TEXTDOMAIN'),
                'not_found'                  => __('No Niveauxes found.', 'YOUR-TEXTDOMAIN'),
                'no_terms'                   => __('No Niveauxes', 'YOUR-TEXTDOMAIN'),
                'menu_name'                  => __('Niveauxes', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation'      => __('Niveauxes list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'                 => __('Niveauxes list', 'YOUR-TEXTDOMAIN'),
                'most_used'                  => _x('Most Used', 'level', 'YOUR-TEXTDOMAIN'),
                'back_to_items'              => __('&larr; Back to Niveauxes', 'YOUR-TEXTDOMAIN'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'level',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'level_init');

/**
 * Sets the post updated messages for the `level` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `level` taxonomy.
 */
function level_updated_messages($messages)
{

    $messages['level'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Niveaux added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Niveaux deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Niveaux updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Niveaux not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Niveaux not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Niveauxes deleted.', 'YOUR-TEXTDOMAIN'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'level_updated_messages');
