const block = document.querySelectorAll('block.content-block');
if (block) {
  addHeadingsIds();
  generateNavLinks();
}

function addHeadingsIds() {
  // Ajoute automatiquement un id aux headings (h1-h6) basé sur leur texte
  document.addEventListener('DOMContentLoaded', function () {
    const headings = document.querySelectorAll(
      '.content-block h1, .content-block h2, .content-block h3, .content-block h4, .content-block h5, .content-block h6'
    );
    const usedIds = new Set();
    headings.forEach((heading) => {
      if (!heading.id) {
        let baseId = heading.textContent
          .trim()
          .toLowerCase()
          .replace(/[^a-z0-9\s-]/g, '')
          .replace(/\s+/g, '-');
        let id = baseId;
        let counter = 1;
        while (usedIds.has(id) || document.getElementById(id)) {
          id = `${baseId}-${counter++}`;
        }
        heading.id = id;
        usedIds.add(id);
      }
    });
  });
}

function generateNavLinks() {
  document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('.uk-nav');
    if (!nav) return;
    nav.innerHTML = '';
    const headings = document.querySelectorAll('h1, h2, h3, h4, h5, h6');
    headings.forEach((heading) => {
      if (heading.id) {
        const li = document.createElement('li');
        const a = document.createElement('a');
        a.href = `#${heading.id}`;
        a.textContent = heading.textContent;
        li.appendChild(a);
        nav.appendChild(li);
      }
    });
  });
}
