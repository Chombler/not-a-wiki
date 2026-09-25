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
      { label: 'Game interface', href: 'GameWindow' },
      { label: 'Resources', href: 'Resources', children: [
        { label: 'Mana', href: 'Mana' },
        { label: 'Coins and Gems', href: 'CoinsAndGems' },
        { label: 'Faction Coins', href: 'FactionCoins' },
        { label: 'Rubies', href: 'Rubies' },
      ] },
      { label: 'Buildings', href: 'BuildingAlignments', children: [
        { label: 'Standard building upgrades', href: 'BuildingUpgrades' },
        { label: 'Unique buildings', href: 'UniqueBuilding' },
      ] },
      { label: 'Spells', href: 'Spells', children: [{ label: 'Spell tiers', href: 'SpellTiers' }] },
      { label: 'Factions', href: 'Factions', children: factionPages },
      { label: 'Upgrades', href: 'Upgrades', children: [
        { label: 'Faction upgrades', href: 'FactionUpgrades' },
        { label: 'Premium upgrades', href: 'PremiumUpgrades' },
        { label: 'Sun Force', href: 'SunForce' },
      ] },
      { label: 'Trophies', href: 'TrophyPage', children: [{ label: 'Complete trophy list', href: 'AllTrophies' }] },
    ],
  },
  {
    label: 'Progression',
    items: [
      { label: 'Resets and progression', href: 'Reset', children: [
        { label: 'Abdication', href: 'Abdication' },
        { label: 'Reincarnation', href: 'Reincarnation' },
        { label: 'Ascensions', href: 'Ascension' },
        { label: 'Ascension 1', href: 'Ascension1' },
        { label: 'Ascension 2', href: 'Ascension2' },
        { label: 'Ascension 3', href: 'Ascension3' },
        { label: 'Ascension 4', href: 'Ascension4' },
      ] },
      { label: 'Challenges', href: 'Challenges', children: challengePages },
      { label: 'Mercenaries', href: 'MercenaryFaction' },
      { label: 'Excavation and artifacts', href: 'Artifacts', children: [
        { label: 'Lore artifacts', href: 'LoreArtifacts' },
        { label: 'Quest artifacts', href: 'QuestArtifacts' },
        { label: 'Artifact sets', href: 'ArtifactSet' },
      ] },
      { label: 'Bloodlines', href: 'Bloodline' },
      { label: 'Research', href: 'Research', children: [
        { label: 'Research list', href: 'ResearchList' },
        { label: 'Research tree', href: 'Researchtree' },
        { label: 'Research facilities', href: 'ResearchFacilities' },
        { label: 'Unique buildings', href: 'UniqueBuilding' },
      ] },
      { label: 'Heritages', href: 'Heritages' },
      { label: 'Lineages', href: 'Lineages' },
      { label: 'Legacies', href: 'Legacies' },
    ],
  },
  { label: 'Events', items: [{ label: 'Events', href: 'Events' }] },
  {
    label: 'Game reference',
    items: [
      { label: 'Notation', href: 'Notation' },
      { label: 'Terminology', href: 'Terminology' },
      { label: 'Random number generation', href: 'RNG' },
    ],
  },
  {
    label: 'History',
    className: 'progression-group-secondary',
    items: [
      { label: 'Changelog', href: 'Changelog', children: [
        { label: 'Version 4.3 major update', href: 'Changes' },
        { label: 'Version 4.2', href: '4.2Patch' }, { label: 'Version 4.1', href: '4.1Patch' },
        { label: 'Version 4.0', href: '4.0Patch' }, { label: 'Version 3.8', href: '3.8Patch' },
        { label: 'Version 3.7', href: '3.7Patch' }, { label: 'Version 3.6', href: '3.6Patch' },
        { label: 'Version 3.5', href: '3.5Patch' }, { label: 'Version 3.4', href: '3.4Patch' },
        { label: 'Version 3.3', href: '3.3Patch' },
      ] },
      { label: 'All pages', href: 'SiteMap' },
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
    for (const item of group.items) {
      if (item.href === route) return [{ label: group.label }, { label: item.label, href: item.href }];
      const child = item.children?.find((candidate) => candidate.href === route);
      if (child) return [{ label: group.label }, { label: item.label, href: item.href }, { label: child.label, href: child.href }];
    }
  }
  const footerItem = footerNavigation.find((item) => item.href === route);
  if (footerItem) return [{ label: 'Site information' }, { label: footerItem.label, href: footerItem.href }];
  return [];
}
