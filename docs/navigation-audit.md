# Navigation coverage audit

Audited 2026-08-17 against the Astro route sources on
`codex/modernization-first-pass`.

## Scope and definitions

The current site has 132 routable pages:

- 1 home page (`src/page-content/home.html`)
- 104 reference pages (`src/page-content/reference/*.html`)
- 24 guide routes (`guideSequence` in `src/data/guides.ts`)
- 3 special routes: `Changelog`, `ResearchList`, and `Researchtree`

The sidebar inventory comes from every parent and child `href` in
`src/data/navigation.ts`. The landing-page inventory comes from local links in
`src/page-content/home.html`.

In this audit, a **global-navigation orphan** is a routable content page that
appears on neither the home landing page nor the sidebar. It may still have an
inbound link from another content page. A later link-graph crawl is needed to
identify pages with no inbound links anywhere.

## Coverage summary

| Navigation coverage | Pages |
| --- | ---: |
| All routable pages | 132 |
| Sidebar | 51 |
| Home landing page | 57 |
| Either global surface | 77 |
| Both surfaces | 31 |
| Home only | 26 |
| Sidebar only | 20 |
| Neither surface | 55 |

`Home` accounts for one of the 55 routes on neither surface and is normally
reachable through the site header. The remaining 54 are content pages without
a home or sidebar entry.

The existing `SiteMap` page is not a complete fallback: despite being labeled
“All Pages,” it currently contains only 21 links.

## Present on both home and sidebar

31 pages:

`A0Guide`, `A1Guide`, `A2Guide`, `A3Guide`, `A4Guide`, `ArtifactSet`,
`Artifacts`, `Ascension`, `Ascension2`, `Ascension4`, `Bloodline`,
`BuildingAlignments`, `Challenges`, `Changelog`, `Events`, `FactionUpgrades`,
`Factions`, `Heritages`, `Legacies`, `Lineages`, `Notation`, `Reincarnation`,
`Research`, `ResearchList`, `Resources`, `SiteMap`, `SpellTiers`, `Spells`,
`Terminology`, `TrophyPage`, `UniqueBuilding`.

## Home only

26 pages:

`Abdication`, `AngelFaction`, `ArchonFaction`, `BuildingUpgrades`, `Changes`,
`DemonFaction`, `DjinnFaction`, `DragonFaction`, `DrowFaction`, `DruidFaction`,
`DwarfFaction`, `ElfFaction`, `FacelessFaction`, `FairyFaction`,
`GoblinFaction`, `LoreArtifacts`, `MakersFaction`, `MercenaryFaction`,
`PremiumUpgrades`, `QuestArtifacts`, `Researchtree`, `Reset`, `Rubies`,
`SunForce`, `TitanFaction`, `UndeadFaction`.

These pages become difficult to recover once a reader leaves them because the
sidebar offers no route back to the same subject.

## Sidebar only

20 pages:

`A0R0-R15`, `A0R16-R29`, `A0R30-R39`, `A1R40-R59`, `A1R60-R74`,
`A1R75-R99`, `A2R100-R115`, `A2R116-R124`, `A2R125-R138`, `A2R139-R159`,
`A3R160-R180`, `A3R181-R189`, `A3R190-R205`, `A3R206-R219`,
`A3SpecialBuilds`, `A4PostA4`, `A4R220-R229`, `A4R230-R254`, `A4R255-R279`,
`Upgrades`.

All but `Upgrades` are guide subroutes.

## On neither global navigation surface

55 routes:

### Historical patch pages

`3.3Patch`, `3.4Patch`, `3.5Patch`, `3.6Patch`, `3.7Patch`, `3.8Patch`,
`4.0Patch`, `4.1Patch`, `4.2Patch`.

### Faction mechanic pages

`Angel`, `Archon`, `Demon`, `Djinn`, `Dragons`, `Drow`, `Druid`, `Dwarf`,
`Elf`, `Faceless`, `Fairy`, `Goblin`, `Makers`, `Mercenary`, `Titan`, `Undead`.

These are distinct from the `*Faction` overview pages linked from Home.

### Legacy progression and build pages

`MercBuilds`, `MercResearch`, `PBuilds`, `R16Guide`, `R40-R46`, `R47-R60`,
`R60-R75`, `R75Plus`, `R100Plus`, `R116Plus`, `R125Plus`, `R135Plus`,
`R160Plus`, `R190Plus`, `R220Plus`, `ResearchBuilds`.

### Other reference and site pages

`AllTrophies`, `Background`, `Contributors`, `GameWindow`, `Home`, `Kong`,
`RNG`, `ResearchFacilities`, `SpeedRun`, `Support`, `Tools`, `TrophyGuide`,
`UsefulTables`, `WallofShame`.

## Sidebar inventory by section

### Early game reference

`BuildingAlignments`, `Factions`, `FactionUpgrades`, `Spells`, `Resources`,
`TrophyPage`, `Artifacts`.

### Unlockable systems

`Challenges`, `Bloodline`, `Heritages`, `Reincarnation`.

### Reincarnation and research

`Research`, `ResearchList`, `UniqueBuilding`, `SpellTiers`, `Lineages`.

### Ascensions

`Ascension`, `Ascension2`, `Legacies`, `Ascension4`, `ArtifactSet`, `Upgrades`.

### Guides and builds

`A0Guide`, `A0R0-R15`, `A0R16-R29`, `A0R30-R39`, `A1Guide`, `A1R40-R59`,
`A1R60-R74`, `A1R75-R99`, `A2Guide`, `A2R100-R115`, `A2R116-R124`,
`A2R125-R138`, `A2R139-R159`, `A3Guide`, `A3R160-R180`, `A3R181-R189`,
`A3R190-R205`, `A3R206-R219`, `A3SpecialBuilds`, `A4Guide`, `A4R220-R229`,
`A4R230-R254`, `A4R255-R279`, `A4PostA4`.

### Reference and history

`Events`, `Notation`, `Terminology`, `Changelog`, `SiteMap`.

## Home landing-page inventory by section

The home page links 57 unique routes. Some appear in more than one visual panel,
but are counted once here.

### Status and start-here links

`Changes`, `Changelog`, `BuildingAlignments`, `Factions`, `Reincarnation`,
`SiteMap`.

### Core reference

`BuildingAlignments`, `BuildingUpgrades`, `Factions`, `FactionUpgrades`,
`Spells`, `Resources`, `TrophyPage`, `Rubies`, `Notation`.

### Unlockable systems

`Artifacts`, `QuestArtifacts`, `LoreArtifacts`, `Challenges`, `Bloodline`,
`Heritages`, `SunForce`, `PremiumUpgrades`.

### Research and later systems

`Research`, `ResearchList`, `Researchtree`, `UniqueBuilding`, `SpellTiers`,
`Lineages`, `ArtifactSet`, `Legacies`.

### Progression

`Abdication`, `Reincarnation`, `Ascension`, `Ascension2`, `Ascension4`,
`Reset`, `Events`, `Terminology`.

### Factions

`FairyFaction`, `ElfFaction`, `AngelFaction`, `GoblinFaction`,
`UndeadFaction`, `DemonFaction`, `TitanFaction`, `DruidFaction`,
`FacelessFaction`, `DwarfFaction`, `DrowFaction`, `DragonFaction`,
`MercenaryFaction`, `ArchonFaction`, `DjinnFaction`, `MakersFaction`.

### Guides and builds

`A0Guide`, `A1Guide`, `A2Guide`, `A3Guide`, `A4Guide`.

## Immediate implications

1. The sidebar is not currently a persistent representation of the site's
   information architecture; it exposes fewer than 40% of routes.
2. Home-only pages are discoverable initially but provide poor wayfinding after
   the reader follows contextual links.
3. The faction split is especially disorienting: overview pages use
   `*Faction` routes while separate mechanic pages use bare faction names, and
   the latter group is absent from both global surfaces.
4. The old progression/build pages and their replacement guide routes coexist
   without visible status or relationships.
5. A complete page registry should become the source for the sidebar, home
   directory, all-pages index, breadcrumbs, and related-page navigation so the
   lists cannot silently diverge again.
