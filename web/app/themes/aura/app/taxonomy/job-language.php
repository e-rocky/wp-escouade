<?php

/**
 * Custom taxonomy
 *
 * @package language
 */

/**
 * Registers the `job-language` taxonomy,
 * for use with 'job-offer'.
 */
function language_init()
{
    register_taxonomy(
        'job-language',
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
                'name'                       => __('Languages', 'aura'),
                'singular_name'              => _x('Language', 'taxonomy general name', 'aura'),
                'search_items'               => __('Search languages', 'aura'),
                'popular_items'              => __('Popular languages', 'aura'),
                'all_items'                  => __('All languages', 'aura'),
                'parent_item'                => __('Parent languages', 'aura'),
                'parent_item_colon'          => __('Parent languages:', 'aura'),
                'edit_item'                  => __('Edit language', 'aura'),
                'update_item'                => __('Update language', 'aura'),
                'view_item'                  => __('View language', 'aura'),
                'add_new_item'               => __('Add New language', 'aura'),
                'new_item_name'              => __('New language', 'aura'),
                'separate_items_with_commas' => __('Separate languages with commas', 'aura'),
                'add_or_remove_items'        => __('Add or remove languages', 'aura'),
                'choose_from_most_used'      => __('Choose from the most used languages', 'aura'),
                'not_found'                  => __('No languages found.', 'aura'),
                'no_terms'                   => __('No languages', 'aura'),
                'menu_name'                  => __('Languages', 'aura'),
                'items_list_navigation'      => __('Languages list navigation', 'aura'),
                'items_list'                 => __('Languages list', 'aura'),
                'most_used'                  => _x('Most Used', 'language', 'aura'),
                'back_to_items'              => __('&larr; Back to languages', 'aura'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'language',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'language_init');

/**
 * Sets the post updated messages for the `job-language` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `job-language` taxonomy.
 */
function language_updated_messages($messages)
{
    $messages['job-language'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Language added.', 'aura'),
        2 => __('Language deleted.', 'aura'),
        3 => __('Language updated.', 'aura'),
        4 => __('Language not added.', 'aura'),
        5 => __('Language not updated.', 'aura'),
        6 => __('Language deleted.', 'aura'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'language_updated_messages');
