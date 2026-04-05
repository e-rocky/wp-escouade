import UIkit from 'uikit';
import Icons from 'uikit/dist/js/uikit-icons';
declare global {
  interface Window {
    UIkit: typeof UIkit;
  }
}

initializeUikit();
initializeUkScroll();

function initializeUkScroll() {
  const scrollElements = document.querySelectorAll('a[href^="#"]');
  scrollElements.forEach((element) => {
    element.addEventListener('click', () => {
      const offset: number =
        document.querySelector<HTMLElement>('.main-nav-block__body.uk-navbar-container')
          ?.offsetHeight ?? 0;
      UIkit.scroll(element, { offset });
    });
  });
}

function initializeUikit() {
  UIkit.use(Icons);
  window.UIkit = UIkit;
}
