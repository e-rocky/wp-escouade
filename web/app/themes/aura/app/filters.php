<?php

/**
 * Theme filters.
 */

namespace App;

/**
 * Add "… Continued" to the excerpt.
 *
 * @return string
 */
add_filter('excerpt_more', function () {
    return sprintf(' &hellip; <a href="%s">%s</a>', get_permalink(), __('Continued', 'sage'));
});

/**
 * Filter job offers by urgency.
 */
add_action('pre_get_posts', function ($query) {
    if (is_admin() || ! $query->is_main_query()) {
        return;
    }

    $urgent = isset($_GET['urgent']) ? sanitize_text_field(wp_unslash($_GET['urgent'])) : null;

    if ($urgent !== '1') {
        return;
    }

    $postType = $query->get('post_type');

    if ($postType && $postType !== 'job-offer' && (! is_array($postType) || ! in_array('job-offer', $postType, true))) {
        return;
    }

    $metaQuery = $query->get('meta_query');

    if (! is_array($metaQuery)) {
        $metaQuery = [];
    }

    $metaQuery[] = [
        'key' => 'urgent',
        'value' => '1',
        'compare' => '=',
    ];

    $query->set('meta_query', $metaQuery);
});
