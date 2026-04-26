import { DotLottie } from '@lottiefiles/dotlottie-web';

declare global {
  interface Window {
    VANTA: any;
    THREE: any;
  }
}

const initError404 = function () {
  const jsFiles: { id: string; src: string }[] = [
    { id: 'three-js', src: 'https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js' },
    { id: 'vanta-fog', src: 'https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.fog.min.js' },
  ];

  for (const src in jsFiles) {
    if (!document.getElementById(jsFiles[src].id)) {
      const script = document.createElement('script');
      script.id = jsFiles[src].id;
      script.src = jsFiles[src].src;
      document.body.appendChild(script);
    }
  }

  window.addEventListener('load', () => {
    const iframe = document.querySelector('[name="editor-canvas"]');
    const $document =
      iframe instanceof HTMLIFrameElement && iframe.contentDocument
        ? iframe.contentDocument
        : document;
    const $block = $document.querySelector('.error_404-block:not(.page-404 .block)');

    if ($block) {
      // Ajoute dynamiquement le background si absent
      const $app = $document.querySelector('#app');
      if (!$block.querySelector('#background')) {
        const bgDiv = $document.createElement('div');
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

      $document.body.classList.add('page-404');
      window.VANTA.FOG({
        el: '#background',
        THREE: window.THREE,
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
    }
  });
};
export { initError404 };
