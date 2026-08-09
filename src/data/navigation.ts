export interface NavigationItem {
  label: string;
  href: string;
  children?: NavigationItem[];
}

export interface NavigationGroup {
  label: string;
  className?: string;
  items: NavigationItem[];
}

export const navigation: NavigationGroup[] = [
  {
    label: 'Early game reference',
    items: [
      { label: 'Buildings', href: 'BuildingAlignments' },
      { label: 'Factions', href: 'Factions' },
      { label: 'Faction upgrades', href: 'FactionUpgrades' },
      { label: 'Spells', href: 'Spells' },
      { label: 'Resources', href: 'Resources' },
      { label: 'Trophies', href: 'TrophyPage' },
      { label: 'Excavations & artifacts', href: 'Artifacts' },
    ],
  },
  {
    label: 'Unlockable systems',
    items: [
      { label: 'Challenges', href: 'Challenges' },
      { label: 'Bloodlines', href: 'Bloodline' },
      { label: 'Heritages', href: 'Heritages' },
      { label: 'Reincarnation', href: 'Reincarnation' },
    ],
  },
  {
    label: 'Reincarnation & research',
    items: [
      { label: 'Research', href: 'Research' },
      { label: 'Research list', href: 'ResearchList' },
      { label: 'Unique buildings', href: 'UniqueBuilding' },
      { label: 'Spell tiers', href: 'SpellTiers' },
      { label: 'Lineages', href: 'Lineages' },
    ],
  },
  {
    label: 'Ascensions',
    items: [
      { label: 'Ascension 1', href: 'Ascension' },
      { label: 'Ascension 2', href: 'Ascension2' },
      { label: 'Legacies', href: 'Legacies' },
      { label: 'Ascension 4', href: 'Ascension4' },
      { label: 'Artifact sets', href: 'ArtifactSet' },
      { label: 'Other upgrades', href: 'Upgrades' },
    ],
  },
  {
    label: 'Guides & builds',
    className: 'guides-preview-group',
    items: [
      { label: 'Ascension 0', href: 'A0Guide', children: [
        { label: 'R0–R15', href: 'A0R0-R15' }, { label: 'R16–R29', href: 'A0R16-R29' }, { label: 'R30–R39', href: 'A0R30-R39' },
      ] },
      { label: 'Ascension 1', href: 'A1Guide', children: [
        { label: 'R40–R59', href: 'A1R40-R59' }, { label: 'R60–R74', href: 'A1R60-R74' }, { label: 'R75–R99', href: 'A1R75-R99' },
      ] },
      { label: 'Ascension 2', href: 'A2Guide', children: [
        { label: 'R100–R115', href: 'A2R100-R115' }, { label: 'R116–R124', href: 'A2R116-R124' }, { label: 'R125–R138', href: 'A2R125-R138' }, { label: 'R139–R159', href: 'A2R139-R159' },
      ] },
      { label: 'Ascension 3', href: 'A3Guide', children: [
        { label: 'R160–R180', href: 'A3R160-R180' }, { label: 'R181–R189', href: 'A3R181-R189' }, { label: 'R190–R205', href: 'A3R190-R205' }, { label: 'R206–R219', href: 'A3R206-R219' }, { label: 'Special-purpose', href: 'A3SpecialBuilds' },
      ] },
      { label: 'Ascension 4', href: 'A4Guide', children: [
        { label: 'R220–R229', href: 'A4R220-R229' }, { label: 'R230–R254', href: 'A4R230-R254' }, { label: 'R255–R279', href: 'A4R255-R279' }, { label: 'Post-A4', href: 'A4PostA4' },
      ] },
    ],
  },
  {
    label: 'Reference & history',
    className: 'progression-group-secondary',
    items: [
      { label: 'Events', href: 'Events' },
      { label: 'Notation', href: 'Notation' },
      { label: 'Terminology', href: 'Terminology' },
      { label: 'Changelog', href: 'Changelog' },
      { label: 'All pages', href: 'SiteMap' },
    ],
  },
];
