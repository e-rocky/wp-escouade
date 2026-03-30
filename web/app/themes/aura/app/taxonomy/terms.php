<?php

/**
 * Custom taxonomy
 *
 * @package terms
 */

/**
 * Registers the `terms` taxonomy,
 * for use with 'job-offer'.
 */
function terms_init()
{
    register_taxonomy(
        'terms',
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
                'name'                       => __('Modalités', 'YOUR-TEXTDOMAIN'),
                'singular_name'              => _x('Modalités', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
                'search_items'               => __('Search Modalités', 'YOUR-TEXTDOMAIN'),
                'popular_items'              => __('Popular Modalités', 'YOUR-TEXTDOMAIN'),
                'all_items'                  => __('All Modalités', 'YOUR-TEXTDOMAIN'),
                'parent_item'                => __('Parent Modalités', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'          => __('Parent Modalités:', 'YOUR-TEXTDOMAIN'),
                'edit_item'                  => __('Edit Modalités', 'YOUR-TEXTDOMAIN'),
                'update_item'                => __('Update Modalités', 'YOUR-TEXTDOMAIN'),
                'view_item'                  => __('View Modalités', 'YOUR-TEXTDOMAIN'),
                'add_new_item'               => __('Add New Modalités', 'YOUR-TEXTDOMAIN'),
                'new_item_name'              => __('New Modalités', 'YOUR-TEXTDOMAIN'),
                'separate_items_with_commas' => __('Separate Modalités with commas', 'YOUR-TEXTDOMAIN'),
                'add_or_remove_items'        => __('Add or remove Modalités', 'YOUR-TEXTDOMAIN'),
                'choose_from_most_used'      => __('Choose from the most used Modalités', 'YOUR-TEXTDOMAIN'),
                'not_found'                  => __('No Modalités found.', 'YOUR-TEXTDOMAIN'),
                'no_terms'                   => __('No Modalités', 'YOUR-TEXTDOMAIN'),
                'menu_name'                  => __('Modalités', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation'      => __('Modalités list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'                 => __('Modalités list', 'YOUR-TEXTDOMAIN'),
                'most_used'                  => _x('Most Used', 'terms', 'YOUR-TEXTDOMAIN'),
                'back_to_items'              => __('&larr; Back to Modalités', 'YOUR-TEXTDOMAIN'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'terms',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'terms_init');

/**
 * Sets the post updated messages for the `terms` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `terms` taxonomy.
 */
function terms_updated_messages($messages)
{

    $messages['terms'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Modalités added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Modalités deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Modalités updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Modalités not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Modalités not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Modalités deleted.', 'YOUR-TEXTDOMAIN'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'terms_updated_messages');
