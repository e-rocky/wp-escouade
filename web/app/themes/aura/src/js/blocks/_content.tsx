const block = document.querySelectorAll('block.content-block');
if (block) {
  const parent = '.content-card__body';
  const headingsSelector = `${parent} h1, ${parent} h2, ${parent} h3, ${parent} h4, ${parent} h5, ${parent} h6`;
  addHeadingsIds(headingsSelector);
  generateNavLinks(headingsSelector);
}

function addHeadingsIds(headingsSelector: string) {
  // Ajoute automatiquement un id aux headings (h1-h6) basé sur leur texte
  document.addEventListener('DOMContentLoaded', function () {
    const headings = document.querySelectorAll(headingsSelector);
    if (!headings.length) return;
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

function generateNavLinks(headingsSelector: string) {
  document.addEventListener('DOMContentLoaded', function () {
    const nav = document.querySelector('.content-card__header .rte .uk-nav');
    if (!nav) return;
    nav.innerHTML = '';
    const headings = document.querySelectorAll(headingsSelector);
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
