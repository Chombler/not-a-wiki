# Contributing to Realm Grinder Reference

This is a community-maintained Realm Grinder reference. Corrections, missing
exceptions, clearer explanations, and updated game information are welcome.

## Find the page to edit

Every rendered reference page has an **Edit this page on GitHub** link near its
title. That link opens the canonical source file for the page.

The site is being migrated from PHP templates to Astro. Every Astro page links
to its canonical source under `src/`; the legacy PHP tree remains temporarily
for comparison while the migration is validated.

Astro pages follow this structure:

```text
src/pages/                 Public routes and page composition
src/page-content/          Human-authored page bodies
src/data/guides/           Human-editable A0–A4 build records and range data
src/data/                  Navigation and other shared site data
src/components/            Reusable presentation components
src/layouts/               Shared page shells
```

Legacy pages follow this deliberately simple pattern:

```text
Artifacts/index.php
Bloodline/index.php
FairyFaction/index.php
ResearchList/index.php
```

The homepage content is `src/page-content/home.html`. Ordinary reference-page
bodies are in `src/page-content/reference/`. Guide builds are split into one
JSON file per Ascension under `src/data/guides/`, so a contributor does not
need to work through a generated template or a single monolithic database.
Shared Astro navigation lives in `src/data/navigation.ts`; shared presentation
remains in `scripts/common.css` while the migration is in progress.

### Edit trophy information

Trophies have one canonical source under `src/content/trophies/`, split into
five readable YAML files by in-game category. Both the icon drawer and the
full text page are generated from these same records. Edit only the matching
YAML record; do not copy the correction into either page wrapper.

Each trophy has four straightforward fields:

```yaml
- id: "harlequin-trophy"
  name: "Harlequin"
  icon: "harlequin-trophy.png"
  guide:
    href: "/realm/MercBuilds/#TrophyBuilds"
    label: "Mercenary trophy builds"
  body: |-
    <p><b>Requirement</b>: As a Mercenary, purchase one upgrade from 11 different factions.</p>
```

`id` is the text-page anchor, `icon` is the filename in
`public/assets/game/sprites/`, and `body` is ordinary editable HTML. To link a
trophy icon to a guide or a specific section, add the optional `guide` block.
Use a site path plus `#section-id` for a particular heading. The linked icon is
clickable on the desktop trophy page, and the guide also appears in its tooltip
and text entry. Do not put guide links directly in `body`; validation requires
them to use the structured `guide` field so the icon is always clickable.
Keep IDs unique and do not manually edit
the category totals—the build verifies all 903 records and derives totals from
the files.

Edit the source files directly. Do not edit `_site/`; it is generated for
GitHub Pages and is replaced by every build.

## Make a focused change

- Keep factual changes separate from unrelated formatting changes.
- Include the exact game version you checked in the pull request.
- Link or describe the source used to verify a formula or game behavior.
- Define every formula variable and include its displayed unit.
- Call out caps, rounding, exclusions, and Ascension-specific behavior.
- Preserve useful player-written explanation; the wiki is not intended to be
  machine- or AI-authored.

## Preview and validate locally

For migrated Astro pages, install Node.js and run:

```sh
npm install
npm run dev
```

The local site is available under `http://localhost:4321/realm/`. Before
opening a pull request, also run:

```sh
npm run build
BASE_PATH=/not-a-wiki npm run build
```

For a legacy PHP page, you also need PHP and Python 3. Run:

```sh
python3 scripts/build_pages.py --base-path ''
python3 scripts/validate_pages.py --base-path ''
python3 -m http.server 8000 --directory _site
```

Then open `http://localhost:8000/`.

The build must complete without PHP errors, and validation must report no
missing local navigation links. The validator may also report known legacy
image references; avoid adding new missing assets.

## Open a pull request

Describe what was wrong, what you changed, the game version you checked, and
how you verified it. Small pull requests that correct one mechanic or one page
are easier to review and merge.
