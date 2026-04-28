<header id="header">
  <div class="block main-nav-block" data-uk-sticky>
    <div class="main-nav-block__content py-0">

      <nav class="main-nav-block__body uk-navbar-container">
        <div class="uk-container">
          <div data-uk-navbar>

            <div class="uk-navbar-left gap-[20px]">

              <div class="uk-navbar-item order-1">
                <a href="{{ home_url('/') }}" class="uk-logo logo" aria-label="{{ get_bloginfo('name') }}"
                  title="{{ get_bloginfo('name') }}">
                  <img src="@asset('resources/images/design/logo--icon-square-text.svg')" alt="{{ get_bloginfo('name') }}"></a>
              </div>

              <div id="menu" class="order-3 xl:order-2 flex-[1_1_100%] xl:flex-1 hidden lg:flex justify-center">
                {!! wp_nav_menu([
                    'theme_location' => 'primary_navigation',
                    'menu_class' => 'uk-navbar-nav',
                    'container' => false,
                ]) !!}
              </div>


              {!! wp_nav_menu([
                  'theme_location' => 'cta_navigation',
                  'menu_class' => 'uk-navbar-item order-2 xl:order-3 m-0',
                  'container' => false,
              ]) !!}

              <!--div class="uk-navbar-item">
                <a class="btn c--1-2 bgc--1-2 bgc--1-2 bdc--1-2 btn-shadow-sm" href="#" title="Je cherche un job">Je cherche un job</a>
                <a class="btn c--4 bgc--1-2 btn-shadow-md" href="#" title="Je recrute un talent">Je recrute un talent</a>
              </div-->


            </div>

          </div>
        </div>
      </nav><!-- .main-nav-block__body -->


    </div><!-- .main-nav-block__content -->
  </div><!-- .main-nav-block -->

</header><!-- #header -->
