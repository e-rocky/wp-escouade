<article @php(post_class('h-entry'))>



  <div class="block hero-text-block bgi bgi--4">
    <div class="hero-text-block__background">
      <div class="img-container">
        @if(has_post_thumbnail())
        <img src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
        @else
        <img src="{{ asset('resources/images/content/job-detail-bg-1.png') }}" alt="">
        @endif
      </div>
    </div><!-- .hero-text-block__background -->
    <div class="hero-text-block__content min-h-[60vh] gap-[70px] uk-container" uk-scrollspy="cls:uk-animation-fade" data-uk-parallax="x: 100vw; opacity: 1, 0;  start: 0; end: 10vh; blur: 0, 30px;">
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
          <li><a href="#" title="Accueil"><i class="es-icon-home"></i></a></li>
          <li class="separator"><i class="es-icon-caret"></i></li>
          <li><a href="#" title="Rejoignez-nous">Rejoignez-nous</a></li>
          <li class="separator"><i class="es-icon-caret"></i></li>
          <li><a href="#" title="Nos offres d’emploi">Nos offres d’emploi</a></li>
          <li class="separator"><i class="es-icon-caret"></i></li>
          <li><a href="#" title="Développeur Back-end PHP">Développeur Back-end PHP</a></li>
        </ul>
      </div><!-- .breadcrumb-block__body -->
    </div><!-- .breadcrumb-block__content -->
  </div><!-- .breadcrumb-block -->

  <div class="block job-detail-block">
    <div class="job-detail-block__content uk-container">
      <div class="job-detail-block__body flex flex-col gap-[64px] sm:gap-[76px] md:gap-[88px] lg:gap-[100px]">


        <div class="job-card bgc bgc--4">
          <div class="job-card__content flex flex-col lg:grid grid-cols-[1fr_436px] p-[16px] sm:p-[32px] md:p-[48px] lg:p-[64px] gap-[32px] md:gap-[48px] lg:gap-[64px] lg:flex-row-reverse">
            <div class="job-card__header row-start-1 col-start-2 col-span-1">
              <figure class="img-container">
                @if(has_post_thumbnail())
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
                      <img class="my-auto size-full object-cover grid-row-span-2" src="{{ asset('resources/images/design/logo--icon-square.svg') }}" alt="Escouade">
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
                    <li><span class="attribute" style="--bg:#80ACD0">CDI</span></li>
                    <li><span class="attribute" style="--bg:#9B91B4">Remote</span></li>
                    <li><span class="attribute" style="--bg:#B97591">Urgent</span></li>
                  </ul>
                  <div class="grid grid-cols-[24px_1fr] gap-[10px] [&>svg]:size-[24px]">
                    <svg aria-hidden='true'>
                      <use href="{{ asset('resources/images/design/sprite.svg') }}#shield"></use>
                    </svg>
                    <div>Niveau : Senior</div>
                    <svg aria-hidden='true'>
                      <use href="{{ asset('resources/images/design/sprite.svg') }}#category"></use>
                    </svg>
                    <div>Département : Tech / Support</div>
                    <svg aria-hidden='true'>
                      <use href="{{ asset('resources/images/design/sprite.svg') }}#lang"></use>
                    </svg>
                    <div>Langues : Francais / Anglais</div>
                    <svg aria-hidden='true'>
                      <use href="{{ asset('resources/images/design/sprite.svg') }}#pin"></use>
                    </svg>
                    <div>Lieu : Antananarivo - Madagascar</div>
                  </div>
                </div>
              </div>
            </div><!-- .job-card__body -->

            <div class="job-card__body col-span-2">
              <hr class="my-[20px]">
              <div class="flex flex-col-reverse sm:flex-row items-start items-stretch gap-[16px] justify-between">
                <div class="actions flex items-stretch gap-[20px]">
                  <a class="btn c--4 bgc--2 btn-shadow-sm" href="#" title="Je postule">Je postule<i class="es-icon-chevron-right"></i></a>
                  <a class="btn c--4 bgc--5 btn-shadow-sm" href="#" title="Partager"><i class="es-icon-share"></i></a>
                </div>
                <div class="flex items-center flex-row sm:flex-row-reverse [&>svg]:size-[24px] gap-[10px]">
                  <svg aria-hidden='true'>
                    <use href="{{ asset('resources/images/design/sprite.svg') }}#time"></use>
                  </svg>
                  <div class="text-left md:text-right">Publié il y a 3 jours</div>
                </div>
              </div>
              <hr class="my-[20px]">
            </div><!-- .job-card__body -->

            <article class="flex col-span-2 flex-col gap-[32px] ">
              <h2 class="title title--h3 c--2-1a">À propos du poste</h2>
              <div class="text rte">
                <p>
                  Dans le cadre de la croissance de nos projets digitaux, nous recherchons un Développeur Back-end PHP Senior pour renforcer notre équipe technique.
                  Vous interviendrez sur des applications web critiques à forte valeur métier, dans un environnement agile, collaboratif et orienté qualité.
                </p>
                <p>Vous travaillerez en étroite collaboration avec les équipes front-end, produit et support afin de concevoir des solutions robustes, performantes et évolutives.</p>
              </div>
            </article>

            <article class="flex flex-col gap-[32px] ">
              <h2 class="title title--h3 c--2-1a">Vos missions principales</h2>
              <div class="text rte">
                <ul>
                  <li>Concevoir, développer et maintenir des modules back-end en PHP</li>
                  <li>Participer à l’architecture et à l’évolution des applications existantes</li>
                  <li>Implémenter et maintenir des API REST sécurisées</li>
                  <li>Optimiser les performances et la qualité du code (tests, bonnes pratiques)</li>
                  <li>Collaborer avec les équipes produit et support pour répondre aux besoins métiers</li>
                  <li>Participer aux revues de code et à l’amélioration continue</li>
                  <li>Contribuer à la documentation technique</li>
                </ul>
              </div>
            </article>
            <article class="flex flex-col gap-[32px] row-start-5 ">
              <h2 class="title title--h3 c--2-1a">Profil recherché</h2>
              <div class="text rte">
                <ul>
                  <li>Minimum 5 ans d’expérience en développement back-end PHP</li>
                  <li>Excellente maîtrise de la programmation orientée objet (OOP)</li>
                  <li>Bonne compréhension des architectures web modernes</li>
                  <li>Capacité à travailler en équipe et à être force de proposition</li>
                  <li>Autonomie, rigueur et sens des responsabilités</li>
                </ul>
              </div>
            </article>
            <article class="bg flex flex-col gap-[32px] ">
              <h2 class="title title--h4 c--3">Compétences techniques</h2>
              <div class="text rte">
                <ul>
                  <li>PHP 8.x</li>
                  <li>Symfony</li>
                  <li>Doctrine</li>
                  <li>MySQL</li>
                  <li>API REST</li>
                  <li>Docker</li>
                </ul>
                <p>(Des connaissances en CI/CD et bonnes pratiques DevOps sont un plus)</p>
              </div>
            </article>
            <article class="flex flex-col gap-[32px] ">
              <h2 class="title title--h4 c--3">Pourquoi nous rejoindre ?</h2>
              <div class="text rte">
                <ul>

                  <li>Projets stimulants et techniquement exigeants</li>
                  <li>Contexte technique riche, entre qualité, performance et fiabilité</li>
                  <li>Opportunités d’évolution et de montée en compétences</li>
                  <li>Valorisation de l’engagement et de l’expertise</li>
                  <li>(Des connaissances en CI/CD et bonnes pratiques DevOps sont un plus)</li>

                </ul>
              </div>
            </article>
            <div class="actions col-span-2 flex justify-end items-stretch gap-[20px]">
              <a class="btn c--1a-2 underline" href="#" title="Voir l’offre">Retourner à la liste les offres</a>
              <a class="btn c--4 bgc--5-2 btn-shadow-sm" href="#" title="Je postule ">Je postule <i class="es-icon-chevron-right"></i></a>
            </div>


          </div><!-- .job-card__content -->
        </div><!-- .job-card -->


      </div><!-- .job-detail-block__body -->

    </div><!-- .job-detail-block__content -->
  </div><!-- .job-detail-block -->

  <div class="block hero-intro-block bgc bgc--3a">
    <div class="hero-intro-block__content uk-container">
      <div class="hero-intro-block__body">

        <div class="card cta-card">

          <div class="cta-card__background scale-x-[-1]">
            <img src="{{ asset('resources/images/design/bg-6.png') }}" alt="">
          </div><!-- .cta-card__background -->

          <div class="cta-card__content flex flex-col-reverse md:flex-row-reverse">

            <div class="cta-card__header">
              <figure class="img-container">
                <img src="{{ asset('resources/images/content/intro-img-1.png') }}" alt="">
                <img src="{{ asset('resources/images/content/intro-img-1.png') }}" alt="">
              </figure>
            </div><!-- .cta-card__header -->
            <div class="cta-card__body">
              <div class="content">
                <h2 class="title title--h1 c--4">Osez faire le premier pas</h2>
                <div class="text">
                  <p>Vous avez du potentiel, même sans offre publiée. Présentez votre profil et créez votre opportunité.</p>
                </div>
                <div class="actions flex flex-col sm:flex-row md:flex-wrap items-stretch gap-[20px]">
                  <a class="btn btn--lg c--4 bgc--5 btn-shadow-sm" href="#" title="Candidature spontanée">Candidature spontanée<i class="es-icon-chevron-right"></i></a>
                </div>
              </div>
            </div><!-- .cta-card__body -->
          </div><!-- .cta-card__content -->
        </div><!-- .cta-card -->

      </div><!-- .hero-intro-block__body -->
    </div><!-- .hero-intro-block__content -->
  </div><!-- .hero-intro-block -->

  <header>

    <div class="job-offer__meta">
      @php($terms_level = get_the_terms(get_the_ID(), 'job-level'))
      @if($terms_level)
      <span class="job-offer__level">
        {{ implode(', ', wp_list_pluck($terms_level, 'name')) }}
      </span>
      @endif

      @php($terms_duration = get_the_terms(get_the_ID(), 'job-duration'))
      @if($terms_duration)
      <span class="job-offer__duration">
        {{ implode(', ', wp_list_pluck($terms_duration, 'name')) }}
      </span>
      @endif

      @php($terms_workplace = get_the_terms(get_the_ID(), 'job-workplace'))
      @if($terms_workplace)
      <span class="job-offer__workplace">
        {{ implode(', ', wp_list_pluck($terms_workplace, 'name')) }}
      </span>
      @endif

      @php($terms_location = get_the_terms(get_the_ID(), 'job-location'))
      @if($terms_location)
      <span class="job-offer__location">
        {{ implode(', ', wp_list_pluck($terms_location, 'name')) }}
      </span>
      @endif

      @php($terms_language = get_the_terms(get_the_ID(), 'job-language'))
      @if($terms_language)
      <span class="job-offer__language">
        {{ implode(', ', wp_list_pluck($terms_language, 'name')) }}
      </span>
      @endif
    </div>
  </header>

  <div class="e-content">
    @php(the_content())
  </div>

  @php(comments_template())
</article>
