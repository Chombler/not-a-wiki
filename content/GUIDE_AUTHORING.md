# Guide and build authoring format

Guide content stays in plain Markdown or text so community contributors can find and update it without editing the site renderer.

Use this field order for each build. Omit fields that do not apply; do not leave empty fields.

```markdown
### Build name

TYPE: Production
RANGE: R172-R180, e50+ gems
FACTION: Evil/Order Mercenary
BLOODLINE: Archon
LINEAGE: Archon
SET: Dwarf
STONEHEART: Angel
REQUIREMENTS: Mercenary Duel completed
AUTHOR: Original creator
UPDATED BY: Later contributor

TEMPLATE:
FR10,EL12,...

RESEARCHES:
S1275,C1325,...

GAMEPLAY NOTES:

- Only the instructions needed to run the build.

NOTABLE BUFFS:

- Stat or earlier build that materially affects this build.
```

## Credit rules

- `AUTHOR` means the original build creator.
- `UPDATED BY` records later balance, version, or routing changes.
- Do not credit a transcriber, document owner, or AI as the original author.
- If the original author is genuinely unknown, use `Uncredited community source`.
- Keep the game version and source date accurate at the page level.

## Writing rules

- Keep setup instructions in gameplay order.
- Use one canonical, single-line import string. Let the site wrap it visually instead of adding a duplicate mobile template.
- Configuration-only builds may omit `TEMPLATE` and `RESEARCHES`; explain the required faction, bloodline, set, and execution instead. Do not use a dummy import such as `S1`.
- Milestones, reminders, and routing advice belong in progression notes, not in the searchable build index.
- Put background mechanics in the relevant reference section rather than repeating them on every build.
- Keep archival builds in the source history or an explicitly labeled archive, not in the current build index.
