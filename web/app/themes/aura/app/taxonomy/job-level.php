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
        'job-level',
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
                'name'                       => __('Levels', 'YOUR-TEXTDOMAIN'),
                'singular_name'              => _x('Level', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
                'search_items'               => __('Search levels', 'YOUR-TEXTDOMAIN'),
                'popular_items'              => __('Popular levels', 'YOUR-TEXTDOMAIN'),
                'all_items'                  => __('All levels', 'YOUR-TEXTDOMAIN'),
                'parent_item'                => __('Parent levels', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'          => __('Parent levels:', 'YOUR-TEXTDOMAIN'),
                'edit_item'                  => __('Edit levels', 'YOUR-TEXTDOMAIN'),
                'update_item'                => __('Update levels', 'YOUR-TEXTDOMAIN'),
                'view_item'                  => __('View levels', 'YOUR-TEXTDOMAIN'),
                'add_new_item'               => __('Add New levels', 'YOUR-TEXTDOMAIN'),
                'new_item_name'              => __('New levels', 'YOUR-TEXTDOMAIN'),
                'separate_items_with_commas' => __('Separate levels with commas', 'YOUR-TEXTDOMAIN'),
                'add_or_remove_items'        => __('Add or remove levels', 'YOUR-TEXTDOMAIN'),
                'choose_from_most_used'      => __('Choose from the most used levels', 'YOUR-TEXTDOMAIN'),
                'not_found'                  => __('No levels found.', 'YOUR-TEXTDOMAIN'),
                'no_terms'                   => __('No levels', 'YOUR-TEXTDOMAIN'),
                'menu_name'                  => __('Levels', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation'      => __('Levels list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'                 => __('Levels list', 'YOUR-TEXTDOMAIN'),
                'most_used'                  => _x('Most Used', 'level', 'YOUR-TEXTDOMAIN'),
                'back_to_items'              => __('&larr; Back to levels', 'YOUR-TEXTDOMAIN'),
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

    $messages['job-level'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Level added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Level deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Level updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Level not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Level not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Level deleted.', 'YOUR-TEXTDOMAIN'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'level_updated_messages');
