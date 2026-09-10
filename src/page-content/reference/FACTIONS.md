# Editing faction reference pages

Faction content is authored as wiki pages rather than normalized into a faction
database. Realm Grinder presents spells, upgrades, challenges, bloodlines,
lineages, unlock quests, and affiliations together in context; the faction page
is where a reader expects those relationships to be explained.

## Editorial homes

- `Factions.html` explains the faction categories and affiliation requirements.
  Its image map is navigation only and must not contain a second copy of faction
  descriptions.
- `*Faction.html` is the complete reference home for that faction, including its
  in-game description, unlock, spell, upgrades, heritage, bloodline, lineage,
  unique building, and other faction-specific exceptions when applicable.
- `FactionUpgrades.html` is the cross-faction upgrade index. It may repeat short
  labels or effects needed for comparison, but broader explanation belongs on
  the appropriate faction page.
- `Angel.html`, `Fairy.html`, and the other faction-named pages without the
  `Faction` suffix are challenge reference pages retained for established URLs.
- `Spells.html` and `Challenges.html` may repeat the exact spell or challenge
  facts readers need in those contexts. Do not introduce a universal entity
  graph merely to eliminate that useful repetition.

When the same claim appears in multiple contexts, make one page the clear
editorial home and keep secondary wording intentionally scoped. If two copies
would need to be updated in lockstep and serve the same interface, consider a
narrow shared component; otherwise prefer readable authored HTML.
