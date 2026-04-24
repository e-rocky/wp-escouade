import domReady from '@wordpress/dom-ready';
import { initError404 } from '../../src/js/blocks/_error-404';

domReady(() => {
  initError404();
});
