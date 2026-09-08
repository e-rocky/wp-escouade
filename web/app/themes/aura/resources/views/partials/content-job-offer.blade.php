<div class="job-card bgc bgc--4">
  <div class="job-card__content flex flex-col lg:grid grid-cols-[1fr_412px] lg:flex-row-reverse">
    <div class="job-card__header mb-[32px] lg:mb-0 row-start-1 col-start-2 col-span-1">
      <a class="img-container block" href="{{ get_the_permalink() }}" title="{{ get_the_title() }}">
        @if (has_post_thumbnail())
          <img src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
        @else
          <img src="{{ asset('resources/images/content/job-detail-bg-1.png') }}" alt="">
        @endif
      </a>
    </div><!-- .job-card__header -->
    @php
      $dom = new DOMDocument();
      libxml_use_internal_errors(true);
      $dom->loadHTML('<?xml encoding="utf-8' . get_the_content());
      libxml_clear_errors();
      //$paragraph = $dom->getElementsByTagName('article')->item(0)->getElementsByTagName('p');
      $paragraph = $dom->getElementsByTagName('p');
    @endphp
    <div class="job-card__body row-start-1 col-start-1 col-span-1">
      <div class="content">
        <ul class="attributelist m-0 flex flex-wrap gap-[10px]">
          @php($terms_duration = get_the_terms(get_the_ID(), 'job-duration'))
          @foreach ($terms_duration as $term_duration)
            <li><a class="attribute" href="/?s=&post_type=job-offer&job-duration={{ $term_duration->slug }}"
                title="{{ $term_duration->name }}" style="--bg:#80ACD0">{{ $term_duration->name }}</a>
            </li>
          @endforeach


          @php($terms_workplace = get_the_terms(get_the_ID(), 'job-workplace'))
          @foreach ($terms_workplace as $term_workplace)
            <li><a class="attribute" href="/?s=&post_type=job-offer&job-workplace={{ $term_workplace->slug }}"
                title="{{ $term_workplace->name }}" style="--bg:#9B91B4">{{ $term_workplace->name }}</a>
            </li>
          @endforeach

          @php($urgent = get_post_meta(get_the_ID(), 'urgent', true))
          @if ($urgent)
            <li><a class="attribute" href="/?s=&post_type=job-offer&urgent=1" style="--bg:#B97591">Urgent</a></li>
          @endif
        </ul>
        <hr class="my-[10px]">
        <a class="block" href="{{ get_the_permalink() }}" title="{{ get_the_title() }}">
          <h2 class="title title--h3 c--2-1a">{{ get_the_title() }}</h2>
          <div class="grid grid-cols-[24px_1fr] gap-[10px] [&>svg]:size-[24px]">
            @php($levels = get_the_terms(get_the_ID(), 'job-level'))
            @if ($levels)
              <svg aria-hidden='true'>
                <use href="@asset('resources/images/design/sprite.svg')#shield"></use>
              </svg>
              <div>Niveau :
                @foreach ($levels as $level)
                  {{ $level->name }}
                @endforeach
              </div>
            @endif

            @php($departments = get_the_terms(get_the_ID(), 'job-department'))
            @if ($departments)
              <svg aria-hidden='true'>
                <use href="@asset('resources/images/design/sprite.svg')#category"></use>
              </svg>
              <div>Département :
                @foreach ($departments as $department)
                  {{ $department->name }}
                @endforeach
              </div>
            @endif

            @php($languages = get_the_terms(get_the_ID(), 'job-language'))
            @if ($languages)
              <svg aria-hidden='true'>
                <use href="@asset('resources/images/design/sprite.svg')#lang"></use>
              </svg>
              <div>Langues :
                @foreach ($languages as $language)
                  {{ $language->name }}
                @endforeach
              </div>
            @endif


            @php($locations = get_the_terms(get_the_ID(), 'job-location'))
            @if ($locations)
              <svg aria-hidden='true'>
                <use href="@asset('resources/images/design/sprite.svg')#pin"></use>
              </svg>
              <div>Lieu :
                @foreach ($locations as $location)
                  {{ $location->name }}
                @endforeach
              </div>
            @endif
          </div>
        </a>
        <div class="flex flex-col gap-[10px]">
          <a class="block" href="{{ get_the_permalink() }}" title="{{ get_the_title() }}">
            <p>{{ $paragraph->item(0)->textContent }}</p>
          </a>
          @php($stacks = get_the_terms(get_the_ID(), 'job-stack'))
          <ul class="taglist mb-0 flex flex-wrap gap-[10px] mb-[20px] mt-0">
            @foreach ($stacks as $stack)
              <li><a href='{{ "/?s=&post_type=job-offer&job-stack={$stack->slug}" }}' class="tag"
                  title="{{ $stack->name }}">{{ $stack->name }}</a></li>
            @endforeach
          </ul>
        </div>
      </div>
    </div><!-- .job-card__body -->

    <div class="job-card__footer col-span-2">
      <hr class="my-[20px]">
      <div class="flex flex-col-reverse sm:flex-row items-start items-stretch gap-[16px] justify-between">
        <div class="actions flex items-stretch gap-[20px]">
          <a class="btn c--4 bgc--2 btn-shadow-sm" href="{{ get_the_permalink() }}" title="Voir l’offre">Voir l’offre<i
              class="es-icon-chevron-right"></i></a>
          <button class="btn share-btn c--4 bgc--5 btn-shadow-sm" title="Partager"
                    data-uk-toggle="target: #modal-share" data-href="{{ get_the_permalink() }}"><i class="es-icon-share"></i></button>
        </div>
        <div class="flex items-center flex-row sm:flex-row-reverse [&>svg]:size-[24px] gap-[10px]">
          <svg aria-hidden='true'>
            <use href="@asset('resources/images/design/sprite.svg')#time"></use>
          </svg>
          <div class="text-left md:text-right">Publié il y a
            {{ human_time_diff(get_the_time('U'), current_time('timestamp')) }}</div>
        </div>
      </div>
    </div><!-- .job-card__footer -->
  </div><!-- .job-card__content -->
</div><!-- .job-card -->
