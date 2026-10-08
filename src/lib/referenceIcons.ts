export type IconAffiliation =
  | 'fairy' | 'elven' | 'angel' | 'goblin' | 'undead' | 'demon'
  | 'titan' | 'druid' | 'faceless' | 'dwarven' | 'drow' | 'mercenary'
  | 'dragon' | 'archon' | 'djinn' | 'makers'
  | 'good' | 'evil' | 'order' | 'chaos' | 'balance';

export interface ReferenceIconItem {
  label: string;
  icon: string;
  affiliation?: IconAffiliation;
  href?: string;
  tooltipHtml: string;
}
