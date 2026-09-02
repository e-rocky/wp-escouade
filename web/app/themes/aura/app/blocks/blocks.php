<?php

add_filter('render_block_create-block/job-advertising-block', function ($block_content, $block) {
    $dom = new DOMDocument();
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8' . get_the_content());
    libxml_clear_errors();

    $dom->loadHTML(
        '<?xml encoding="utf-8" ?>' . $block_content
    );
    $xpath = new DOMXPath($dom);

    // Cible: .job-advertising-card__body .img-container img
    $nodes = $xpath->query(
        "//*[contains(concat(' ', normalize-space(@class), ' '), ' job-advertising-card__header ')]" .
            "//*[contains(concat(' ', normalize-space(@class), ' '), ' img-container ')]//img"
    );

    if ($nodes !== false) {
        foreach ($nodes as $img) {
            // Remplacement des attributs (exemple)
            $img->setAttribute('src', \Roots\asset('resources/images/design/logo--text.svg')->uri());
        }
    }

    $block_content = $dom->saveHTML();

    libxml_clear_errors();
    $jobs = get_posts([
        'post_type'      => 'job-offer',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);

    $img = [
        "resources/images/content/job-advertising-img-1.png",
        "resources/images/content/job-advertising-img-2.png",
        "resources/images/content/job-advertising-img-3.png"
    ];

    shuffle($img);

    $html = '';

    if ($jobs) {
        foreach ($jobs as $index => $job) {
            $html .= '<div class="slide card job-advertising-card">
                <a href="' . get_permalink($job) . '" class="job-advertising-card__content c--4" title="' . esc_html(get_the_title($job)) . '">
                  <div class="job-advertising-card__header">
                    <figure class="img-container">
                      <img src="' . \Roots\asset('resources/images/design/logo--text.svg')->uri() . '" alt="' . esc_html(get_the_title($job)) . '">
                    </figure>
                  </div><!-- .card-header -->
                  <div class="job-advertising-card__body">
                    <strong class="title--overline">Nous recrutons</strong>
                    <h3 class="title color-inherit">
                      ' . esc_html(get_the_title($job)) . '
                    </h3>
                    <figure class="img-container">
                      <img src="' . \Roots\asset($img[$index])->uri() . '" alt="' . esc_html(get_the_title($job)) . '">
                    </figure>
                  </div><!-- .job-advertising-card__body -->
                </a><!-- .job-advertising-card__content -->
              </div><!-- .job-advertising-card -->';
        }

        // Injecter dans le div .latestEntries
        $block_content = preg_replace(
            '/(<div[^>]*class=\"[^\"]*latestEntries[^\"]*\"[^>]*>)/',
            '$1' . $html,
            $block_content,
            1
        );
    }


    // $block_content = HTML du bloc
    // $block['attrs'] = attributs du bloc
    return $block_content;
}, 10, 2);

function aura_register_blocks()
{
    wp_register_block_types_from_metadata_collection(
        __DIR__ . '/build',
        __DIR__ . '/build/blocks-manifest.php'
    );
}
add_action('init', 'aura_register_blocks');
