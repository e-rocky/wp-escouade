import MmenuLight from 'mmenu-light';

document.addEventListener('DOMContentLoaded', () => {
  const $menuEl = document.querySelector('#menu');
  if (!$menuEl) return;

  const $menuElClone = $menuEl.cloneNode(true);
  $menuElClone.id = 'menu-clone';
  $menuEl.parentNode.insertBefore($menuElClone, $menuEl.nextSibling);

  const $btnLi = document.querySelectorAll('#menu + .uk-navbar-item > li:not(:last-child)');

  const $menuElCloneUl = $menuElClone.querySelector('ul');
  $menuElCloneUl.classList.remove('uk-navbar-nav');
  $btnLi.forEach((btn) => {
    /*const $li = document.createElement('li');
    $li.classList.add('mm-listitem-default');
    const $span = document.createElement('span');
    $span.appendChild(btn.cloneNode(true));
    $li.appendChild($span);
    $menuElCloneUl.appendChild($li);*/
    $menuElCloneUl.appendChild(btn);
  });

  const menu = new MmenuLight($menuElClone);

  function initializeUkDropNav() {
    const $menu = document.querySelector('#menu');
    const $ul = $menu?.querySelectorAll('.uk-navbar-nav>li>ul');
    $ul?.forEach((element) => {
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

  const anchor = document.querySelector('#menu-toggle');
  if (!anchor) return;
  anchor.addEventListener('click', (event) => {
    event.preventDefault();
    drawer.open();
  });
});
