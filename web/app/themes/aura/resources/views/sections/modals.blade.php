<section id="modal-share" class="uk-flex-top uk-modal hex-modal">
  <div class="uk-modal-dialog  uk-margin-auto-vertical">
    <div class="block block-modal__share col-12 bgi bgi--6">
      <div class="block-content">
        <div class="block-header">
          <h2 class="title title-common">
            Partager
          </h2>
          <button class="uk-modal-close uk-icon uk-close uk-modal-close-default" type="button" data-uk-close></button>
        </div>
        <!-- .block-header -->
        <div class="block-body">

          <ul class="actions" data-uk-height-match=".icon">
            <li>
              <a href="mailto:?body={{ get_permalink() }}" class="link email" title="Email" target="_blank" rel="nofollow">
                <i class="icon es-icon-share-email"></i>
                <label class="label">Email</label>
              </a>
            </li>
            <li>
              <a href="https://www.facebook.com/sharer.php?u={{ get_permalink() }}" class="link facebook" title="Facebook" target="_blank" rel="nofollow">
                <i class="icon es-icon-social-facebook"></i>
                <label class="label">Facebook</label>
              </a>
            </li>
            <li>
              <a href="https://twitter.com/intent/tweet?url={{ get_permalink() }}" class="link twitter" title="X" target="_blank" rel="nofollow">
                <i class="icon es-icon-social-x"></i>
                <label class="label">X</label>
              </a>
            </li>
            <li>
              <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ get_permalink() }}" class="link linkedin" title="Linkedin" target="_blank" rel="nofollow">
                <i class="icon es-icon-social-linkedin"></i>
                <label class="label">Linkedin</label>
              </a>
            </li>
          </ul>

          <div class="copy">
            <input name="link" type="text" readonly value="{{ get_permalink() }}">
          </div>

        </div>
        <!-- .block-body -->
      </div>
      <!-- .block-content -->
    </div>
    <!-- .block-modal__share -->
  </div>
</section>
<!-- #modal-share -->

<div id="modal-job-application-form" class="uk-modal-container" data-uk-modal="show: true">
  <div class="job-application-form uk-modal-dialog uk-modal-body">
    <button class="uk-modal-close uk-icon uk-close uk-modal-close-default" type="button" data-uk-close></button>
    <div class="job-application-form__content flex flex-col justify-between gap-[32px] md:gap-[48px]">

      <div class="job-application-form__header flex gap-[16px] sm:gap-[32px] md:gap-[48px]">
        <div class="logo flex tems-center gap-x-[20px]">
          <div class="img size-[64px] mb-a md:mt-a">
            <img class="my-auto size-full object-contain grid-row-span-2" src="{{ asset('resources/images/design/logo--icon-square.svg') }}" alt="Escouade">
          </div>
          <div class="text flex flex-1 flex-col md:flex-row justify-between items-start md:items-center">
            <div class="line-height-[1]">
              <strong class="title py-0 my-0 my-auto text-[32px]">Escouade</strong>
              <p class="address my-0">
                Antananarivo -
                Madagascar
              </p>
            </div>
            <div class="[&>p]:m-0 md:text-right">
              <p class="email">
                <a class="c--3" href="mailto:contact@escouade.mg">contact@escouade.mg</a>
              </p>
              <p class="phone"><a class="c--3" href="tel:+26134223682">+261 34 22 236 82</a></p>
            </div>
          </div>
        </div>
        <div class="cover">
          @if(has_post_thumbnail())
          <img src="{{ get_the_post_thumbnail_url(null, 'full') }}" alt="{{ get_the_title() }}">
          @else
          <img src="{{ asset('resources/images/content/job-detail-bg-1.png') }}" alt="">
          @endif
        </div>
      </div>
      <div class="job-application-form__body flex flex-col gap-[32px] md:gap-[48px] lg:gap-[64px]">

        <h2 class="title title--h2 rte rte--em-c-5 c--2-1a m-0 self-start">
          <small class="block c--3 tracking-0">Déposer ma candidature pour le poste de :</small>
          {!! get_the_title() !!}
        </h2>

        {!! do_shortcode('[contact-form-7 id="2394c78" html_class="uk-grid-small form uk-grid uk-grid-stack" title="Déposer ma candidature pour le poste de : ' . get_the_title() . '"]') !!}

      </div><!-- .job-application-form__body -->

    </div><!-- .job-application-form__content -->
  </div><!-- .job-application-form -->
</div><!-- #modal-contact -->