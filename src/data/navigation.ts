export interface NavigationItem {
  label: string;
  href: string;
}

export interface NavigationCategory {
  label: string;
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
  ['Archon', 'ArchonFaction'], ['Djinn', 'DjinnFaction'],
  ['Makers', 'MakersFaction'],
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
      { label: 'Game interface', pages: [{ label: 'Overview', href: 'GameWindow' }] },
      { label: 'Resources', pages: [{ label: 'Overview', href: 'Resources' }, { label: 'Rubies', href: 'Rubies' }] },
      { label: 'Buildings', pages: [
        { label: 'Overview', href: 'BuildingAlignments' },
        { label: 'Standard building upgrades', href: 'BuildingUpgrades' },
        { label: 'Unique buildings', href: 'UniqueBuilding' },
      ] },
      { label: 'Spells', pages: [{ label: 'Overview', href: 'Spells' }, { label: 'Spell tiers', href: 'SpellTiers' }] },
      { label: 'Factions', pages: [{ label: 'Overview', href: 'Factions' }, ...factionPages] },
      { label: 'Upgrades', pages: [
        { label: 'Overview', href: 'Upgrades' },
        { label: 'Faction upgrades', href: 'FactionUpgrades' },
        { label: 'Premium upgrades', href: 'PremiumUpgrades' },
        { label: 'Sun Force', href: 'SunForce' },
      ] },
      { label: 'Trophies', pages: [{ label: 'Overview', href: 'TrophyPage' }, { label: 'Complete trophy list', href: 'AllTrophies' }] },
    ],
  },
  {
    label: 'Progression',
    items: [
      { label: 'Resets and progression', pages: [
        { label: 'Overview', href: 'Reset' },
        { label: 'Abdication', href: 'Abdication' },
        { label: 'Reincarnation', href: 'Reincarnation' },
        { label: 'Ascensions', href: 'Ascension' },
        { label: 'Ascension 1', href: 'Ascension1' },
        { label: 'Ascension 2', href: 'Ascension2' },
        { label: 'Ascension 3', href: 'Ascension3' },
        { label: 'Ascension 4', href: 'Ascension4' },
      ] },
      { label: 'Challenges', pages: [{ label: 'Overview', href: 'Challenges' }, ...challengePages] },
      { label: 'Mercenaries', pages: [{ label: 'Overview', href: 'MercenaryFaction' }] },
      { label: 'Excavation and artifacts', pages: [
        { label: 'Overview', href: 'Artifacts' },
        { label: 'Lore artifacts', href: 'LoreArtifacts' },
        { label: 'Quest artifacts', href: 'QuestArtifacts' },
        { label: 'Artifact sets', href: 'ArtifactSet' },
      ] },
      { label: 'Bloodlines', pages: [{ label: 'Overview', href: 'Bloodline' }] },
      { label: 'Research', pages: [
        { label: 'Overview', href: 'Research' },
        { label: 'Research list', href: 'ResearchList' },
        { label: 'Research tree', href: 'Researchtree' },
        { label: 'Research facilities', href: 'ResearchFacilities' },
      ] },
      { label: 'Heritages', pages: [{ label: 'Overview', href: 'Heritages' }] },
      { label: 'Lineages', pages: [{ label: 'Overview', href: 'Lineages' }] },
      { label: 'Legacies', pages: [{ label: 'Overview', href: 'Legacies' }] },
    ],
  },
  { label: 'Events', items: [{ label: 'Events', pages: [{ label: 'Overview', href: 'Events' }] }] },
  {
    label: 'Game reference',
    items: [
      { label: 'Notation', pages: [{ label: 'Overview', href: 'Notation' }] },
      { label: 'Terminology', pages: [{ label: 'Overview', href: 'Terminology' }] },
      { label: 'Random number generation', pages: [{ label: 'Overview', href: 'RNG' }] },
    ],
  },
  {
    label: 'History',
    className: 'progression-group-secondary',
    items: [
      { label: 'Changelog', pages: [
        { label: 'Overview', href: 'Changelog' },
        { label: 'Version 4.3 major update', href: 'Changes' },
        { label: 'Version 4.2', href: '4.2Patch' }, { label: 'Version 4.1', href: '4.1Patch' },
        { label: 'Version 4.0', href: '4.0Patch' }, { label: 'Version 3.8', href: '3.8Patch' },
        { label: 'Version 3.7', href: '3.7Patch' }, { label: 'Version 3.6', href: '3.6Patch' },
        { label: 'Version 3.5', href: '3.5Patch' }, { label: 'Version 3.4', href: '3.4Patch' },
        { label: 'Version 3.3', href: '3.3Patch' },
      ] },
      { label: 'Site map', pages: [{ label: 'Overview', href: 'SiteMap' }] },
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
      const page = category.pages.find((candidate) => candidate.href === route);
      if (page) return [{ label: group.label }, { label: category.label }, { label: page.label, href: page.href }];
    }
  }
  const footerItem = footerNavigation.find((item) => item.href === route);
  if (footerItem) return [{ label: 'Site information' }, { label: footerItem.label, href: footerItem.href }];
  return [];
}
