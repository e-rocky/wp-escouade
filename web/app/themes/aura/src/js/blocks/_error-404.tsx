import { DotLottie } from '@lottiefiles/dotlottie-web';

import * as THREE from 'three';
import FOG from 'vanta/dist/vanta.fog.min';

const $block = document.querySelector('.error_404-block');

if ($block) {
  // Ajoute dynamiquement le background si absent
  const $app = document.querySelector('#app');
  if (!$block.querySelector('#background')) {
    const bgDiv = document.createElement('div');
    bgDiv.id = 'background';
    $app?.prepend(bgDiv);
  }

  const $canvas = $block.querySelector<HTMLCanvasElement>('#canvas');
  if ($canvas) {
    new DotLottie({
      autoplay: true,
      loop: true,
      canvas: $canvas,
      src: 'https://lottie.host/01cc43f5-24ac-4649-b943-ae35512c397d/tcanZVpnG5.lottie', // or .json file
    });
  }

  window.addEventListener('load', function () {
    document.body.classList.add('page-404');
    FOG({
      el: '#background',
      THREE: THREE,
      mouseControls: true,
      touchControls: true,
      gyroControls: false,
      minHeight: 200.0,
      minWidth: 200.0,
      highlightColor: 0x2f5efa,
      midtoneColor: 0x43fea5,
      lowlightColor: 0xf473d0,
      baseColor: 0xf473d0,
      blurFactor: 0.9,
      speed: 2.5,
      zoom: 0.4,
    });
  });
}
