const $block = document.querySelector('.job-advertising-block');

if ($block) {
  $block.querySelectorAll('a').forEach((card) => {
    const observer = new MutationObserver(() => {
      if (card.classList.contains('dragging')) {
        card.style.setProperty('cursor', 'grabbing', 'important');
      } else {
        card.style.setProperty('cursor', 'pointer', 'important');
      }
    });
    observer.observe(card, { attributes: true, attributeFilter: ['style'] });
    // Force le style au chargement
    card.style.setProperty('cursor', 'pointer', 'important');

    card.addEventListener('mousedown', function () {
      card.classList.add('dragging');
      card.style.removeProperty('cursor');
      card.style.cursor = 'grabbing';
    });

    card.addEventListener('mouseup', function () {
      card.classList.remove('dragging');
      card.style.cursor = '';
    });
    card.addEventListener('mouseout', function () {
      card.classList.remove('dragging');
      card.style.cursor = '';
    });
  });
}
