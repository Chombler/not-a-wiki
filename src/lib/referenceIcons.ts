export type IconAffiliation =
  | 'fairy' | 'elven' | 'angel' | 'goblin' | 'undead' | 'demon'
  | 'titan' | 'druid' | 'faceless' | 'dwarven' | 'drow' | 'mercenary'
  | 'dragon' | 'archon' | 'djinn' | 'makers'
  | 'good' | 'evil' | 'order' | 'chaos' | 'balance';

export type IconTrim = 'good' | 'evil' | 'order' | 'chaos' | 'balance';

const affiliationTrims: Partial<Record<IconAffiliation, IconTrim>> = {
  angel: 'order',
  fairy: 'chaos',
  elven: 'balance',
  undead: 'order',
  demon: 'chaos',
  goblin: 'balance',
  titan: 'order',
  faceless: 'chaos',
  druid: 'balance',
  dwarven: 'good',
  drow: 'evil',
  archon: 'order',
  djinn: 'chaos',
  makers: 'balance',
  good: 'good',
  evil: 'evil',
  order: 'order',
  chaos: 'chaos',
  balance: 'balance',
};

export const iconTrimForAffiliation = (affiliation?: IconAffiliation) =>
  affiliation ? affiliationTrims[affiliation] : undefined;

export interface ReferenceIconItem {
  label: string;
  icon: string;
  affiliation?: IconAffiliation;
  href?: string;
  tooltipHtml: string;
}
