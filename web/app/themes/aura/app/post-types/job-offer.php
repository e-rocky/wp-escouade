<?php

/**
 * Custom post type
 *
 * @package aura
 */

/**
 * Exclude the `job_offer` post type's archive from the sitemap.
 */
add_filter('rank_math/sitemap/post_type_archive_link', function ($url, $post_type) {
    // Exclure l'archive du CPT 'job-offer' du sitemap
    if ($post_type === 'job-offer') {
        return false;
    }
    return $url;
}, 10, 2);

/*
    * Translate the `job_offer` post type's slug based on the current locale.
*/
add_filter('register_post_type_args', 'translate_cpt_slug', 10, 2);
function translate_cpt_slug($args, $post_type)
{
    if ($post_type === 'job-offer') {
        $locale = get_locale();
        $args['rewrite'] = array(
            'slug' => match ($locale) {
                'es_ES' => 'ofertas-de-empleo',
                'fr_FR' => 'offres-d-emploi',
                default => 'job-offers',
            },
            'with_front' => false,
        );
    }
    return $args;
}



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
            'supports'              => array('title', 'editor', 'thumbnail'),
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

add_action('wp_enqueue_scripts', function () {
    wp_add_inline_script(
        'wp-blocks',
        'window.aura = ' . json_encode([
            'taxonomy' => [
                'jobWorkplace' => get_terms([
                    'taxonomy' => 'job-workplace',
                    'hide_empty' => false,
                ]),
                'jobStack' => get_terms([
                    'taxonomy' => 'job-stack',
                    'hide_empty' => false,
                ]),
                'jobLocation' => get_terms([
                    'taxonomy' => 'job-location',
                    'hide_empty' => false,
                ]),
                'jobLevel' => get_terms([
                    'taxonomy' => 'job-level',
                    'hide_empty' => false,
                ]),
                'jobLanguage' => get_terms([
                    'taxonomy' => 'job-language',
                    'hide_empty' => false,
                ]),
                'jobDuration' => get_terms([
                    'taxonomy' => 'job-duration',
                    'hide_empty' => false,
                ]),
                'jobDepartment' => get_terms([
                    'taxonomy' => 'job-department',
                    'hide_empty' => false,
                ]),
            ],
        ]) . ';',
        'before'
    );
});

// Ajouter la meta box
add_action('add_meta_boxes', function () {
    add_meta_box(
        'job_offer_options',            // ID unique
        'Options supplémentaires',      // Titre affiché
        'job_offer_options_html',       // Callback qui affiche le contenu
        'job-offer',                    // Post type
        'side',                         // Position : 'normal', 'side', 'advanced'
        'high'                          // Priorité : 'high', 'default', 'low'
    );
});

// Contenu de la meta box Options
function job_offer_options_html($post)
{
    wp_nonce_field('job_offer_options_save', 'job_offer_options_nonce');
    $urgent     = get_post_meta($post->ID, 'urgent', true);
    $annotation = get_post_meta($post->ID, 'annotation', true);
?>
    <label>
        <input type="checkbox" name="urgent" value="1" <?php checked($urgent, '1'); ?> />
        Offre urgente
    </label>
    <br><br>
    <label>
        Annotation<br>
        <textarea name="annotation" rows="5" style="width:100%"><?php echo esc_textarea($annotation); ?></textarea>
    </label>
<?php
}



// Sauvegarder la valeur
add_action('save_post_job-offer', function ($post_id) {
    if (
        ! isset($_POST['job_offer_options_nonce']) ||
        ! wp_verify_nonce($_POST['job_offer_options_nonce'], 'job_offer_options_save') ||
        defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ||
        ! current_user_can('edit_post', $post_id)
    ) {
        return;
    }

    update_post_meta($post_id, 'urgent', isset($_POST['urgent']) ? '1' : '0');
    update_post_meta($post_id, 'annotation', sanitize_textarea_field($_POST['annotation'] ?? ''));
});
