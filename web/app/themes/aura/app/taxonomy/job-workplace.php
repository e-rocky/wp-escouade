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
                'name'                       => __('Workplaces', 'YOUR-TEXTDOMAIN'),
                'singular_name'              => _x('Workplace', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
                'search_items'               => __('Search workplaces', 'YOUR-TEXTDOMAIN'),
                'popular_items'              => __('Popular workplaces', 'YOUR-TEXTDOMAIN'),
                'all_items'                  => __('All workplaces', 'YOUR-TEXTDOMAIN'),
                'parent_item'                => __('Parent workplaces', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'          => __('Parent workplaces:', 'YOUR-TEXTDOMAIN'),
                'edit_item'                  => __('Edit workplace', 'YOUR-TEXTDOMAIN'),
                'update_item'                => __('Update workplace', 'YOUR-TEXTDOMAIN'),
                'view_item'                  => __('View workplace', 'YOUR-TEXTDOMAIN'),
                'add_new_item'               => __('Add New workplace', 'YOUR-TEXTDOMAIN'),
                'new_item_name'              => __('New workplace', 'YOUR-TEXTDOMAIN'),
                'separate_items_with_commas' => __('Separate workplaces with commas', 'YOUR-TEXTDOMAIN'),
                'add_or_remove_items'        => __('Add or remove workplaces', 'YOUR-TEXTDOMAIN'),
                'choose_from_most_used'      => __('Choose from the most used workplaces', 'YOUR-TEXTDOMAIN'),
                'not_found'                  => __('No workplaces found.', 'YOUR-TEXTDOMAIN'),
                'no_terms'                   => __('No workplaces', 'YOUR-TEXTDOMAIN'),
                'menu_name'                  => __('Workplaces', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation'      => __('Workplaces list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'                 => __('Workplaces list', 'YOUR-TEXTDOMAIN'),
                'most_used'                  => _x('Most Used', 'workplace', 'YOUR-TEXTDOMAIN'),
                'back_to_items'              => __('&larr; Back to workplaces', 'YOUR-TEXTDOMAIN'),
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
        1 => __('Workplaces added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Workplaces deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Workplaces updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Workplaces not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Workplaces not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Workplaces deleted.', 'YOUR-TEXTDOMAIN'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'workplace_updated_messages');
