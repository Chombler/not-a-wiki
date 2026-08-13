export type SpellSection = 'default' | 'alignment' | 'faction' | 'mercenary' | 'secondary-alignment' | 'astral' | 'special';

export interface SpellRecord {
  id: string;
  name: string;
  icon: string;
  section: SpellSection;
  affiliation?: string;
  body: string;
  supplement?: string;
  upgradeId?: string;
  challengeId?: string;
}

export interface SpellRelatedRecord {
  id: string;
  spellId: string;
  name: string;
  icon: string;
  body: string;
}

export interface SpellReference {
  spells: SpellRecord[];
  upgrades: SpellRelatedRecord[];
  challenges: SpellRelatedRecord[];
}

const sectionLabels: Record<SpellSection, string> = {
  default: 'All-Faction Default Spells',
  alignment: 'Alignment Spells',
  faction: 'Faction Spells',
  mercenary: 'Mercenary Tax Collection Variants',
  'secondary-alignment': 'Ascension 2: Secondary Alignment Spells',
  astral: 'Astral Faction Spells',
  special: 'Special Spells',
};

const escapeAttribute = (value: string) => value.replaceAll('&', '&amp;').replaceAll('"', '&quot;').replaceAll('<', '&lt;').replaceAll('>', '&gt;');
const bodyForBase = (body: string, base: string) => body.replaceAll('/realm/', base).replaceAll('/realm"', `${base}"`);
const image = (base: string, record: Pick<SpellRecord, 'icon' | 'name'>) => `<img src="${base}assets/game/sprites/${record.icon}" alt="${escapeAttribute(record.name)}">`;
const framedImage = (base: string, record: Pick<SpellRecord, 'icon' | 'name'>) => `<span class="game-icon-frame">${image(base, record)}</span>`;
const frameBodyIcons = (body: string) => body.replace(/<img\b[^>]*\/assets\/game\/sprites\/[^>]*>/gi, (value) => `<span class="game-icon-frame">${value}</span>`);

function gridButton(record: SpellRecord | SpellRelatedRecord, base: string, kind: string) {
  const heading = `<p>${framedImage(base, record)}<b> ${record.name}</b></p>`;
  const tooltip = escapeAttribute(`${heading}${frameBodyIcons(bodyForBase(record.body, base))}`);
  const target = 'spellId' in record ? record.spellId : record.id;
  return `<a class="trophy-grid-button spell-grid-button spell-grid-button--${kind}" research="${tooltip}" href="#${target}" aria-label="${escapeAttribute(record.name)}">${image(base, record)}</a>`;
}

function relatedDetail(label: string, record: SpellRelatedRecord | undefined, base: string) {
  if (!record) return '';
  return `<section class="spell-related"><p class="spell-related-heading"><b>${label}</b>: ${framedImage(base, record)}<b>${record.name}</b></p>${bodyForBase(record.body, base)}</section>`;
}

export function spellReferenceHtml(reference: SpellReference, base: string) {
  const spellGrid = reference.spells.map((record) => gridButton(record, base, 'spell')).join('');
  const upgradeGrid = reference.upgrades.map((record) => gridButton(record, base, 'upgrade')).join('');
  const challengeGrid = reference.challenges.map((record) => gridButton(record, base, 'challenge')).join('');
  const grids = `<div class="spell-reference-grids"><section class="spell-grid-panel"><h3>Spells</h3><div class="trophy-icon-grid spell-icon-grid">${spellGrid}</div></section><details class="spell-related-grids"><summary>Spell Trophies and Challenge Rewards</summary><div class="spell-related-grid-panels"><section class="spell-grid-panel"><h3>Spell Trophies</h3><div class="trophy-icon-grid spell-icon-grid">${upgradeGrid}</div></section><section class="spell-grid-panel"><h3>Challenge Rewards</h3><div class="trophy-icon-grid spell-icon-grid">${challengeGrid}</div></section></div></details></div>`;
  const details = Object.entries(sectionLabels).map(([section, label]) => {
    const entries = reference.spells.filter((spell) => spell.section === section).map((spell) => {
      const upgrade = reference.upgrades.find((record) => record.id === spell.upgradeId);
      const challenge = reference.challenges.find((record) => record.id === spell.challengeId);
      const affiliation = spell.affiliation ? ` <span class="spell-affiliation">(${spell.affiliation})</span>` : '';
      return `<article class="spell-entry" id="${spell.id}"><p class="spell-entry-heading">${framedImage(base, spell)}<b>${spell.name}</b>${affiliation}</p>${bodyForBase(spell.body, base)}${relatedDetail('Spell Trophy & Upgrade', upgrade, base)}${relatedDetail('Challenge Upgrade', challenge, base)}${bodyForBase(spell.supplement ?? '', base)}</article>`;
    }).join('');
    return `<section class="spell-section"><h2>${label}</h2>${entries}</section>`;
  }).join('');
  return `${grids}<div class="spell-reference-details">${details}</div>`;
}

export function validateSpellReference(reference: SpellReference) {
  if (reference.spells.length !== 30) throw new Error(`Spell collection has ${reference.spells.length} spells; expected 30`);
  if (reference.upgrades.length !== 16) throw new Error(`Spell collection has ${reference.upgrades.length} trophy upgrades; expected 16`);
  if (reference.challenges.length !== 16) throw new Error(`Spell collection has ${reference.challenges.length} challenge rewards; expected 16`);
  const spellIds = new Set(reference.spells.map(({ id }) => id));
  const ids = [...reference.spells, ...reference.upgrades, ...reference.challenges].map(({ id }) => id);
  if (new Set(ids).size !== ids.length) throw new Error('Spell collection contains duplicate IDs');
  for (const related of [...reference.upgrades, ...reference.challenges]) {
    if (!spellIds.has(related.spellId)) throw new Error(`${related.name} refers to unknown spell ${related.spellId}`);
  }
}
