export interface Trophy {
  id: string;
  name: string;
  icon: string;
  body: string;
  guide?: { href: string; label: string };
}

export interface TrophyCategory {
  category: 'secret' | 'allegiance' | 'miscellaneous' | 'magic' | 'building';
  label: string;
  order: number;
  trophies: Trophy[];
}

const escapeAttribute = (value: string) => value
  .replaceAll('&', '&amp;')
  .replaceAll('"', '&quot;')
  .replaceAll('<', '&lt;')
  .replaceAll('>', '&gt;');

function icon(base: string, trophy: Trophy, alt = '') {
  return `<img src="${base}assets/game/sprites/${trophy.icon}" alt="${escapeAttribute(alt)}">`;
}

function bodyForBase(body: string, base: string) {
  return body.replaceAll('/realm/', base).replaceAll('/realm"', `${base}"`);
}

function frameBodyIcons(body: string) {
  return body.replace(/<img\b[^>]*\/assets\/game\/sprites\/[^>]*>/gi, (image) => `<span class="game-icon-frame">${image}</span>`);
}

function guideHtml(trophy: Trophy, base: string) {
  if (!trophy.guide) return '';
  const href = bodyForBase(trophy.guide.href, base);
  return `<p class="trophy-guide-link"><b>Guide</b>: <a href="${escapeAttribute(href)}">${trophy.guide.label}</a></p>`;
}

export function trophyDrawerHtml(categories: TrophyCategory[], base: string) {
  const sections = categories.map((category, index) => {
    const buttons = category.trophies.map((trophy) => {
      const heading = `<p><span class="game-icon-frame">${icon(base, trophy)}</span><b> ${trophy.name}</b></p>`;
      const tooltip = escapeAttribute(`${heading}${frameBodyIcons(bodyForBase(trophy.body, base))}${guideHtml(trophy, base)}`);
      const common = `class="trophy-grid-button" research="${tooltip}" aria-label="${escapeAttribute(trophy.name)}"`;
      return trophy.guide
        ? `<a ${common} href="${escapeAttribute(bodyForBase(trophy.guide.href, base))}" title="Open ${escapeAttribute(trophy.guide.label)}">${icon(base, trophy)}</a>`
        : `<button type="button" ${common}>${icon(base, trophy)}</button>`;
    }).join('');
    return `<details class="trophy-grid-section"${index === 0 ? ' open' : ''}><summary><span>${category.label} (${category.trophies.length}/${category.trophies.length})</span></summary><div class="trophy-icon-grid">${buttons}</div></details>`;
  }).join('');
  return `<div class="trophy-drawer">${sections}</div>`;
}

export function trophyListHtml(categories: TrophyCategory[], base: string) {
  const sections = categories.map((category, index) => {
    const trophies = category.trophies.map((trophy) => `<article class="trophy-entry" id="${trophy.id}"><p class="trophy-entry-heading">${icon(base, trophy, trophy.name)}<b>${trophy.name}</b></p>${bodyForBase(trophy.body, base)}${guideHtml(trophy, base)}</article>`).join('');
    return `<details class="trophy-list-section"${index === 0 ? ' open' : ''}><summary>${category.label} (${category.trophies.length})</summary><div class="trophy-list-entries">${trophies}</div></details>`;
  }).join('');
  return `<div class="trophy-text-list">${sections}</div>`;
}

export function validateTrophyCategories(categories: TrophyCategory[]) {
  const expected: Record<TrophyCategory['category'], number> = {
    secret: 60,
    allegiance: 45,
    miscellaneous: 170,
    magic: 62,
    building: 566,
  };
  const ids = new Set<string>();
  for (const category of categories) {
    if (category.trophies.length !== expected[category.category]) {
      throw new Error(`${category.label} has ${category.trophies.length} trophies; expected ${expected[category.category]}`);
    }
    for (const trophy of category.trophies) {
      if (ids.has(trophy.id)) throw new Error(`Duplicate trophy ID: ${trophy.id}`);
      ids.add(trophy.id);
    }
  }
  if (ids.size !== 903) throw new Error(`Trophy collection has ${ids.size} records; expected 903`);
}
