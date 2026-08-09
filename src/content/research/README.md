# Editing research

Each YAML file in this directory is the canonical source for one research. The
Research List, Research Tree hover, and future cross-references all read these
same records. Do not copy a description into a page component.

Files are grouped by the research branch players see in game and named by the
research code. For example, Apprenticeship is:

```text
craftsmanship/C80.yaml
```

A record contains a short identity section followed by the rows shown to the
reader:

```yaml
code: C80
name: Apprenticeship
branch: craftsmanship
availableTo: All Factions
details:
  - label: Requirement
    text: 16,000 Good and Evil buildings
  - label: Effect
    text: Increase the production of all buildings based on Faction Coins found in this Era.
  - label: Formula
    text: (7 * ln(1 + x) ^ 1.4 * 1.4 ^ (12 - T))%, where x is ...
```

- Keep `code`, `name`, and `branch` aligned with the file name and directory.
- Add multiple Effect, Formula, or Note rows when the game has multiple parts.
- Keep each formula's variables, units, caps, and rounding rules in its text.
- Basic inline HTML is allowed in `text` for links or emphasis, but ordinary
  text is preferred.
- `tierTable` is optional and refers to a shared table rendered on every
  surface that needs it.

Run `npm run build` after editing. The collection schema catches invalid codes,
branches, fields, and tier-table references.
