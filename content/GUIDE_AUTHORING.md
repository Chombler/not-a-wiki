# Guide and build authoring format

Guide content stays in plain Markdown or text so community contributors can find and update it without editing the site renderer.

Ascension guides are build-centered references. Organize ordinary production builds under their Reincarnation range. Put task builds under a plainly named purpose section such as `Unlock builds`, `Max buildings`, or `Challenges`.

Each Ascension landing page is a short route index: plot or orientation, major milestones, and chronological links to its Reincarnation-range pages. Do not place the full Ascension build collection on the landing page.

Each range page is one linear reference document. Put range goals first, followed by its searchable build list. The shared renderer selects entries from the canonical Ascension source, so contributors update the existing JSON or Markdown rather than copying a build into a second file.

Build summaries identify the build and its purpose. Opening one reveals metadata, configuration, notes, credit, and copy controls. Put range-wide advice before the affected build group and build-specific instructions inside the build entry; do not duplicate the same prose elsewhere on the page.

Start a new range page when available systems, immediate goals, or the recommended production route changes materially. Do not split at an arbitrary round number merely to make ranges equal in size. Builds that remain useful across several ranges belong on the Ascension's special-purpose page.

Each `##` or `###` build heading becomes one compact expandable entry. Everything between that heading and the next heading stays with the build, so requirements, variants, and execution notes remain together.

Use this field order for each build. Field names are case-insensitive. Omit fields that do not apply; do not leave empty fields.

```markdown
### Build name

Purpose: Production
Range: R172-R180, e50+ gems
Faction: Evil/Order Mercenary
Bloodline: Archon
Lineage: Archon
Set: Dwarf
Stoneheart: Angel
Duration: 5-20 minutes
Requirements: Mercenary Duel completed
Use when: The starter build reaches e50 gems
Replace when: The R181 production route becomes available
Author: Original creator
Updated by: Later contributor

Variant: Normal configuration

Condition: Use when all listed upgrades are available.

Template:
FR10,EL12,...

Researches:
S1275,C1325,...

Variant: Without A2950

Condition: Use this variant before A2950 is unlocked.

Researches:
S1275,C1325,...

Gameplay Notes:

- Only the instructions needed to run the build.

Notable Buffs:

- Stat or earlier build that materially affects this build.
```

## Progression-range notes

Put information that applies to every build in a range immediately after the range heading and before its first build:

```markdown
# R172-R180

At R172, reach e50 gems before beginning the Mercenary Duel.
Obtain Obsidian Crown and Mercenary Insignia during this range.

## Druidline Goblin
...
```

Do not create an apparent build entry for general advice. Keep reminders, milestone checklists, and routing advice in the range introduction.

## Credit rules

- `AUTHOR` means the original build creator.
- `UPDATED BY` records later balance, version, or routing changes.
- Do not credit a transcriber, document owner, or AI as the original author.
- If the original author is genuinely unknown, use `Uncredited community source`.
- Keep the game version and source date accurate at the page level.

## Writing rules

- Keep setup instructions in gameplay order and immediately beside the build they operate.
- Use one canonical, single-line import string. Let the site wrap it visually instead of adding a duplicate mobile template.
- Keep alternate configurations under the same build. Give every variant a short heading and an explicit `Condition`.
- Configuration-only builds may omit `TEMPLATE` and `RESEARCHES`; explain the required faction, bloodline, set, and execution instead. Do not use a dummy import such as `S1`.
- Milestones, reminders, and routing advice belong in progression notes, not in the searchable build index.
- Put background mechanics in the relevant reference section rather than repeating them on every build.
- Keep archival builds in the source history or an explicitly labeled archive, not in the current build index.
