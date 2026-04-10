import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
declare global {
  interface Window {
    UIkit: typeof UIkit;
  }
}

initializeUikit();
initializeUkScroll();

export function clickToAnchor(element: HTMLElement) {
  element.addEventListener('click', function (e: MouseEvent) {
    console.log('scroll to anchor');
    const offset: number =
      document.querySelector<HTMLElement>('.main-nav-block__body.uk-navbar-container')
        ?.offsetHeight ?? 0;
    const href = element.getAttribute('href');
    if (!href || !href.startsWith('#')) {
      return;
    } else if (href === '#') {
      e.preventDefault();
      return;
    }
    UIkit.scroll(element, { offset }).scrollTo(href);
  });
}

function initializeUkScroll(elements?: NodeListOf<HTMLElement>) {
  let scrollElements: NodeListOf<HTMLElement>;
  if (!elements) {
    scrollElements = document.querySelectorAll('a[href^="#"]');
  } else {
    scrollElements = elements;
  }
  scrollElements.forEach((element) => {
    clickToAnchor(element);
  });
}

function initializeUikit() {
  UIkit.use(Icons);
  window.UIkit = UIkit;
}
