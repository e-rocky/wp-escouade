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
          <small class="block">Nous recrutons :</small>
          {!! $title !!}
        </h1>
      </div><!-- .hero-text-block__body -->
    </div><!-- .hero-text-block__content -->
  </div><!-- .hero-text-block -->

  <div class="block breadcrumb-block">
    <div class="breadcrumb-block__content uk-container">
      <div class="breadcrumb-block__body">
        <ul>
          <li><a href="{{ home_url() }}" title="Accueil"><i class="es-icon-home"></i></a></li>
          <li class="separator"><i class="es-icon-caret"></i></li>
          <li><a href="{{ get_permalink(get_page_by_path('carriere-it-madagascar')) }}"
              title="Rejoindre l'Escouade">Rejoindre l'Escouade</a></li>
          <li class="separator"><i class="es-icon-caret"></i></li>
          <li><a href="{{ get_post_type_archive_link('job-offer') }}" title="Nos offres d’emploi">Nos offres
              d’emploi</a></li>
          <li class="separator"><i class="es-icon-caret"></i></li>
          <li><a href="{{ get_permalink() }}" title="{!! $title !!}">{!! $title !!}</a></li>
        </ul>
      </div><!-- .breadcrumb-block__body -->
    </div><!-- .breadcrumb-block__content -->
  </div><!-- .breadcrumb-block -->

  <div class="block job-detail-block">
    <div class="job-detail-block__content uk-container">
      <div class="job-detail-block__body flex flex-col gap-[64px] sm:gap-[76px] md:gap-[88px] lg:gap-[100px]">


        <div class="job-card bgc bgc--4">
          <div
            class="job-card__content flex flex-col lg:grid grid-cols-[1fr_436px] p-[16px] sm:p-[32px] md:p-[48px] lg:p-[64px] gap-[32px] md:gap-[48px] lg:gap-[64px] lg:flex-row-reverse">
            <div class="job-card__header row-start-1 col-start-2 col-span-1">
              <figure class="img-container">
                @if (has_post_thumbnail())
                  <img src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
                @else
                  <img src="{{ asset('resources/images/content/job-detail-bg-1.png') }}" alt="">
                @endif
              </figure>
            </div><!-- .job-card__header -->
            <div class="job-card__body row-start-1 col-start-1 col-span-1">
              <div class="content">
                <div class="flex flex-col gap-[32px]">

                  <div class="flex items-center gap-x-[20px]">
                    <div class="img-container size-[64px]">
                      <img class="my-auto size-full object-cover grid-row-span-2"
                        src="{{ asset('resources/images/design/logo--icon-square.svg') }}" alt="Escouade">
                    </div>
                    <div class="text flex-1">
                      <strong class="title py-0 my-0 my-auto text-[32px]">Escouade</strong>
                      <p class="address my-0">
                        Antananarivo -
                        Madagascar
                      </p>
                    </div><!-- .content -->
                  </div>

                  <h2 class="title title--h2 c--2-1a">{!! $title !!}</h2>
                  <ul class="attributelist m-0 flex flex-wrap gap-[10px]">
                    @php($terms_duration = get_the_terms(get_the_ID(), 'job-duration'))
                    @foreach ($terms_duration as $term_duration)
                      <li><a class="attribute" href="/?s=&post_type=job-offer&job-duration={{ $term_duration->slug }}"
                          title="{{ $term_duration->name }}" style="--bg:#80ACD0">{{ $term_duration->name }}</a>
                      </li>
                    @endforeach


                    @php($terms_workplace = get_the_terms(get_the_ID(), 'job-workplace'))
                    @foreach ($terms_workplace as $term_workplace)
                      <li><a class="attribute"
                          href="/?s=&post_type=job-offer&job-workplace={{ $term_workplace->slug }}"
                          title="{{ $term_workplace->name }}" style="--bg:#9B91B4">{{ $term_workplace->name }}</a>
                      </li>
                    @endforeach

                    @php($urgent = get_post_meta(get_the_ID(), 'urgent', true))
                    @if ($urgent)
                      <li><a class="attribute" href="/?s=&post_type=job-offer&urgent=1" style="--bg:#B97591">Urgent</a>
                      </li>
                    @endif
                  </ul>
                  <div class="grid grid-cols-[24px_1fr] gap-[10px] [&>svg]:size-[24px]">

                    @php($terms_level = get_the_terms(get_the_ID(), 'job-level'))
                    @if ($terms_level)
                      <svg aria-hidden='true'>
                        <use href="{{ asset('resources/images/design/sprite.svg') }}#shield">
                        </use>
                      </svg>
                      <div>
                        Niveau :
                        {{ implode(', ', wp_list_pluck($terms_level, 'name')) }}
                      </div>
                    @endif
                    @php($terms_department = get_the_terms(get_the_ID(), 'job-department'))
                    @if ($terms_department)
                      <svg aria-hidden='true'>
                        <use href="{{ asset('resources/images/design/sprite.svg') }}#category">
                        </use>
                      </svg>
                      <div>Département :
                        {{ implode(', ', wp_list_pluck($terms_department, 'name')) }}</div>
                    @endif

                    @php($terms_language = get_the_terms(get_the_ID(), 'job-language'))
                    @if ($terms_language)
                      <svg aria-hidden='true'>
                        <use href="{{ asset('resources/images/design/sprite.svg') }}#lang">
                        </use>
                      </svg>
                      <div>Langues : {{ implode(', ', wp_list_pluck($terms_language, 'name')) }}
                      </div>
                    @endif

                    @php($terms_location = get_the_terms(get_the_ID(), 'job-location'))
                    @if ($terms_location)
                      <svg aria-hidden='true'>
                        <use href="{{ asset('resources/images/design/sprite.svg') }}#pin">
                        </use>
                      </svg>
                      <div>Lieu : {{ implode(', ', wp_list_pluck($terms_location, 'name')) }}
                      </div>
                    @endif
                  </div>
                </div>
              </div>
            </div><!-- .job-card__body -->

            <div class="job-card__body col-span-2">
              <hr class="my-[20px]">
              <div class="flex flex-col-reverse sm:flex-row items-start items-stretch gap-[16px] justify-between">
                <div class="actions flex items-stretch gap-[20px]">
                  <button class="btn c--4 bgc--2 btn-shadow-sm" href="#" title="Je postule"
                    data-uk-toggle="target: #modal-job-application-form">Je postule<i
                      class="es-icon-chevron-right"></i></button>
                  <button class="btn share-btn c--4 bgc--5 btn-shadow-sm" title="Partager"
                    data-uk-toggle="target: #modal-share"><i class="es-icon-share"></i></button>
                </div>
                <div class="flex items-center flex-row sm:flex-row-reverse [&>svg]:size-[24px] gap-[10px]">
                  <svg aria-hidden='true'>
                    <use href="{{ asset('resources/images/design/sprite.svg') }}#time"></use>
                  </svg>
                  <div class="text-left md:text-right">
                    Publié il y a
                    {{ human_time_diff(get_the_time('U'), current_time('timestamp')) }}
                  </div>
                </div>
              </div>
              <hr class="my-[20px]">
            </div><!-- .job-card__body -->

            @php(the_content())

            @php($terms_stack = get_the_terms(get_the_ID(), 'job-stack'))
            @if ($terms_stack)
              <article class="bg flex flex-col gap-[32px] ">
                <h2 class="title title--h4 c--3">Compétences techniques</h2>
                <div class="text rte">
                  <ul>
                    @foreach ($terms_stack as $term)
                      <li>{{ $term->name }}</li>
                    @endforeach
                  </ul>
                  @php($annotation = get_post_meta(get_the_ID(), 'annotation', true))
                  @if ($annotation)
                    <p>{{ $annotation }}</p>
                  @endif
                </div>
              </article>
            @endif

            @php(dynamic_sidebar('sidebar-job-offer-our-benefits'))


            <div class="actions col-span-2 flex justify-end items-stretch gap-[20px]">
              <a class="btn c--1a-2 underline" href="#" title="Voir l’offre">Retourner à la liste
                les offres</a>
              <a class="btn c--4 bgc--5-2 btn-shadow-sm" href="#" title="Je postule ">Je postule <i
                  class="es-icon-chevron-right"></i></a>
            </div>


          </div><!-- .job-card__content -->
        </div><!-- .job-card -->


      </div><!-- .job-detail-block__body -->

    </div><!-- .job-detail-block__content -->
  </div><!-- .job-detail-block -->

  @php(dynamic_sidebar('content-footer'))


  @php(comments_template())
</article>
