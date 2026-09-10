# Editing the spell menus

`menu.yaml` powers only the three icon menus at the top of the Spells page:
spells, spell-trophy upgrades, and challenge rewards. It owns their order,
icons, link targets, and short hover text.

The full spell reference is authored directly in
`src/page-content/reference/Spells.html`. Edit that page when changing a full
spell explanation, tier information, related upgrade context, or special-case
notes. The menu tooltip is intentionally a shorter presentation and does not
need to duplicate the full entry.

Keep the menu inventory structured because its counts, ordering, links, and
repeated icon treatment are interface invariants. Do not move full spell prose
back into this file merely to eliminate contextual repetition.
