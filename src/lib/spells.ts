export interface SpellMenuEntry {
  id: string;
  name: string;
  icon: string;
  target: string;
  tooltip: string;
}

export interface SpellMenu {
  spells: SpellMenuEntry[];
  upgrades: SpellMenuEntry[];
  challenges: SpellMenuEntry[];
}

const escapeAttribute = (value: string) => value
  .replaceAll('&', '&amp;')
  .replaceAll('"', '&quot;')
  .replaceAll('<', '&lt;')
  .replaceAll('>', '&gt;');

const bodyForBase = (body: string, base: string) => body
  .replaceAll('/realm/', base)
  .replaceAll('/realm"', `${base}"`);

function image(base: string, entry: SpellMenuEntry) {
  return `<img src="${base}assets/game/sprites/${entry.icon}" alt="${escapeAttribute(entry.name)}">`;
}

function framedImage(base: string, entry: SpellMenuEntry) {
  return `<span class="game-icon-frame">${image(base, entry)}</span>`;
}

function frameTooltipIcons(body: string) {
  return body.replace(
    /<img\b[^>]*\/assets\/game\/sprites\/[^>]*>/gi,
    (value) => `<span class="game-icon-frame">${value}</span>`,
  );
}

function gridButton(entry: SpellMenuEntry, base: string, kind: string) {
  const heading = `<p>${framedImage(base, entry)}<b> ${entry.name}</b></p>`;
  const tooltip = escapeAttribute(`${heading}${frameTooltipIcons(bodyForBase(entry.tooltip, base))}`);
  return `<a class="trophy-grid-button spell-grid-button spell-grid-button--${kind}" research="${tooltip}" href="#${entry.target}" aria-label="${escapeAttribute(entry.name)}">${image(base, entry)}</a>`;
}

export function spellMenuHtml(menu: SpellMenu, base: string) {
  const spellGrid = menu.spells.map((entry) => gridButton(entry, base, 'spell')).join('');
  const upgradeGrid = menu.upgrades.map((entry) => gridButton(entry, base, 'upgrade')).join('');
  const challengeGrid = menu.challenges.map((entry) => gridButton(entry, base, 'challenge')).join('');
  return `<div class="spell-reference-grids"><section class="spell-grid-panel"><h3>Spells</h3><div class="trophy-icon-grid spell-icon-grid">${spellGrid}</div></section><details class="spell-related-grids"><summary>Spell Trophies and Challenge Rewards</summary><div class="spell-related-grid-panels"><section class="spell-grid-panel"><h3>Spell Trophies</h3><div class="trophy-icon-grid spell-icon-grid">${upgradeGrid}</div></section><section class="spell-grid-panel"><h3>Challenge Rewards</h3><div class="trophy-icon-grid spell-icon-grid">${challengeGrid}</div></section></div></details></div>`;
}

export function validateSpellMenu(menu: SpellMenu) {
  const expected = { spells: 30, upgrades: 16, challenges: 16 } as const;
  const ids = new Set<string>();
  for (const kind of Object.keys(expected) as Array<keyof typeof expected>) {
    if (menu[kind].length !== expected[kind]) {
      throw new Error(`Spell menu has ${menu[kind].length} ${kind}; expected ${expected[kind]}`);
    }
    for (const entry of menu[kind]) {
      if (ids.has(entry.id)) throw new Error(`Duplicate spell-menu ID: ${entry.id}`);
      ids.add(entry.id);
    }
  }
}
