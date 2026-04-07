import MmenuLight from 'mmenu-light';
import UIkit from 'uikit';

// Initialise le menu mobile mmenu-light une fois le DOM chargé
document.addEventListener('DOMContentLoaded', () => {
  let $menuEl = document.querySelector<HTMLElement>('#menu');
  if (!$menuEl) {
    $menuEl = document.createElement('div');
    $menuEl.id = 'menu';
  }

  // Clone le menu de navigation desktop pour en faire la base du menu mobile,
  // afin de ne pas altérer la nav desktop (qui reste dans le DOM original)
  const $menuElClone = $menuEl.cloneNode(true) as HTMLElement;
  $menuElClone.id = 'menu-clone';

  // Récupère les éléments de bouton situés à côté du menu (ex. : CTA),
  // à l'exclusion du dernier (généralement le bouton burger/toggle)
  const $btnLi = document.querySelectorAll<HTMLElement>('#menu-cta-navigation > li.btn');

  // Retire la classe UIkit de la liste clonée pour éviter les conflits de styles desktop
  let $menuElCloneUl = $menuElClone.querySelector<HTMLElement>('ul');
  if (!$menuElCloneUl) {
    $menuElCloneUl = document.createElement('ul');
    $menuElClone.appendChild($menuElCloneUl);
  }
  $menuElCloneUl.classList.remove('uk-navbar-nav');

  // Déplace les <li> de boutons dans la liste du menu mobile
  $btnLi.forEach((btn: HTMLElement) => {
    const btnClone = btn.cloneNode(true) as HTMLElement;
    $menuElCloneUl!.appendChild(btnClone);
    btnClone.addEventListener('click', (event: Event) => {
      event.preventDefault();
      const anchor = btnClone.querySelector('a');
      if (anchor) {
        const href = anchor.getAttribute('href');
        if (href?.startsWith('#')) {
          UIkit.scroll(anchor).scrollTo(anchor.getAttribute('href')!);
          drawer.close();
        }
      }
    });
  });

  const menu = new MmenuLight($menuElClone);

  // Restructure les sous-menus UIkit (.uk-navbar-nav > li > ul) en dropdowns UIkit
  // afin qu'ils s'affichent correctement dans le contexte de la navbar desktop
  function initializeUkDropNav(): void {
    const $menu = document.querySelector<HTMLElement>('#menu');
    const $ul = $menu?.querySelectorAll<HTMLUListElement>('.uk-navbar-nav>li>ul');
    $ul?.forEach((element: HTMLUListElement) => {
      const $div = document.createElement('div');
      $div.classList.add('uk-navbar-dropdown');
      element.parentElement?.appendChild($div);
      $div.appendChild(element);
    });
  }
  initializeUkDropNav();

  menu.navigation({
    // options
  });

  const drawer = menu.offcanvas({
    // options
  });

  // La classe "hidden" de Tailwind utilise display:none !important, ce qui entre en conflit
  // avec mmenu-light après qu'il déplace la nav dans .mm-ocd__content
  $menuElClone.classList.remove('hidden');

  // Ouvre le tiroir mobile au clic sur le bouton burger
  const anchor = document.querySelector<HTMLElement>('#menu-toggle');
  if (!anchor) return;
  anchor.addEventListener('click', (event: Event) => {
    event.preventDefault();
    drawer.open();
  });
});
