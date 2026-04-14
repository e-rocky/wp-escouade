import intlTelInput from 'intl-tel-input';

// @ts-ignore
import i18n from 'intl-tel-input/build/js/i18n/fr/index.js';

const phoneInputs = document.querySelectorAll<HTMLInputElement>(
  'input[data-intl-phone], input[type=tel]'
);

phoneInputs.forEach((input) => {
  intlTelInput(input, {
    i18n,
    initialCountry: 'mg',
    separateDialCode: true,
    loadUtils: () => import('intl-tel-input/utils'),
    geoIpLookup: (success, _) => {
      fetch('https://ipapi.co/json/')
        .then((res) => res.json())
        .then((data) => success((data.country_code || 'MG').toLowerCase()))
        .catch(() => success('mg')); // fallback
    },
  });
});
