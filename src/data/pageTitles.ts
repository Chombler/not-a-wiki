const pageTitles: Record<string, string> = {
  A0Guide: 'Ascension 0 Guide',
  A1Guide: 'Ascension 1 Guide',
  A2Guide: 'Ascension 2 Guide',
  A3Guide: 'Ascension 3 Guide',
  A4Guide: 'Ascension 4 Guide',
  A3SpecialBuilds: 'A3 Special-purpose Builds',
  A4PostA4: 'Post-A4 Builds',
  BuildingAlignments: 'Buildings',
  BuildingUpgrades: 'Building Upgrades',
  FactionUpgrades: 'Faction Upgrades',
  TrophyPage: 'Trophies',
  QuestArtifacts: 'Quest Artifacts',
  LoreArtifacts: 'Lore Artifacts',
  ArtifactSet: 'Artifact Sets',
  SpellTiers: 'Spell Tiers',
  PremiumUpgrades: 'Premium Upgrades',
  GameWindow: 'Game Window',
  SiteMap: 'All Pages',
  Changes: 'Latest Major Patch',
  UniqueBuilding: 'Unique Buildings',
  ResearchBuilds: 'Research Builds',
  ResearchFacilities: 'Research Facilities',
  MercBuilds: 'Mercenary Builds',
  PBuilds: 'Production Builds',
  R16Guide: 'R16 Guide',
  RNG: 'Random Number Generation',
};

export function getPageTitle(route: string) {
  return pageTitles[route] ?? route
    .replace(/([a-z0-9])([A-Z])/g, '$1 $2')
    .replace(/([A-Za-z])(\d)/g, '$1 $2')
    .replace(/(\d)([A-Za-z])/g, '$1 $2');
}
