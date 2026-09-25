export interface NavigationItem {
  label: string;
  href: string;
}

export interface NavigationCategory extends NavigationItem {
  pages: NavigationItem[];
}

export interface NavigationGroup {
  label: string;
  className?: string;
  items: NavigationCategory[];
}

const factionPages: NavigationItem[] = [
  ['Fairy', 'FairyFaction'], ['Elf', 'ElfFaction'], ['Angel', 'AngelFaction'],
  ['Goblin', 'GoblinFaction'], ['Undead', 'UndeadFaction'], ['Demon', 'DemonFaction'],
  ['Titan', 'TitanFaction'], ['Druid', 'DruidFaction'], ['Faceless', 'FacelessFaction'],
  ['Dwarf', 'DwarfFaction'], ['Drow', 'DrowFaction'], ['Dragon', 'DragonFaction'],
  ['Archon', 'ArchonFaction'], ['Djinn', 'DjinnFaction'], ['Makers', 'MakersFaction'],
].map(([label, href]) => ({ label, href }));

const challengePages: NavigationItem[] = [
  ['Fairy', 'Fairy'], ['Elf', 'Elf'], ['Angel', 'Angel'], ['Goblin', 'Goblin'],
  ['Undead', 'Undead'], ['Demon', 'Demon'], ['Titan', 'Titan'], ['Druid', 'Druid'],
  ['Faceless', 'Faceless'], ['Dwarf', 'Dwarf'], ['Drow', 'Drow'], ['Dragon', 'Dragons'],
  ['Mercenary', 'Mercenary'], ['Archon', 'Archon'], ['Djinn', 'Djinn'], ['Makers', 'Makers'],
].map(([label, href]) => ({ label: `${label} challenges`, href }));

export const navigation: NavigationGroup[] = [
  {
    label: 'Core game',
    items: [
      { label: 'Game basics', href: 'GameBasics', pages: [
        { label: 'Game window', href: 'GameWindow' },
        { label: 'Resources', href: 'Resources' },
        { label: 'Rubies', href: 'Rubies' },
      ] },
      { label: 'Buildings', href: 'BuildingAlignments', pages: [
        { label: 'Building upgrades', href: 'BuildingUpgrades' },
        { label: 'Unique buildings', href: 'UniqueBuilding' },
      ] },
      { label: 'Spells', href: 'Spells', pages: [
        { label: 'Mana and autocasting', href: 'ManaAutocasting' },
        { label: 'Spell tiers', href: 'SpellTiers' },
      ] },
      { label: 'Factions', href: 'Factions', pages: factionPages },
      { label: 'Upgrades', href: 'Upgrades', pages: [
        { label: 'Faction upgrades', href: 'FactionUpgrades' },
        { label: 'Premium upgrades', href: 'PremiumUpgrades' },
        { label: 'Sun Force', href: 'SunForce' },
      ] },
      { label: 'Trophies', href: 'TrophyPage', pages: [
        { label: 'Complete trophy list', href: 'AllTrophies' },
        { label: 'Allegiance trophies', href: 'AllegianceTrophies' },
        { label: 'Misc trophies', href: 'MiscTrophies' },
        { label: 'Magic trophies', href: 'MagicTrophies' },
        { label: 'Building trophies', href: 'BuildingTrophies' },
        { label: 'Secret trophies', href: 'SecretTrophies' },
      ] },
    ],
  },
  {
    label: 'Progression',
    items: [
      { label: 'Resets and ascensions', href: 'Reset', pages: [
        { label: 'Abdication', href: 'Abdication' },
        { label: 'Reincarnation', href: 'Reincarnation' },
        { label: 'Ascensions', href: 'Ascension' },
        { label: 'Ascension 1', href: 'Ascension1' },
        { label: 'Ascension 2', href: 'Ascension2' },
        { label: 'Ascension 3', href: 'Ascension3' },
        { label: 'Ascension 4', href: 'Ascension4' },
      ] },
      { label: 'Challenges', href: 'Challenges', pages: challengePages },
      { label: 'Faction progression', href: 'FactionProgression', pages: [
        { label: 'Bloodlines', href: 'Bloodline' },
        { label: 'Heritages', href: 'Heritages' },
        { label: 'Lineages', href: 'Lineages' },
        { label: 'Legacies', href: 'Legacies' },
      ] },
      { label: 'Mercenaries', href: 'MercenaryFaction', pages: [
        { label: 'Mercenary upgrades', href: 'MercenaryUpgrades' },
        { label: 'Mercenary challenges', href: 'Mercenary' },
      ] },
      { label: 'Excavation and artifacts', href: 'Artifacts', pages: [
        { label: 'Lore artifacts', href: 'LoreArtifacts' },
        { label: 'Quest artifacts', href: 'QuestArtifacts' },
        { label: 'Artifact sets', href: 'ArtifactSet' },
      ] },
      { label: 'Research', href: 'Research', pages: [
        { label: 'Research facilities', href: 'ResearchFacilities' },
        { label: 'Research list', href: 'ResearchList' },
        { label: 'Research tree', href: 'Researchtree' },
      ] },
    ],
  },
  { label: 'Events', items: [
    { label: 'Events', href: 'Events', pages: [
      { label: 'Event upgrades and rewards', href: 'EventUpgrades' },
      { label: 'Event archive', href: 'EventArchive' },
    ] },
  ] },
  { label: 'Game reference', items: [
    { label: 'Reference conventions', href: 'GameReference', pages: [
      { label: 'Notation', href: 'Notation' },
      { label: 'Terminology', href: 'Terminology' },
      { label: 'Random number generation', href: 'RNG' },
    ] },
  ] },
  {
    label: 'History',
    className: 'progression-group-secondary',
    items: [
      { label: 'Changelog', href: 'Changelog', pages: [
        { label: 'Version 4.3 major update', href: 'Changes' },
        { label: 'Version 4.2', href: '4.2Patch' }, { label: 'Version 4.1', href: '4.1Patch' },
        { label: 'Version 4.0', href: '4.0Patch' }, { label: 'Version 3.8', href: '3.8Patch' },
        { label: 'Version 3.7', href: '3.7Patch' }, { label: 'Version 3.6', href: '3.6Patch' },
        { label: 'Version 3.5', href: '3.5Patch' }, { label: 'Version 3.4', href: '3.4Patch' },
        { label: 'Version 3.3', href: '3.3Patch' },
      ] },
    ],
  },
];

export interface NavigationTrailItem { label: string; href?: string }

export const footerNavigation: NavigationItem[] = [
  { label: 'About', href: 'Background' },
  { label: 'Credits', href: 'Contributors' },
  { label: 'Tools', href: 'Tools' },
  { label: 'Support', href: 'Support' },
  { label: 'All pages', href: 'SiteMap' },
];

export function navigationTrail(route: string): NavigationTrailItem[] {
  for (const group of navigation) {
    for (const category of group.items) {
      if (category.href === route) return [{ label: group.label }, { label: category.label, href: category.href }];
      const page = category.pages.find((candidate) => candidate.href === route);
      if (page) return [{ label: group.label }, { label: category.label, href: category.href }, { label: page.label, href: page.href }];
    }
  }
  const footerItem = footerNavigation.find((item) => item.href === route);
  if (footerItem) return [{ label: 'Site information' }, { label: footerItem.label, href: footerItem.href }];
  return [];
}
