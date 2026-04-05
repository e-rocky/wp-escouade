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
    UIkit.scroll(element);
  });
}

function initializeUikit() {
  UIkit.use(Icons);
  window.UIkit = UIkit;
}
