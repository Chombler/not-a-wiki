export type IconAffiliation =
  | 'fairy' | 'elven' | 'angel' | 'goblin' | 'undead' | 'demon'
  | 'titan' | 'druid' | 'faceless' | 'dwarven' | 'drow' | 'mercenary'
  | 'dragon' | 'archon' | 'djinn' | 'makers'
  | 'good' | 'evil' | 'order' | 'chaos' | 'balance';

export type IconTrim = Exclude<IconAffiliation, 'mercenary'>;
export type PrimaryAlignment = 'good' | 'evil' | 'neutral';
export type SecondaryAlignment = 'order' | 'chaos' | 'balance';

export interface IconPresentation {
  trim?: IconTrim;
  primary?: PrimaryAlignment;
  secondary?: SecondaryAlignment;
}

export const alignmentColors = {
  good: '#295266',
  evil: '#3d0000',
  neutral: '#231f20',
  order: '#789893',
  chaos: '#809b2d',
  balance: '#a89a60',
} as const;

const affiliationPresentations: Partial<Record<IconAffiliation, IconPresentation>> = {
  angel: { trim: 'angel', primary: 'good', secondary: 'order' },
  fairy: { trim: 'fairy', primary: 'good', secondary: 'chaos' },
  elven: { trim: 'elven', primary: 'good', secondary: 'balance' },
  undead: { trim: 'undead', primary: 'evil', secondary: 'order' },
  demon: { trim: 'demon', primary: 'evil', secondary: 'chaos' },
  goblin: { trim: 'goblin', primary: 'evil', secondary: 'balance' },
  titan: { trim: 'titan', primary: 'neutral', secondary: 'order' },
  faceless: { trim: 'faceless', primary: 'neutral', secondary: 'chaos' },
  druid: { trim: 'druid', primary: 'neutral', secondary: 'balance' },
  dwarven: { trim: 'good' },
  drow: { trim: 'evil' },
  archon: { trim: 'order' },
  djinn: { trim: 'chaos' },
  makers: { trim: 'balance' },
  good: { trim: 'good' },
  evil: { trim: 'evil' },
  order: { trim: 'order' },
  chaos: { trim: 'chaos' },
  balance: { trim: 'balance' },
};

export const iconPresentationForAffiliation = (affiliation?: IconAffiliation): IconPresentation =>
  affiliation ? affiliationPresentations[affiliation] ?? {} : {};

export interface ReferenceIconItem {
  label: string;
  icon: string;
  affiliation?: IconAffiliation;
  href?: string;
  tooltipHtml: string;
}
