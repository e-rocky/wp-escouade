/* global jQuery, $e */
jQuery(window).on('elementor:init', () => {
  class SyncAuraBackground extends $e.modules.hookData.After {
    getCommand() {
      return 'document/elements/settings';
    }

    getId() {
      return 'aura-sync-parent-background';
    }

    getConditions(args) {
      return Object.prototype.hasOwnProperty.call(args.settings || {}, 'background');
    }

    apply(args) {
      const supported = ['aura-hero-intro', 'aura-numbers'];
      for (const original of args.containers || [args.container]) {
        const widget = original?.lookup();
        if (!widget || !supported.includes(widget.model.get('widgetType'))) continue;
        const parent = widget.parent;
        if (parent?.type !== 'container') continue;

        // Match the PHP rendering rule when several widgets share a container.
        const first = parent.model.get('elements').find((model) =>
          supported.includes(model.get('widgetType'))
        );
        if (first?.get('id') !== widget.model.get('id')) continue;

        const background = widget.settings.get('background');
        const current = parent.settings.get('css_classes') || '';
        const classes = current.split(/\s+/).filter((name) =>
          name && name !== 'bgi' && !/^bgi--[1-6]$/.test(name)
        );
        if (/^bgi--[1-6]$/.test(background)) classes.push('bgi', background);
        const next = classes.join(' ');
        if (next !== current) {
          $e.run('document/elements/settings', {
            container: parent,
            settings: { css_classes: next },
          });
        }
      }
    }
  }

  $e.hooks.data.register(new SyncAuraBackground());
});
