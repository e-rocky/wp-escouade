<header id="header">
  <div class="block main-nav-block" data-uk-sticky>
    <div class="main-nav-block__content py-0">

      <nav class="main-nav-block__body uk-navbar-container">
        <div class="uk-container hidden xl:block">
          <div data-uk-navbar>

            <div class="uk-navbar-left">

              <div class="uk-navbar-item">
                <a href="#" class="uk-logo logo" href="#" aria-label="Escouade">
                  <img src="@asset('resources/images/design/logo--icon-square-text.svg')" alt="Escouade"></a>
              </div>

              <?php dd(asset('resources/images/design/logo--icon-square-text.svg')) ?>
              <ul class="uk-navbar-nav">
                <li>
                  <a href="#" title="Accueil">
                    Accueil
                  </a>
                </li>
                <li>
                  <a href="#" title="A propos">
                    A propos
                  </a>
                </li>
                <li>
                  <a href="#" title="Carrière">
                    Carrière
                  </a>
                </li>
                <li>
                  <a href="#" title="Services">
                    Services
                  </a>
                </li>
                <li>
                  <a href="#" title="Actualités">
                    Actualités
                  </a>
                </li>
              </ul>

              <div class="uk-navbar-item">
                <a class="btn c--1-2 bgc--1-2 bgc--1-2 bdc--1-2 btn-shadow-sm" href="#" title="Je cherche un job">Je cherche un job</a>
                <a class="btn c--4 bgc--1-2 btn-shadow-md" href="#" title="Je recrute un talent">Je recrute un talent</a>
              </div>


            </div>

          </div>
        </div>
      </nav><!-- .main-nav-block__body -->


    </div><!-- .main-nav-block__content -->
  </div><!-- .main-nav-block -->

</header><!-- #header -->


<header class="banner">
  <a class="brand" href="{{ home_url('/') }}">
    {!! $siteName !!}
  </a>

  @if (has_nav_menu('primary_navigation'))
  <nav class="nav-primary" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
    {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav', 'echo' => false]) !!}
  </nav>
  @endif
</header>
