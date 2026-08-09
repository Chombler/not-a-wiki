export type TierTableKind =
  | 'druidic-vocabulary' | 'mabinogion' | 'grove-farming' | 'overflowing-magic'
  | 'abyssal-furnace' | 'bedrock-foundations' | 'dwarf-bloodline'
  | 'hierarchy' | 'apprenticeship' | 'decentralization' | 'upheaval'
  | 'wall-fragment' | 'wall-chunk' | 'mathematician' | 'maelstrom'
  | 'dragons-breath-green';

const buildings = [
  'Farm', 'Inn', 'Blacksmith', 'Warrior Barracks / Slave Pen / Deep Mine',
  "Knight's Joust / Orcish Arena / Stone Pillars", 'Wizard Tower / Witch Conclave / Alchemist Lab',
  'Cathedral / Dark Temple / Monastery', 'Citadel / Necropolis / Labyrinth',
  'Royal Castle / Evil Fortress / Iron Stronghold', "Heaven's Gate / Hell Portal / Ancient Pyramid",
  'Hall of Legends',
];
const values = {
  'druidic-vocabulary': (tier: number) => [4000 * (12 - tier), '%'],
  mabinogion: (tier: number) => [12 * 1.8 ** (12 - tier), '%'],
  'grove-farming': (tier: number) => [0.8 * (6 - Math.abs(6 - tier)) ** 4, '%'],
  'overflowing-magic': (tier: number) => [3 * (12 - tier), ' × x^0.7%'],
  'abyssal-furnace': (tier: number) => [0.5 * tier ** 1.5, ' × x^0.5%'],
  'bedrock-foundations': (tier: number) => [10 ** (0.75 * tier), ' base production/s'],
  'dwarf-bloodline': (tier: number) => [10 ** ((1.25 * tier) ** 0.75), ' × ln(1 + x)^1.75 base production/s'],
  hierarchy: (tier: number) => [0.1 * (12 - tier) ** 2, ' × x^0.45%'],
  apprenticeship: (tier: number) => [1.4 ** (12 - tier), ' × B'],
  decentralization: (tier: number) => [(3 - 0.25 * tier) ** 4, ' × x^0.6%'],
  upheaval: (tier: number) => [0.5 * (12 - tier) ** 2.15, ' × (60 + x)^0.75%'],
  'wall-fragment': (tier: number) => [3 * (2 * (11 - tier)) ** 3, '%'],
  'wall-chunk': (tier: number) => [30000 * (11 - tier) ** 3.5, '%'],
  mathematician: (tier: number) => [10 * (12 - tier), '%'],
  maelstrom: (tier: number) => [100 * (12 - tier), '% base-assistant multiplier'],
  'dragons-breath-green': (tier: number) => [0.000001 * (11 - tier) ** 5, ' × ln(1 + x)^6%'],
} satisfies Record<TierTableKind, (tier: number) => [number, string]>;

const format = (value: number) => {
  if (Math.abs(value) >= 1_000_000) return value.toPrecision(4);
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

export function isTierTableKind(value: string): value is TierTableKind {
  return Object.hasOwn(values, value);
}

const escapeHtml = (value: string | number) => String(value)
  .replaceAll('&', '&amp;').replaceAll('<', '&lt;').replaceAll('>', '&gt;')
  .replaceAll('"', '&quot;').replaceAll("'", '&#039;');

export function tierTableHtml(kind: TierTableKind, heading: string) {
  const rows = tierRows(kind).map((row) => `<tr><td>${row.tier}</td><td>${escapeHtml(row.building)}</td><td>${escapeHtml(row.value)}</td></tr>`).join('');
  return `<table class="numtable tier-table"><caption><b>${escapeHtml(heading)}</b></caption><thead><tr><th>Tier</th><th>Building</th><th>Bonus / formula</th></tr></thead><tbody>${rows}</tbody></table>`;
}
