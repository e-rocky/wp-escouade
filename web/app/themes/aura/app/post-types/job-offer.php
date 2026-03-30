<?php

/**
 * Custom post type
 *
 * @package 1
 */

/**
 * Registers the `job_offer` post type.
 */
function aura_job_offer_init()
{
    register_post_type(
        'job-offer',
        array(
            'labels'                => array(
                'name'                  => __('Job Offers', 'aura'),
                'singular_name'         => __('Job Offer', 'aura'),
                'all_items'             => __('All Job Offers', 'aura'),
                'archives'              => __('Job Offer Archives', 'aura'),
                'attributes'            => __('Job Offer Attributes', 'aura'),
                'insert_into_item'      => __('Insert into Job Offer', 'aura'),
                'uploaded_to_this_item' => __('Uploaded to this Job Offer', 'aura'),
                'featured_image'        => _x('Featured Image', 'job-offer', 'aura'),
                'set_featured_image'    => _x('Set featured image', 'job-offer', 'aura'),
                'remove_featured_image' => _x('Remove featured image', 'job-offer', 'aura'),
                'use_featured_image'    => _x('Use as featured image', 'job-offer', 'aura'),
                'filter_items_list'     => __('Filter Job Offers list', 'aura'),
                'items_list_navigation' => __('Job Offers list navigation', 'aura'),
                'items_list'            => __('Job Offers list', 'aura'),
                'new_item'              => __('New Job Offer', 'aura'),
                'add_new'               => __('Add New', 'aura'),
                'add_new_item'          => __('Add New Job Offer', 'aura'),
                'edit_item'             => __('Edit Job Offer', 'aura'),
                'view_item'             => __('View Job Offer', 'aura'),
                'view_items'            => __('View Job Offers', 'aura'),
                'search_items'          => __('Search Job Offers', 'aura'),
                'not_found'             => __('No Job Offers found', 'aura'),
                'not_found_in_trash'    => __('No Job Offers found in trash', 'aura'),
                'parent_item_colon'     => __('Parent Job Offer:', 'aura'),
                'menu_name'             => __('Job Offers', 'aura'),
            ),
            'public'                => true,
            'hierarchical'          => false,
            'show_ui'               => true,
            'show_in_nav_menus'     => true,
            'supports'              => array('title', 'editor'),
            'has_archive'           => true,
            'rewrite'               => true,
            'query_var'             => true,
            'menu_position'         => null,
            'menu_icon'             => 'dashicons-id-alt',
            'show_in_rest'          => true,
            'rest_base'             => 'job-offer',
            'rest_controller_class' => 'WP_REST_Posts_Controller',
        )
    );
}

add_action('init', 'aura_job_offer_init');

/**
 * Sets the post updated messages for the `job_offer` post type.
 *
 * @param  array $messages Post updated messages.
 * @return array Messages for the `job_offer` post type.
 */
function aura_job_offer_updated_messages($messages)
{
    global $post;

    $permalink = get_permalink($post);

    $messages['job-offer'] = array(
        0  => '', // Unused. Messages start at index 1.
        /* translators: %s: post permalink */
        1  => sprintf(__('Job Offer updated. <a target="_blank" href="%s">View Job Offer</a>', 'aura'), esc_url($permalink)),
        2  => __('Custom field updated.', 'aura'),
        3  => __('Custom field deleted.', 'aura'),
        4  => __('Job Offer updated.', 'aura'),
        /* translators: %s: date and time of the revision */
        5  => isset($_GET['revision']) ? sprintf(__('Job Offer restored to revision from %s', 'aura'), wp_post_revision_title((int) $_GET['revision'], false)) : false, // phpcs:ignore WordPress.Security.NonceVerification.Recommended
        /* translators: %s: post permalink */
        6  => sprintf(__('Job Offer published. <a href="%s">View Job Offer</a>', 'aura'), esc_url($permalink)),
        7  => __('Job Offer saved.', 'aura'),
        /* translators: %s: post permalink */
        8  => sprintf(__('Job Offer submitted. <a target="_blank" href="%s">Preview Job Offer</a>', 'aura'), esc_url(add_query_arg('preview', 'true', $permalink))),
        /* translators: 1: Publish box date format, see https://secure.php.net/date 2: Post permalink */
        9  => sprintf(__('Job Offer scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Job Offer</a>', 'aura'), date_i18n(__('M j, Y @ G:i', 'aura'), strtotime($post->post_date)), esc_url($permalink)),
        /* translators: %s: post permalink */
        10 => sprintf(__('Job Offer draft updated. <a target="_blank" href="%s">Preview Job Offer</a>', 'aura'), esc_url(add_query_arg('preview', 'true', $permalink))),
    );

    return $messages;
}

add_filter('post_updated_messages', 'aura_job_offer_updated_messages');

/**
 * Sets the bulk post updated messages for the `job_offer` post type.
 *
 * @param  array $bulk_messages Arrays of messages, each keyed by the corresponding post type. Messages are
 *                              keyed with 'updated', 'locked', 'deleted', 'trashed', and 'untrashed'.
 * @param  int[] $bulk_counts   Array of item counts for each message, used to build internationalized strings.
 * @return array Bulk messages for the `job_offer` post type.
 */
function aura_job_offer_bulk_updated_messages($bulk_messages, $bulk_counts)
{
    global $post;

    $bulk_messages['job-offer'] = array(
        /* translators: %s: Number of Job Offers. */
        'updated'   => _n('%s Job Offer updated.', '%s Job Offers updated.', $bulk_counts['updated'], 'aura'),
        'locked'    => (1 === $bulk_counts['locked']) ? __('1 Job Offer not updated, somebody is editing it.', 'aura') :
            /* translators: %s: Number of Job Offers. */
            _n('%s Job Offer not updated, somebody is editing it.', '%s Job Offers not updated, somebody is editing them.', $bulk_counts['locked'], 'aura'),
        /* translators: %s: Number of Job Offers. */
        'deleted'   => _n('%s Job Offer permanently deleted.', '%s Job Offers permanently deleted.', $bulk_counts['deleted'], 'aura'),
        /* translators: %s: Number of Job Offers. */
        'trashed'   => _n('%s Job Offer moved to the Trash.', '%s Job Offers moved to the Trash.', $bulk_counts['trashed'], 'aura'),
        /* translators: %s: Number of Job Offers. */
        'untrashed' => _n('%s Job Offer restored from the Trash.', '%s Job Offers restored from the Trash.', $bulk_counts['untrashed'], 'aura'),
    );

    return $bulk_messages;
}

add_filter('bulk_post_updated_messages', 'aura_job_offer_bulk_updated_messages', 10, 2);
