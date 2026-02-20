// @ts-ignore
import { createElement } from 'react';
import { SlideMenu } from 'smdm-slide-menu';
import UIkit from 'uikit';
import 'smdm-slide-menu/dist/slide-menu.css';

const $triggerElement: HTMLCollectionOf<Element> = document.getElementsByClassName('burger');
const $body: HTMLElement = document.body;
//const menu = new SlideMenu($menuElement);
const $menuContent: HTMLElement = document
  .querySelector('#header .main-nav-block__body .uk-container .uk-navbar-left')
  ?.cloneNode(true) as HTMLElement;

const $fixedLogo = $menuContent.querySelector('.item-logo') as HTMLElement;

const menu = new SlideMenu($menuContent, {
  // Optional parameters
  position: 'left', // Position of the menu (left, right, top, bottom)
});

UIkit.sticky($fixedLogo, {});

if ($menuContent) {
  $menuContent.id = 'side-menu';
  $body.appendChild($menuContent);
  Array.from($triggerElement).forEach((element) => {
    element.addEventListener('click', () => {
      //console.log('click');
      menu.toggle();
    });
  });
}
