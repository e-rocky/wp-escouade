<?php

/**
 * Custom taxonomy
 *
 * @package contract
 */

/**
 * Registers the `contract` taxonomy,
 * for use with 'job-offer'.
 */
function contract_init()
{
    register_taxonomy(
        'contract',
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
                'name'                       => __('Contracts', 'YOUR-TEXTDOMAIN'),
                'singular_name'              => _x('Contract', 'taxonomy general name', 'YOUR-TEXTDOMAIN'),
                'search_items'               => __('Search contracts', 'YOUR-TEXTDOMAIN'),
                'popular_items'              => __('Popular contracts', 'YOUR-TEXTDOMAIN'),
                'all_items'                  => __('All contracts', 'YOUR-TEXTDOMAIN'),
                'parent_item'                => __('Parent contracts', 'YOUR-TEXTDOMAIN'),
                'parent_item_colon'          => __('Parent contracts:', 'YOUR-TEXTDOMAIN'),
                'edit_item'                  => __('Edit contracts', 'YOUR-TEXTDOMAIN'),
                'update_item'                => __('Update contracts', 'YOUR-TEXTDOMAIN'),
                'view_item'                  => __('View contracts', 'YOUR-TEXTDOMAIN'),
                'add_new_item'               => __('Add New contracts', 'YOUR-TEXTDOMAIN'),
                'new_item_name'              => __('New contracts', 'YOUR-TEXTDOMAIN'),
                'separate_items_with_commas' => __('Separate contracts with commas', 'YOUR-TEXTDOMAIN'),
                'add_or_remove_items'        => __('Add or remove contracts', 'YOUR-TEXTDOMAIN'),
                'choose_from_most_used'      => __('Choose from the most used contracts', 'YOUR-TEXTDOMAIN'),
                'not_found'                  => __('No contracts found.', 'YOUR-TEXTDOMAIN'),
                'no_terms'                   => __('No contracts', 'YOUR-TEXTDOMAIN'),
                'menu_name'                  => __('Contracts', 'YOUR-TEXTDOMAIN'),
                'items_list_navigation'      => __('Contracts list navigation', 'YOUR-TEXTDOMAIN'),
                'items_list'                 => __('Contracts list', 'YOUR-TEXTDOMAIN'),
                'most_used'                  => _x('Most Used', 'contract', 'YOUR-TEXTDOMAIN'),
                'back_to_items'              => __('&larr; Back to contracts', 'YOUR-TEXTDOMAIN'),
            ),
            'show_in_rest'          => true,
            'rest_base'             => 'contract',
            'rest_controller_class' => 'WP_REST_Terms_Controller',
        )
    );
}

add_action('init', 'contract_init');

/**
 * Sets the post updated messages for the `contract` taxonomy.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `contract` taxonomy.
 */
function contract_updated_messages($messages)
{

    $messages['contract'] = array(
        0 => '', // Unused. Messages start at index 1.
        1 => __('Contrats added.', 'YOUR-TEXTDOMAIN'),
        2 => __('Contrats deleted.', 'YOUR-TEXTDOMAIN'),
        3 => __('Contrats updated.', 'YOUR-TEXTDOMAIN'),
        4 => __('Contrats not added.', 'YOUR-TEXTDOMAIN'),
        5 => __('Contrats not updated.', 'YOUR-TEXTDOMAIN'),
        6 => __('Contrats deleted.', 'YOUR-TEXTDOMAIN'),
    );

    return $messages;
}

add_filter('term_updated_messages', 'contract_updated_messages');
