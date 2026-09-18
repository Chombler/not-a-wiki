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
