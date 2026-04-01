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
                'name'                       => __('Levels', 'aura'),
                'singular_name'              => _x('Level', 'taxonomy general name', 'aura'),
                'search_items'               => __('Search levels', 'aura'),
                'popular_items'              => __('Popular levels', 'aura'),
                'all_items'                  => __('All levels', 'aura'),
                'parent_item'                => __('Parent levels', 'aura'),
                'parent_item_colon'          => __('Parent levels:', 'aura'),
                'edit_item'                  => __('Edit levels', 'aura'),
                'update_item'                => __('Update levels', 'aura'),
                'view_item'                  => __('View levels', 'aura'),
                'add_new_item'               => __('Add New levels', 'aura'),
                'new_item_name'              => __('New levels', 'aura'),
                'separate_items_with_commas' => __('Separate levels with commas', 'aura'),
                'add_or_remove_items'        => __('Add or remove levels', 'aura'),
                'choose_from_most_used'      => __('Choose from the most used levels', 'aura'),
                'not_found'                  => __('No levels found.', 'aura'),
                'no_terms'                   => __('No levels', 'aura'),
                'menu_name'                  => __('Levels', 'aura'),
                'items_list_navigation'      => __('Levels list navigation', 'aura'),
                'items_list'                 => __('Levels list', 'aura'),
                'most_used'                  => _x('Most Used', 'level', 'aura'),
                'back_to_items'              => __('&larr; Back to levels', 'aura'),
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
        1 => __('Level added.', 'aura'),
        2 => __('Level deleted.', 'aura'),
        3 => __('Level updated.', 'aura'),
        4 => __('Level not added.', 'aura'),
        5 => __('Level not updated.', 'aura'),
        6 => __('Level deleted.', 'aura'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'level_updated_messages');
