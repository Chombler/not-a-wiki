# Contributing to Realm Grinder Reference

This is a community-maintained Realm Grinder reference. Corrections, missing
exceptions, clearer explanations, and updated game information are welcome.

## Find the page to edit

Every rendered reference page has an **Edit this page on GitHub** link near its
title. That link opens the canonical source file for the page.

The site is being migrated from PHP templates to Astro. A migrated page links
to its source under `src/`; a page not yet migrated still links to its existing
PHP source. Both are intentionally kept directly editable during the
transition.

Astro pages follow this structure:

```text
src/pages/                 Public routes and page composition
src/page-content/          Human-authored page bodies
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

The migrated homepage content is `src/page-content/home.html`. Shared Astro
navigation lives in `src/data/navigation.ts`; shared presentation remains in
`scripts/common.css` while the migration is in progress.

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
