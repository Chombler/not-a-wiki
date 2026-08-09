export type TierTableKind = 'hierarchy' | 'apprenticeship' | 'decentralization' | 'upheaval';

const buildings = [
  'Farm', 'Inn', 'Blacksmith', 'Warrior Barracks / Slave Pen / Deep Mine',
  "Knight's Joust / Orcish Arena / Stone Pillars", 'Wizard Tower / Witch Conclave / Alchemist Lab',
  'Cathedral / Dark Temple / Monastery', 'Citadel / Necropolis / Labyrinth',
  'Royal Castle / Evil Fortress / Iron Stronghold', "Heaven's Gate / Hell Portal / Ancient Pyramid",
  'Hall of Legends',
];
const values = {
  hierarchy: (tier: number) => [0.1 * (12 - tier) ** 2, ' × x^0.45%'],
  apprenticeship: (tier: number) => [1.4 ** (12 - tier), ' × B'],
  decentralization: (tier: number) => [(3 - 0.25 * tier) ** 4, ' × x^0.6%'],
  upheaval: (tier: number) => [0.5 * (12 - tier) ** 2.15, ' × (60 + x)^0.75%'],
} satisfies Record<TierTableKind, (tier: number) => [number, string]>;

const format = (value: number) => {
  if (Math.abs(value) >= 1000) return value.toLocaleString('en-US', { maximumFractionDigits: 2 });
  return Number(value.toFixed(8)).toString();
};

export function tierRows(kind: TierTableKind) {
  return buildings.map((building, index) => {
    const tier = index + 1;
    const [value, suffix] = values[kind](tier);
    return { tier, building, value: `${format(value)}${suffix}` };
  });
}

const escapeHtml = (value: string | number) => String(value)
  .replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;')
  .replaceAll('"', '&quot;').replaceAll("'", '&#039;');

export function tierTableHtml(kind: TierTableKind, heading: string) {
  const rows = tierRows(kind).map((row) => `<tr><td>${row.tier}</td><td>${escapeHtml(row.building)}</td><td>${escapeHtml(row.value)}</td></tr>`).join('');
  return `<table class="numtable tier-table"><caption><b>${escapeHtml(heading)}</b></caption><thead><tr><th>Tier</th><th>Building</th><th>Bonus / formula</th></tr></thead><tbody>${rows}</tbody></table>`;
}
