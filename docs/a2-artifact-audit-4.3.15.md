# A2 faction artifact audit — Realm Grinder 4.3.15

Verified against `game-reference/decompiled-4.3.15-deobfuscated/scripts/` in
the parent Realm workspace. Paths and line numbers below refer to that export.
The current editorial pages are `src/page-content/reference/LoreArtifacts.html`
and `Artifacts.html`; their legacy PHP counterparts carry the same corrections.
Historical patch pages retain their historical formulas.

## Discovery formulas

All results below are percentages per eligible excavation, not probabilities
between zero and one. `package_19/class_74.as:57` compares `method_226` with
a random number from 0 to 100, with results of at least 100 guaranteed.
Each artifact checks Ascension >= 2, its faction, the two predecessor artifacts,
and excavation depth >= 2,000 in `method_475`. Survey Equipment is the shared
requirement in `class_74.as:28` (`package_22/class_992.as`).

| Artifact | Source in `package_19/` | Verified chance (%) and input |
| --- | --- | --- |
| Silk Cloth | `class_950.as:24` | `x / 400000`; actual Wizard Towers owned |
| Raw Emerald | `class_689.as:23` | `(3 * x)^4.5 / 10000`; free + ruby excavation resets this Era |
| Fossilized Wing | `class_1757.as:23` | `x / 2592000`; all-time Angel seconds |
| Spiked Whip | `class_579.as:24` | `x / 500000`; actual Slave Pens owned |
| Dusty Coffin | `class_1119.as:23` | `x / 2592000`; all-time Undead seconds |
| Crystallized Lava | `class_1375.as:24` | `x / 200000`; actual Halls of Legends owned |
| Titan Helmet | `class_349.as:23` | `x^2 / 500000000`; raw Royal Exchange count this Era (stat 24) |
| Branch of the Life Tree | `class_1112.as:23` | `x^3 / 1000000`; stored Druid Lineage level (`var_1122[7]`) |
| Nightmare Figment | `class_572.as:24` | `x^1.5 / 1000000`; Brainwave headstart in seconds |
| Beard Hair | `class_253.as:23` | `x / 10000000000000`; current assistants, including temporary assistants |
| Poison Vial | `class_1335.as:24` | `(100 + y) * x^0.9 / 10000000`; Combo Strike counter x, Drow Perk 4 combo bonus y |
| Dragon Scale | `class_194.as:23` | `x / 2000`; active spell count including tiers, excluding count multipliers |

## Corrections and supporting getters

- **Dusty Coffin:** the old entry incorrectly limited the time input to a single
  run. `class_23.as:1929` (`method_1`) sums the Era, Reincarnation, and prior
  all-time stat arrays. `class_23.as:1526` maps Angel to stat 52 and Undead to
  stat 54. Fossilized Wing and Dusty Coffin use this same all-time getter.
- **Poison Vial:** the old `40 * counter^0.9` numerator is obsolete.
  `package_21/class_1395.as:33` returns `(100 + perk bonus) * counter^0.9`.
  `package_9/class_40.as:23` gives the perk bonus as
  `0.5 * floor(effective Era seconds)` when Drow Perk 4 is purchased; otherwise
  it is zero. `class_23.as:1357` (`method_627(1, false, true)`) includes
  applicable time-count bonuses via `method_661`.
  The artifact calls this base method directly, before spell-tier scaling or
  the production engine's Ascension adjustment. The counter comes from
  `class_23.as:1901`, including its applicable counter-modifying effects.
- **Units:** explicitly label Angel playtime and Brainwave headstart as seconds.
  `package_21/class_782.as:100` computes the headstart; its consumer at line 93
  adds it to elapsed frames divided by 30.
- **Dragon Scale:** `class_23.as:2782` receives `true`, skipping the optional
  active-spell count multiplier while still counting tiers.
- **Building counts:** `class_16.as:459` receives `true`, returning raw buildings
  rather than applying building-count multipliers. Existing entries were correct.
- **Beard Hair:** `class_697.as:3718` uses the current assistant calculation
  `method_87()` rather than the variant that excludes temporary effects.
- Corrected the misspelling of the Faceless prerequisite, Octopus-shaped Helmet.

The remaining discovery formulas already matched this export. This audit covers
artifact discovery entries, not the separate Artifact Set upgrade effects.
