<?php

/**
 * Custom taxonomy
 *
 * @package department
 */

/**
 * Registers the `job-department` taxonomy,
 * for use with 'job-offer'.
 */
function department_init()
{
    register_taxonomy(
        'job-department',
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
                'name'                       => __('Departments', 'aura'),
                'singular_name'              => _x('Department', 'taxonomy general name', 'aura'),
                'search_items'               => __('Search departments', 'aura'),
                'popular_items'              => __('Popular departments', 'aura'),
                'all_items'                  => __('All departments', 'aura'),
                'parent_item'                => __('Parent department', 'aura'),
                'parent_item_colon'          => __('Parent department:', 'aura'),
                'edit_item'                  => __('Edit department', 'aura'),
                'update_item'                => __('Update department', 'aura'),
                'view_item'                  => __('View department', 'aura'),
                'add_new_item'               => __('Add New department', 'aura'),
                'new_item_name'              => __('New department', 'aura'),
                'separate_items_with_commas' => __('Separate departments with commas', 'aura'),
                'add_or_remove_items'        => __('Add or remove departments', 'aura'),
                'choose_from_most_used'      => __('Choose from the most used departments', 'aura'),
                'not_found'                  => __('No departments found.', 'aura'),
                'no_terms'                   => __('No departments', 'aura'),
                'menu_name'                  => __('Departments', 'aura'),
                'items_list_navigation'      => __('Departments list navigation', 'aura'),
                'items_list'                 => __('Departments list', 'aura'),
                'most_used'                  => _x('Most Used', 'department', 'aura'),
                'back_to_items'              => __('&larr; Back to departments', 'aura'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'department',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'department_init');

/**
 * Sets the post updated messages for the `job-department` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `job-department` taxonomy.
 */
function department_updated_messages($messages)
{
    $messages['job-department'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Department added.', 'aura'),
        2 => __('Department deleted.', 'aura'),
        3 => __('Department updated.', 'aura'),
        4 => __('Department not added.', 'aura'),
        5 => __('Department not updated.', 'aura'),
        6 => __('Department deleted.', 'aura'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'department_updated_messages');
