(function ($) {
  'use strict';

  const initialized = new WeakSet();

  function initializeCarousel(element) {
    if (!window.UIkit || !element || initialized.has(element)) {
      return;
    }

    initialized.add(element);
    const slider = window.UIkit.slider(element);
    const step = Math.max(1, Number.parseInt(element.dataset.slidesToScroll || '1', 10));
    const duration = Math.max(100, Number.parseInt(element.dataset.transitionDuration || '500', 10));

    const move = (direction) => {
      slider.show(Math.max(0, slider.index + direction * step));
    };

    element.querySelector('[data-carousel-previous]')?.addEventListener('click', () => move(-1));
    element.querySelector('[data-carousel-next]')?.addEventListener('click', () => move(1));

    const updateVelocity = () => {
      slider.velocity = Math.max(0.1, element.clientWidth / duration);
    };
    updateVelocity();
    window.addEventListener('resize', updateVelocity, {passive: true});

    if (element.dataset.pauseOnInteraction === 'true') {
      element.addEventListener('pointerdown', () => slider.stopAutoplay?.(), {passive: true});
    }
  }

  function initializeAll(root) {
    root.querySelectorAll?.('.aura-carousel[data-uk-slider]').forEach(initializeCarousel);
  }

  $(window).on('elementor:init', function () {
    const nativeContainer = elementor.elementsManager.getElementTypeClass('container');
    if (!nativeContainer) {
      return;
    }

    elementor.elementsManager.elementTypes['aura-carousel'] = nativeContainer;
    const NativeContainerView = nativeContainer.getView();
    let AuraDivBlockView;

    class AuraCarouselView extends NativeContainerView {
      getChildType() {
        return ['widget', 'container'];
      }

      onRender() {
        super.onRender();
        this.$el.addClass('aura-carousel uk-slider');
        this.updateCarouselPreview();
      }

      onElementChange(propertyName) {
        super.onElementChange(propertyName);
        if (/^(slides_|equal_height|carousel_name|direction)/.test(propertyName)) {
          this.updateCarouselPreview();
        }
      }

      getChildViewContainer() {
        return this.$el.find('.aura-carousel__items').first();
      }

      updateCarouselPreview() {
        const settings = this.model.get('settings');
        const allowed = ['1', '2', '3', '4', '5', '6'];
        const get = (name, fallback) => allowed.includes(String(settings.get(name))) ? String(settings.get(name)) : fallback;
        const $items = this.getChildViewContainer();

        $items.removeClass(function (_index, className) {
          return (className.match(/(^|\s)uk-child-width-\S+/g) || []).join(' ');
        }).addClass([
          `uk-child-width-1-${get('slides_to_show_mobile', '1')}`,
          `uk-child-width-1-${get('slides_to_show_tablet', '2')}@s`,
          `uk-child-width-1-${get('slides_to_show', '3')}@l`
        ]);
        this.$el.attr({
          'aria-label': settings.get('carousel_name') || 'Carrousel',
          dir: settings.get('direction') === 'rtl' ? 'rtl' : 'ltr'
        });
      }
    }

    AuraCarouselView.prototype.template = Marionette.TemplateCache.get(
      '#tmpl-elementor-aura-carousel-content'
    );

    elementor.hooks.addFilter('element/view', function (DefaultView, model) {
      if (model.get('elType') === 'aura-carousel') {
        return AuraCarouselView;
      }

      if (model.get('elType') === 'e-div-block') {
        if (!AuraDivBlockView) {
          AuraDivBlockView = DefaultView.extend({
            getChildType() {
              const childTypes = DefaultView.prototype.getChildType.call(this);
              return childTypes.includes('aura-carousel')
                ? childTypes
                : [...childTypes, 'aura-carousel'];
            }
          });
        }

        return AuraDivBlockView;
      }

      return DefaultView;
    });
  });

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => initializeAll(document));
  } else {
    initializeAll(document);
  }
})(jQuery);
