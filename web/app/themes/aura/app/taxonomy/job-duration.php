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
                'name'                       => __('Durations', 'YOUR-TEXTDOMAIN'),
                'singular_name'              => _x('Duration', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
                'search_items'               => __('Search durations', 'YOUR-TEXTDOMAIN'),
                'popular_items'              => __('Popular durations', 'YOUR-TEXTDOMAIN'),
                'all_items'                  => __('All durations', 'YOUR-TEXTDOMAIN'),
                'parent_item'                => __('Parent durations', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'          => __('Parent durations:', 'YOUR-TEXTDOMAIN'),
                'edit_item'                  => __('Edit durations', 'YOUR-TEXTDOMAIN'),
                'update_item'                => __('Update durations', 'YOUR-TEXTDOMAIN'),
                'view_item'                  => __('View durations', 'YOUR-TEXTDOMAIN'),
                'add_new_item'               => __('Add New durations', 'YOUR-TEXTDOMAIN'),
                'new_item_name'              => __('New durations', 'YOUR-TEXTDOMAIN'),
                'separate_items_with_commas' => __('Separate durations with commas', 'YOUR-TEXTDOMAIN'),
                'add_or_remove_items'        => __('Add or remove durations', 'YOUR-TEXTDOMAIN'),
                'choose_from_most_used'      => __('Choose from the most used durations', 'YOUR-TEXTDOMAIN'),
                'not_found'                  => __('No durations found.', 'YOUR-TEXTDOMAIN'),
                'no_terms'                   => __('No durations', 'YOUR-TEXTDOMAIN'),
                'menu_name'                  => __('Durations', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation'      => __('Durations list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'                 => __('Durations list', 'YOUR-TEXTDOMAIN'),
                'most_used'                  => _x('Most Used', 'duration', 'YOUR-TEXTDOMAIN'),
                'back_to_items'              => __('&larr; Back to durations', 'YOUR-TEXTDOMAIN'),
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
        1 => __('Duration added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Duration deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Duration updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Duration not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Duration not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Duration deleted.', 'YOUR-TEXTDOMAIN'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'duration_updated_messages');
