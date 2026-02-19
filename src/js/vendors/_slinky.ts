const module = require('jquery-slinky/src/slinky.js');

const Slinky = module.default;

// jQuery plugin
$.fn.slinky = function (options) {
  const menu = new Slinky(this, options);

  return menu;
};

export default function () {
  const offCanvasId = '#offcanvas-menu';
  const $block = $('.block-offcanvas__menu');
  const $offCanvas = $(offCanvasId);
  if ($block.length) {
    const $navigation = $block.find('.navigation');
    const slinkyNavigation = $navigation.addClass('activeLinks').slinky({ title: true });

    const $lang = $block.find('.lang');

    $offCanvas.on('show', function () {
      $navigation.css('height', '');
    });

    $(`[href="${offCanvasId}"]`).on('click', function () {
      const $this = $(this);
      $offCanvas.removeClass('lang');
      if ($this.hasClass('lang')) {
        slinkyNavigation.jump('.langpicker > ul', false);
        $offCanvas.addClass('lang');
      } else {
        slinkyNavigation.home(false);
      }
    });
  }
}
