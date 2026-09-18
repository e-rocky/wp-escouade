(function ($) {
  'use strict';

  $(window).on('elementor:init', function () {
    const nativeContainer = elementor.elementsManager.getElementTypeClass('container');

    if (!nativeContainer) {
      return;
    }

    // Reuse Elementor's native Container model and view for the custom type.
    elementor.elementsManager.elementTypes['container-custom'] = nativeContainer;

    const NativeContainerView = nativeContainer.getView();

    class ContainerCustomView extends NativeContainerView {
      onRender() {
        super.onRender();

        if (!this.$el.find('.container-custom__slider-items').length) {
          const $contentTarget = this.$el.children('.e-con-inner').length
            ? this.$el.children('.e-con-inner')
            : this.$el;

          $contentTarget.append(
            '<div class="container-custom__slider-items uk-slider-items" aria-live="polite"></div>'
          );
        }

        this.$el.addClass('container-custom uk-slider');
        this.$el.attr({
          'data-uk-slider': '',
          role: 'region',
          'aria-roledescription': 'carousel'
        });

        this.updateSliderWidthClasses();
      }

      onElementChange(propertyName) {
        super.onElementChange(propertyName);

        if (propertyName.indexOf('slider_child_width') === 0) {
          this.updateSliderWidthClasses();
        }
      }

      getChildViewContainer() {
        return this.$el.find('.container-custom__slider-items').first();
      }

      updateSliderWidthClasses() {
        const allowedWidths = ['1-1', '1-2', '1-3', '1-4', '1-5', '1-6'];
        const settings = this.model.get('settings');
        const sanitize = (value, fallback) => allowedWidths.includes(value) ? value : fallback;
        const mobile = sanitize(settings.get('slider_child_width_mobile'), '1-1');
        const tablet = sanitize(settings.get('slider_child_width_tablet'), '1-2');
        const desktop = sanitize(settings.get('slider_child_width'), '1-3');
        const $items = this.$el.find('.container-custom__slider-items').first();

        $items.removeClass(function (_index, className) {
          return (className.match(/(^|\s)uk-child-width-\S+/g) || []).join(' ');
        });

        $items.addClass([
          `uk-child-width-${mobile}`,
          `uk-child-width-${tablet}@s`,
          `uk-child-width-${desktop}@l`
        ]);
      }
    }

    elementor.hooks.addFilter('element/view', function (DefaultView, model) {
      return model.get('elType') === 'container-custom'
        ? ContainerCustomView
        : DefaultView;
    });
  });
})(jQuery);
