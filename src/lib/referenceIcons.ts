export type IconAffiliation =
  | 'fairy' | 'elven' | 'angel' | 'goblin' | 'undead' | 'demon'
  | 'titan' | 'druid' | 'faceless' | 'dwarven' | 'drow' | 'mercenary'
  | 'dragon' | 'archon' | 'djinn' | 'makers'
  | 'good' | 'evil' | 'order' | 'chaos' | 'balance';

export type PrimaryAlignment = 'good' | 'evil' | 'neutral';
export type SecondaryAlignment = 'order' | 'chaos' | 'balance';
export type SpellAlignment = PrimaryAlignment | SecondaryAlignment;

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

export interface ReferenceIconItem {
  label: string;
  icon: string;
  affiliation?: IconAffiliation;
  splitAlignments?: boolean;
  alignmentBackground?: SpellAlignment;
  href?: string;
  tooltipHtml: string;
}
