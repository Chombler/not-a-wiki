# Editing trophies

The five YAML files in this directory are the editorial home for trophy facts.
They remain structured because the same 903 trophies, in the same game-defined
order, power two genuinely identical interfaces:

- `TrophyPage`: the game-like desktop icon drawer and its hover text;
- `AllTrophies`: the searchable, mobile-friendly text list.

Edit a trophy in its category file. Each record deliberately keeps its complete
human-authored explanation in `body`; do not split requirements, effects,
formulas, notes, or tips into a universal game-object database. HTML paragraphs
are allowed so an editor can present each trophy according to what readers need.

The small structured fields exist only for shared interface invariants:

- `id`: stable section anchor;
- `name`: displayed game name;
- `icon`: current-game sprite filename;
- `body`: the authored reference entry;
- `guide`: optional destination opened when the desktop icon is clicked.

Category order and trophy order must match the game. Total counts are validated
during `npm test`: 60 Secret, 45 Allegiance, 170 Misc, 62 Magic, and 566 Building.

