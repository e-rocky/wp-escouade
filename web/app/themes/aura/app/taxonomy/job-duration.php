<?php

/**
 * Custom taxonomy
 *
 * @package duration
 */

/**
 * Registers the `duration` taxonomy,
 * for use with 'job-offer'.
 */
function duration_init()
{
    register_taxonomy(
        'job-duration',
        array('job-offer'),
        array(
            'hierarchical'          => false,
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
                'name'                       => __('Durations', 'aura'),
                'singular_name'              => _x('Duration', 'taxonomy general name', 'aura'),
                'search_items'               => __('Search durations', 'aura'),
                'popular_items'              => __('Popular durations', 'aura'),
                'all_items'                  => __('All durations', 'aura'),
                'parent_item'                => __('Parent durations', 'aura'),
                'parent_item_colon'          => __('Parent durations:', 'aura'),
                'edit_item'                  => __('Edit durations', 'aura'),
                'update_item'                => __('Update durations', 'aura'),
                'view_item'                  => __('View durations', 'aura'),
                'add_new_item'               => __('Add New durations', 'aura'),
                'new_item_name'              => __('New durations', 'aura'),
                'separate_items_with_commas' => __('Separate durations with commas', 'aura'),
                'add_or_remove_items'        => __('Add or remove durations', 'aura'),
                'choose_from_most_used'      => __('Choose from the most used durations', 'aura'),
                'not_found'                  => __('No durations found.', 'aura'),
                'no_terms'                   => __('No durations', 'aura'),
                'menu_name'                  => __('Durations', 'aura'),
                'items_list_navigation'      => __('Durations list navigation', 'aura'),
                'items_list'                 => __('Durations list', 'aura'),
                'most_used'                  => _x('Most Used', 'duration', 'aura'),
                'back_to_items'              => __('&larr; Back to durations', 'aura'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'duration',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'duration_init');

/**
 * Sets the post updated messages for the `duration` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `duration` taxonomy.
 */
function duration_updated_messages($messages)
{

    $messages['job-duration'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Duration added.', 'aura'),
        2 => __('Duration deleted.', 'aura'),
        3 => __('Duration updated.', 'aura'),
        4 => __('Duration not added.', 'aura'),
        5 => __('Duration not updated.', 'aura'),
        6 => __('Duration deleted.', 'aura'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'duration_updated_messages');
