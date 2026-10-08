export type IconAffiliation =
  | 'fairy' | 'elven' | 'angel' | 'goblin' | 'undead' | 'demon'
  | 'titan' | 'druid' | 'faceless' | 'dwarven' | 'drow' | 'mercenary'
  | 'dragon' | 'archon' | 'djinn' | 'makers'
  | 'good' | 'evil' | 'order' | 'chaos' | 'balance';

export type PrimaryAlignment = 'good' | 'evil' | 'neutral';
export type SecondaryAlignment = 'order' | 'chaos' | 'balance';

export const factionAlignmentPair: Partial<Record<IconAffiliation, [PrimaryAlignment, SecondaryAlignment]>> = {
  angel: ['good', 'order'],
  fairy: ['good', 'chaos'],
  elven: ['good', 'balance'],
  undead: ['evil', 'order'],
  demon: ['evil', 'chaos'],
  goblin: ['evil', 'balance'],
  titan: ['neutral', 'order'],
  faceless: ['neutral', 'chaos'],
  druid: ['neutral', 'balance'],
};

export const alignmentBackgroundColors = {
  good: '#7b9eb0',
  evil: '#841f19',
  neutral: '#cbc298',
  order: '#d5ebe7',
  chaos: '#78974e',
  balance: '#e6d17e',
} as const;

export interface ReferenceIconItem {
  label: string;
  icon: string;
  affiliation?: IconAffiliation;
  splitAlignments?: boolean;
  href?: string;
  tooltipHtml: string;
}
