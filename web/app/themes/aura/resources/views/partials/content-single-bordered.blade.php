<article @php(post_class('h-entry'))>


  <div class="block hero-text-block bgi bgi--4">
    <div class="hero-text-block__background">
      <div class="img-container">
        @if (has_post_thumbnail())
          <img src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
        @else
          <img src="{{ asset('resources/images/content/job-detail-bg-1.png') }}" alt="">
        @endif
      </div>
    </div><!-- .hero-text-block__background -->
    <div class="hero-text-block__content min-h-[60vh] gap-[70px] uk-container" uk-scrollspy="cls:uk-animation-fade"
      data-uk-parallax="x: 100vw; opacity: 1, 0;  start: 0; end: 10vh; blur: 0, 30px;">
      <div class="hero-text-block__body justify-end mt-auto">
        <h1 class="title title--h1 rte rte--em-c-5 c--4 text-left">
          {!! $title !!}
        </h1>
      </div><!-- .hero-text-block__body -->
    </div><!-- .hero-text-block__content -->
  </div><!-- .hero-text-block -->

  <div class="block breadcrumb-block">
    <div class="breadcrumb-block__content uk-container">
      <div class="breadcrumb-block__body">
        <ul>
          <li><a href="#" title="Accueil"><i class="es-icon-home"></i></a></li>
          <li class="separator"><i class="es-icon-caret"></i></li>
          <li><a href="#" title="{!! $title !!}">{!! $title !!}</a></li>
        </ul>
      </div><!-- .breadcrumb-block__body -->
    </div><!-- .breadcrumb-block__content -->
  </div><!-- .breadcrumb-block -->


  <div class="block content-block">
    <div class="content-block__content uk-container">
      <div class="content-block__body">

        <div class="card content-card bgc bgc--4">
          <div
            class="content-card__content job-card__content flex flex-col lg:grid grid-cols-[1fr_436px] p-[16px] sm:p-[32px] md:p-[48px] lg:p-[64px]">
            <div class="content-card__body text rte">
              @php(the_content())
            </div><!-- .content-card__body -->

            <div class="content-card__header">
              <div class="pb-[32px] z-1" data-uk-sticky="offset: 100; end:.content-card">
                <nav class="summary bg">
                  <h2 class="title title--h4 c--3 mb-5">Table des matières</h2>
                  <div class="rte">
                    <ul class="uk-nav uk-nav-default flex flex-col gap-2"
                      data-uk-scrollspy-nav="closest: li; scroll: true; offset: 100">
                    </ul>
                  </div>
                </nav>
              </div>
            </div>

            <div class="content-card__footer"></div>

          </div><!-- .content-card__content -->
        </div><!-- .content-card -->

      </div><!-- .content-block__body -->
    </div><!-- .content-block__content -->
  </div><!-- .content-block -->

  @php(dynamic_sidebar('content-footer'))


  @php(comments_template())
</article>
