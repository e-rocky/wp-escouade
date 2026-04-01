<?php

/**
 * Custom taxonomy
 *
 * @package workplace
 */

/**
 * Registers the `term` taxonomy,
 * for use with 'job-offer'.
 */
function workplace_init()
{
    register_taxonomy(
        'job-workplace',
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
                'name'                       => __('Workplaces', 'aura'),
                'singular_name'              => _x('Workplace', 'taxonomy general name', 'aura'),
                'search_items'               => __('Search workplaces', 'aura'),
                'popular_items'              => __('Popular workplaces', 'aura'),
                'all_items'                  => __('All workplaces', 'aura'),
                'parent_item'                => __('Parent workplaces', 'aura'),
                'parent_item_colon'          => __('Parent workplaces:', 'aura'),
                'edit_item'                  => __('Edit workplace', 'aura'),
                'update_item'                => __('Update workplace', 'aura'),
                'view_item'                  => __('View workplace', 'aura'),
                'add_new_item'               => __('Add New workplace', 'aura'),
                'new_item_name'              => __('New workplace', 'aura'),
                'separate_items_with_commas' => __('Separate workplaces with commas', 'aura'),
                'add_or_remove_items'        => __('Add or remove workplaces', 'aura'),
                'choose_from_most_used'      => __('Choose from the most used workplaces', 'aura'),
                'not_found'                  => __('No workplaces found.', 'aura'),
                'no_terms'                   => __('No workplaces', 'aura'),
                'menu_name'                  => __('Workplaces', 'aura'),
                'items_list_navigation'      => __('Workplaces list navigation', 'aura'),
                'items_list'                 => __('Workplaces list', 'aura'),
                'most_used'                  => _x('Most Used', 'workplace', 'aura'),
                'back_to_items'              => __('&larr; Back to workplaces', 'aura'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'workplace',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'workplace_init');

/**
 * Sets the post updated messages for the `workplace` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `workplace` taxonomy.
 */
function workplace_updated_messages($messages)
{

    $messages['job-workplace'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Workplaces added.', 'aura'),
        2 => __('Workplaces deleted.', 'aura'),
        3 => __('Workplaces updated.', 'aura'),
        4 => __('Workplaces not added.', 'aura'),
        5 => __('Workplaces not updated.', 'aura'),
        6 => __('Workplaces deleted.', 'aura'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'workplace_updated_messages');
