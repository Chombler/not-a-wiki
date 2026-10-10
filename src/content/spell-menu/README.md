# Editing the spell menus

`menu.yaml` powers only the three icon menus at the top of the Spells page:
spells, spell-trophy upgrades, and challenge rewards. It owns their order,
icons, link targets, and short hover text.

The full spell reference is authored directly in
`src/page-content/reference/Spells.html`. Edit that page when changing a full
spell explanation, tier information, related upgrade context, or special-case
notes. The menu tooltip is intentionally a shorter presentation and does not
need to duplicate the full entry.

Spell tier information uses the same native HTML structure for every spell:

```html
<details class="spell-tier-upgrades">
  <summary><strong>Spell Name Tier Upgrades</strong> availability</summary>
  <div class="spell-tier-upgrades-body">
    <!-- Effect, required Faction Coins, and tier costs -->
  </div>
</details>
```

Keep the tier effect first, followed by required Faction Coins when applicable,
then the tiers in ascending order. Native `details` supplies the collapse
behavior, keyboard controls, and accessibility state without page-specific
JavaScript.

Keep the menu inventory structured because its counts, ordering, links, and
repeated icon treatment are interface invariants. Do not move full spell prose
back into this file merely to eliminate contextual repetition.
