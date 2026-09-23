@extends('layouts.app')

@section('content')
  <div class="block hero-text-block bgi bgi--4">
    <div class="hero-text-block__background">
      <div class="img-container">
        <img src="{{ asset('resources/images/content/hero-img-1.png') }}" alt="">
      </div>
    </div><!-- .hero-text-block__background -->
    <div class="hero-text-block__content min-h-65 md:min-h-100  gap-[70px] uk-container"
      uk-scrollspy="cls:uk-animation-fade" data-uk-parallax="x: 100vw; opacity: 1, 0;  start: 0; end: 10vh; blur: 0, 30px;">
      <div class="hero-text-block__body justify-end mt-auto">
        <h1 class="title title--h1 rte rte--em-c-5 c--4 text-left">
          <small class="block">Rejoignez-nous :</small>
          Recrutements en cours
        </h1>
      </div><!-- .hero-text-block__body -->
    </div><!-- .hero-text-block__content -->
  </div><!-- .hero-text-block -->

  <div class="block breadcrumb-block pt-16">
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
        </ul>
      </div><!-- .breadcrumb-block__body -->
    </div><!-- .breadcrumb-block__content -->
  </div><!-- .breadcrumb-block -->

  <div class="block job-listing-block">
    <div class="job-listing-block__content pt-16 uk-container">
      <div class="job-listing-block__body flex flex-col gap-16">



        <div id="search" class="relative z-9"></div>


        @if (!have_posts())
          <div class="card emptyState-card">
            <div
              class="emptyState-card__content shadow flex flex-col justify-center gap-8 px-8 py-12 rounded-3xl bgc bgc--4">
              <div class="emptyState-card__header flex-col items-center justify-center flex">
                <div class="disc rounded-full size-16 items-center justify-center flex">
                  <i class="es-icon-search text-[32px] c--2"></i>
                </div>
              </div><!-- .emptyState-card__header -->
              <div class="emptyState-card__body flex flex-col items-center">
                <h2 class="title">Aucune offre ne correspond à votre recherche</h2>
                <p class="text-center text-[15px] max-w-162.5 text-[#77778c] mx-auto">Nous n’avons trouvé aucune offre
                  correspondant aux critères sélectionnés. Essayez de modifier vos
                  filtres ou de réinitialiser votre recherche.</p>
              </div><!-- .emptyState-card__body -->
              <div class="emptyState-card__footer flex flex-col items-center">
                <a class="btn c--4 bgc--1-2 btn-shadow-md" href="{{ get_post_type_archive_link('job-offer') }}#search"
                  title="Réinitialiser les filtres">
                  <span>Réinitialiser les filtres</span>
                </a>
              </div><!-- .emptyState-card__footer -->
            </div><!-- .emptyState-card__content -->
          </div><!-- .emptyState-card -->
        @endif


        @while (have_posts())
          @php(the_post())
          @includeFirst(['partials.content-' . get_post_type(), 'partials.content'])
        @endwhile

        <div class="card pagination-card hidden">
          <div class="pagination-card__content uk-container">
            <div class="pagination-card__body">

              <nav aria-label="Pagination" class="flex justify-start">
                <ul class="uk-pagination uk-flex-left items-stretch">
                  <li><a href="#"><i class="es-icon-lt fz-[24px]"></i></a></li>
                  <li><a href="#">1</a></li>
                  <li class="uk-active"><span aria-current="page">2</span></li>
                  <li><a href="#">3</a></li>
                  <li><a href="#">4</a></li>
                  <li><a href="#">5</a></li>
                  <li><a href="#"><i class="es-icon-gt fz-[24px]"></i></a></li>
                </ul>
              </nav>

            </div><!-- .pagination-card__body -->
          </div><!-- .pagination-card__content -->
        </div><!-- .pagination-card -->

        {{-- https://escouade.loc/?post_type=job-offer&s=talend&job-stack=talend&job-level=confirm%C3%A9&job-lang=Fran%C3%A7ais&job-stack=agile --}}


      </div><!-- .job-listing-block__body -->

    </div><!-- .job-listing-block__content -->
  </div><!-- .job-listing-block -->
@endsection
