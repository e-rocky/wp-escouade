<?php

/**
 * Registers the `urgent` boolean meta field for 'job-offer' post type.
 */
function job_urgent_meta_init()
{
    register_post_meta('job-offer', 'urgent', [
        'type'              => 'boolean',
        'single'            => true,
        'default'           => false,
        'show_in_rest'      => true,
        'sanitize_callback' => 'rest_sanitize_boolean',
        'auth_callback'     => function () {
            return current_user_can('edit_posts');
        },
    ]);
}
add_action('init', 'job_urgent_meta_init');
