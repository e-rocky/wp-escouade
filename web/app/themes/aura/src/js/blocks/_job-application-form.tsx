import UIkit from 'uikit';

const $block = document.querySelector('.job-application-form');

if ($block) {
  const originalFetch = window.fetch;

  window.fetch = async (...args) => {
    const response = await originalFetch(...args);

    if (typeof args[0] === 'string' && args[0].includes('/wp-json/contact-form')) {
      const clone = response.clone();
      const data = await clone.json().catch(() => null);
      if (data.status == 'validation_failed') {
        UIkit.notification("<i uk-icon='icon: warning'></i><span>" + data.message + '</span>', {
          status: 'danger',
          pos: 'bottom-center',
        });
      }
    }

    return response;
  };
}
