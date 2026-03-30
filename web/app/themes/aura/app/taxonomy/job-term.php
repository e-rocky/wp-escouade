<?php

/**
 * Custom taxonomy
 *
 * @package term
 */

/**
 * Registers the `term` taxonomy,
 * for use with 'job-offer'.
 */
function term_init()
{
    register_taxonomy(
        'mode',
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
                'name'                       => __('Terms', 'YOUR-TEXTDOMAIN'),
                'singular_name'              => _x('Term', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
                'search_items'               => __('Search terms', 'YOUR-TEXTDOMAIN'),
                'popular_items'              => __('Popular terms', 'YOUR-TEXTDOMAIN'),
                'all_items'                  => __('All terms', 'YOUR-TEXTDOMAIN'),
                'parent_item'                => __('Parent terms', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'          => __('Parent terms:', 'YOUR-TEXTDOMAIN'),
                'edit_item'                  => __('Edit terms', 'YOUR-TEXTDOMAIN'),
                'update_item'                => __('Update terms', 'YOUR-TEXTDOMAIN'),
                'view_item'                  => __('View terms', 'YOUR-TEXTDOMAIN'),
                'add_new_item'               => __('Add New terms', 'YOUR-TEXTDOMAIN'),
                'new_item_name'              => __('New terms', 'YOUR-TEXTDOMAIN'),
                'separate_items_with_commas' => __('Separate terms with commas', 'YOUR-TEXTDOMAIN'),
                'add_or_remove_items'        => __('Add or remove terms', 'YOUR-TEXTDOMAIN'),
                'choose_from_most_used'      => __('Choose from the most used terms', 'YOUR-TEXTDOMAIN'),
                'not_found'                  => __('No terms found.', 'YOUR-TEXTDOMAIN'),
                'no_terms'                   => __('No terms', 'YOUR-TEXTDOMAIN'),
                'menu_name'                  => __('Terms', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation'      => __('Terms list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'                 => __('Terms list', 'YOUR-TEXTDOMAIN'),
                'most_used'                  => _x('Most Used', 'term', 'YOUR-TEXTDOMAIN'),
                'back_to_items'              => __('&larr; Back to terms', 'YOUR-TEXTDOMAIN'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'term',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'term_init');

/**
 * Sets the post updated messages for the `term` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `term` taxonomy.
 */
function term_updated_messages($messages)
{

    $messages['term'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Terms added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Terms deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Terms updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Terms not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Terms not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Terms deleted.', 'YOUR-TEXTDOMAIN'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'term_updated_messages');
