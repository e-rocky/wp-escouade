// @ts-ignore
import { SlideMenu } from 'smdm-slide-menu';
import 'smdm-slide-menu/dist/slide-menu.css';

const menuElement = document.getElementById('example-menu');
const triggerElement = document.getElementsByClassName('burger');
const menu = new SlideMenu(menuElement);

Array.from(triggerElement).forEach((element) => {
  element.addEventListener('click', () => {
    //console.log('click');
    menu.toggle();
  });
});
