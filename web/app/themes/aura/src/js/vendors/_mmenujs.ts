import MmenuLight from 'mmenu-light';

document.addEventListener('DOMContentLoaded', () => {
  const $menuEl = document.querySelector<HTMLElement>('#menu');
  if (!$menuEl) return;

  const $menuElClone = $menuEl.cloneNode(true) as HTMLElement;
  $menuElClone.id = 'menu-clone';
  $menuEl.parentNode!.insertBefore($menuElClone, $menuEl.nextSibling);

  const $btnLi = document.querySelectorAll<HTMLElement>(
    '#menu + .uk-navbar-item > li:not(:last-child)'
  );

  const $menuElCloneUl = $menuElClone.querySelector<HTMLUListElement>('ul');
  $menuElCloneUl!.classList.remove('uk-navbar-nav');
  $btnLi.forEach((btn: HTMLElement) => {
    /*const $li = document.createElement('li');
    $li.classList.add('mm-listitem-default');
    const $span = document.createElement('span');
    $span.appendChild(btn.cloneNode(true));
    $li.appendChild($span);
    $menuElCloneUl.appendChild($li);*/
    $menuElCloneUl!.appendChild(btn);
  });

  const menu = new MmenuLight($menuElClone);

  function initializeUkDropNav(): void {
    const $menu = document.querySelector<HTMLElement>('#menu');
    const $ul = $menu?.querySelectorAll<HTMLUListElement>('.uk-navbar-nav>li>ul');
    $ul?.forEach((element: HTMLUListElement) => {
      console.log(element.textContent);
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

  // Tailwind's "hidden" class uses display:none !important which conflicts
  // with mmenu-light once it moves the nav into .mm-ocd__content
  $menuElClone.classList.remove('hidden');

  const anchor = document.querySelector<HTMLElement>('#menu-toggle');
  if (!anchor) return;
  anchor.addEventListener('click', (event: Event) => {
    event.preventDefault();
    drawer.open();
  });
});
