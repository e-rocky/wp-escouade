<?php

/**
 * Custom taxonomy
 *
 * @package location
 */

/**
 * Registers the `job-location` taxonomy,
 * for use with 'job-offer'.
 */
function location_init()
{
    register_taxonomy(
        'job-location',
        array('job-offer'),
        array(
            'hierarchical'          => true,
            'public'                => true,
            'show_in_nav_menus'     => true,
            'show_ui'               => true,
            'show_admin_column'     => true,
            'query_var'             => true,
            'rewrite'               => true,
            'capabilities'          => array(
                'manage_terms' => 'edit_posts',
                'edit_terms'   => 'edit_posts',
                'delete_terms' => 'edit_posts',
                'assign_terms' => 'edit_posts',
            ),
            'labels'                => array(
                'name'                       => __('Locations', 'aura'),
                'singular_name'              => _x('Location', 'taxonomy general name', 'aura'),
                'search_items'               => __('Search locations', 'aura'),
                'popular_items'              => __('Popular locations', 'aura'),
                'all_items'                  => __('All locations', 'aura'),
                'parent_item'                => __('Parent location', 'aura'),
                'parent_item_colon'          => __('Parent location:', 'aura'),
                'edit_item'                  => __('Edit location', 'aura'),
                'update_item'                => __('Update location', 'aura'),
                'view_item'                  => __('View location', 'aura'),
                'add_new_item'               => __('Add New location', 'aura'),
                'new_item_name'              => __('New location', 'aura'),
                'separate_items_with_commas' => __('Separate locations with commas', 'aura'),
                'add_or_remove_items'        => __('Add or remove locations', 'aura'),
                'choose_from_most_used'      => __('Choose from the most used locations', 'aura'),
                'not_found'                  => __('No locations found.', 'aura'),
                'no_terms'                   => __('No locations', 'aura'),
                'menu_name'                  => __('Locations', 'aura'),
                'items_list_navigation'      => __('Locations list navigation', 'aura'),
                'items_list'                 => __('Locations list', 'aura'),
                'most_used'                  => _x('Most Used', 'location', 'aura'),
                'back_to_items'              => __('&larr; Back to locations', 'aura'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'location',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'location_init');

/**
 * Sets the post updated messages for the `job-location` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `job-location` taxonomy.
 */
function location_updated_messages($messages)
{
    $messages['job-location'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Location added.', 'aura'),
        2 => __('Location deleted.', 'aura'),
        3 => __('Location updated.', 'aura'),
        4 => __('Location not added.', 'aura'),
        5 => __('Location not updated.', 'aura'),
        6 => __('Location deleted.', 'aura'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'location_updated_messages');
