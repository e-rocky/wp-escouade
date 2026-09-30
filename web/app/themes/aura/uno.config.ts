import { defineConfig, presetWind3 } from 'unocss';

export default defineConfig({
  content: {
    filesystem: [
      '*.{html,php}',
      './**/*.{html,php}',
      'src/**/*.{js,ts,jsx,tsx}',
      'templates/**/*.{html,php,twig}',
      'views/**/*.{html,php,twig}',
    ],
  },
  safelist: [
    'py-0',
    'my-0',
    'px-0',
    'mx-0',
    'pt-0',
    'pb-0',
    'pl-0',
    'pr-0',
    'mt-0',
    'mb-0',
    'ml-0',
    'mr-0',
    'mx-4',
    'lg:mx-4',
  ],
  presets: [presetWind3()],
  rules: [[/^fz\:(\d+(?:\.\d+)?)$/, ([, num]) => ({ 'font-size': `${num}px` })]],
});
