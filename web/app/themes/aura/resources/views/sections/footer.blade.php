<footer id="footer" class="bgi bgi--5">
  <div class="block footer-menu-block">
    {{-- <div class="footer-menu-block__content uk-container pt-[40px]  pb-[40px]">
      <div class="footer-menu-block__body flex flex-col md:flex-row gap-[50px] md:items-center ">

        <div class="card minimap-card md:self-start z-1 md:mt-[-80px] md:max-w-[291px]">
          <div class="minimap-card__content flex flex-col sm:flex-row md:flex-col pb-[30px] sm:pb-[10px] md:pb-[30px]" data-uk-sticky="offset: 20; end:.footer-menu-block__body; media: @m;">
            <div class="minimap-card__header">
              <figcaption class="img-container">
                <img src="@asset('resources/images/content/minimap-placeholder.png')" alt="Minimap">
              </figcaption>
            </div><!-- .minimap-card__header -->
            <div class="minimap-card__body flex-1 grid grid-cols-[32px_1fr] gap-[10px]">
              <img class="my-auto" src="@asset('resources/images/design/logo--icon-square.svg')" alt="Escouade">
              <h4 class="title py-0 my-0 c--bgi c--bgi-scroll c--bgi-3 my-auto text-[20px]">Escouade</h4>
              <div class="content col-start-2 sm:col-start-1 sm:col-span-2 md:col-start-2 gap-[10px]">
                <p class="address">
                  Lot II Y 53 L, Bâtiment "Dina",
                  Antanimora ANTANANARIVO
                  Madagascar
                </p>
                <p class="email">
                  contact@escouade.mg
                </p>
                <p class="phone">+261 34 22 236 82</p>
              </div><!-- .content -->
            </div><!-- .minimap-card__body -->
          </div><!-- .minimap-card__content -->
        </div><!-- .minimap-card -->

        <div class="card footer-menu-card flex-1">
          <div class="footer-menu-card__content flex flex-col lg:flex-row gap-[30px]">

            <div class="menu footer-nav-menu flex-[2]">
              <div class="footer-nav-menu__content flex flex-col gap-[30px]">
                <div class="footer-nav-menu__header">
                  <h4 class="title title--h4 c--3a my-0">Services</h4>
                </div><!-- .footer-nav-menu__header -->
                <div class="footer-nav-menu__body flex flex-row gap-[30px]">
                  <ul class="flex flex-1 my-0 flex-col gap-[10px]">
                    <li><a href="#" title="Création d'équipe dédiée">Création d'équipe dédiée</a></li>
                    <li><a href="#" title="Développement web & mobile sur mesure">Développement web & mobile sur mesure</a></li>
                    <li><a href="#" title="Solutions IA d'entreprise">Solutions IA d'entreprise</a></li>
                    <li><a href="#" title="Staffing & solution de recrutement">Staffing & solution de recrutement</a></li>
                  </ul>
                </div><!-- .footer-nav-menu__body -->
              </div><!-- .footer-nav-menu__content -->
            </div><!-- .footer-nav-menu -->
            <div class="menu footer-nav-menu flex-[2]">
              <div class="footer-nav-menu__content flex flex-col gap-[30px]">
                <div class="footer-nav-menu__header">
                  <h4 class="title title--h4 c--3a my-0">Services</h4>
                </div><!-- .footer-nav-menu__header -->
                <div class="footer-nav-menu__body flex flex-row gap-[30px]">
                  <ul class="flex flex-1 my-0 flex-col gap-[10px]">
                    <li><a href="#" title="PHP">PHP</a></li>
                    <li><a href="#" title="Symfony">Symfony</a></li>
                    <li><a href="#" title="Flutter">Flutter</a></li>
                    <li><a href="#" title="Dotnet">Dotnet</a></li>
                    <li><a href="#" title="Java">Java</a></li>
                    <li><a href="#" title="Python">Python</a></li>
                  </ul>
                  <ul class="flex flex-1 my-0 flex-col gap-[10px]">
                    <li><a href="#" title="ReactJS">ReactJS</a></li>
                    <li><a href="#" title="GO">GO</a></li>
                    <li><a href="#" title="Angular">Angular</a></li>
                    <li><a href="#" title="Git">Git</a></li>
                    <li><a href="#" title="Docker">Docker</a></li>
                    <li><a href="#" title="CI/CD">CI/CD</a></li>
                  </ul>
                </div><!-- .footer-nav-menu__body -->
              </div><!-- .footer-nav-menu__content -->
            </div><!-- .footer-nav-menu -->
            <div class="menu footer-nav-menu flex-[1]">
              <div class="footer-nav-menu__content flex flex-col gap-[30px]">
                <div class="footer-nav-menu__header">
                  <h4 class="title title--h4 c--3a my-0">Liens utiles</h4>
                </div><!-- .footer-nav-menu__header -->
                <div class="footer-nav-menu__body flex flex-row gap-[30px]">
                  <ul class="flex flex-1 my-0 flex-col gap-[10px]">
                    <li><a href="#" title="À propos">À propos</a></li>
                    <li><a href="#" title="Ebook">Ebook</a></li>
                    <li><a href="#" title="Pricelist">Pricelist</a></li>
                    <li><a href="#" title="Carrière">Carrière</a></li>
                    <li><a href="#" title="Blog">Blog</a></li>
                    <li><a href="#" title="Contact">Contact</a></li>
                  </ul>
                </div><!-- .footer-nav-menu__body -->
              </div><!-- .footer-nav-menu__content -->
            </div><!-- .footer-nav-menu -->

          </div><!-- .footer-menu-card__content -->
        </div><!-- .footer-menu-card -->

      </div><!-- .footer-menu-block__body -->

      <div class="footer-menu-block__footer"></div><!-- .footer-menu-block__footer -->

    </div><!-- .footer-menu-block__content --> --}}
  </div><!-- .footer-menu-block -->

  <div class="block copyright-social-block">
    <div class="copyright-social-block__content py-0 uk-container">
      <div class="copyright-social-block__body flex flex-col-reverse md:flex-row gap-[32px] justify-between items-center py-[46px] text-[16px]">
        <p class="copyright c--4 mb-0 text-center md:text-left">© {{ date('Y') }} Escouade. Tous droits réservés.</p>

        {!! wp_nav_menu([
        'theme_location' => 'footer_social_navigation',
        'menu_class' => 'social-links flex my-0',
        'container' => false,
        ]) !!}


      </div><!-- .copyright-social-block__body -->
    </div><!-- .copyright-social-block__content -->
  </div><!-- .copyright-social-block -->

</footer><!-- #footer -->

@include ('sections.modals')