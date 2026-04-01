<?php

/**
 * Custom taxonomy
 *
 * @package stack
 */

/**
 * Registers the `job-stack` taxonomy,
 * for use with 'job-offer'.
 */
function stack_init()
{
    register_taxonomy(
        'job-stack',
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
                'name'                       => __('Stacks', 'aura'),
                'singular_name'              => _x('Stack', 'taxonomy general name', 'aura'),
                'search_items'               => __('Search stacks', 'aura'),
                'popular_items'              => __('Popular stacks', 'aura'),
                'all_items'                  => __('All stacks', 'aura'),
                'parent_item'                => __('Parent stack', 'aura'),
                'parent_item_colon'          => __('Parent stack:', 'aura'),
                'edit_item'                  => __('Edit stack', 'aura'),
                'update_item'                => __('Update stack', 'aura'),
                'view_item'                  => __('View stack', 'aura'),
                'add_new_item'               => __('Add New stack', 'aura'),
                'new_item_name'              => __('New stack', 'aura'),
                'separate_items_with_commas' => __('Separate stacks with commas', 'aura'),
                'add_or_remove_items'        => __('Add or remove stacks', 'aura'),
                'choose_from_most_used'      => __('Choose from the most used stacks', 'aura'),
                'not_found'                  => __('No stacks found.', 'aura'),
                'no_terms'                   => __('No stacks', 'aura'),
                'menu_name'                  => __('Stacks', 'aura'),
                'items_list_navigation'      => __('Stacks list navigation', 'aura'),
                'items_list'                 => __('Stacks list', 'aura'),
                'most_used'                  => _x('Most Used', 'stack', 'aura'),
                'back_to_items'              => __('&larr; Back to stacks', 'aura'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'stack',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'stack_init');

/**
 * Sets the post updated messages for the `job-stack` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `job-stack` taxonomy.
 */
function stack_updated_messages($messages)
{
    $messages['job-stack'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Stack added.', 'aura'),
        2 => __('Stack deleted.', 'aura'),
        3 => __('Stack updated.', 'aura'),
        4 => __('Stack not added.', 'aura'),
        5 => __('Stack not updated.', 'aura'),
        6 => __('Stack deleted.', 'aura'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'stack_updated_messages');
