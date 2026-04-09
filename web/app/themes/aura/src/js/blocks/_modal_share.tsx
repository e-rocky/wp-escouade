import UIkit from 'uikit';

function share() {
  const $block = document.querySelector('.block-modal__share');
  if ($block) {
    const $input_link: HTMLInputElement | null =
      $block.querySelector<HTMLInputElement>('input[name=link]');
    const $button = document.querySelectorAll('.share-btn');
    const $copy = $block.querySelector('.copy');

    console.log($button);

    $button.forEach((btn) => {
      btn.addEventListener('click', function (e) {
        e.preventDefault();
        UIkit.modal('#modal-share').show();
      });
    });

    $copy?.addEventListener('click', function () {
      const inputField = $input_link;
      const success_message = 'Le lien a été copié !';
      const url: string = $input_link?.value || '';
      inputField?.select();
      navigator.clipboard
        .writeText(url)
        .then(() => {
          UIkit.notification.closeAll();
          UIkit.notification("<span uk-icon='icon: check'></span> " + success_message, {
            status: 'success',
            pos: 'bottom-center',
            timeout: 60 * 60 * 1000, // 1 hour
          });
        })
        .catch((err) => {
          console.error('Failed to copy text: ', err);
        });
    });
  }
}

share();
