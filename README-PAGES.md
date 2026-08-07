# GitHub Pages deployment

The editable wiki remains in its legacy PHP-template format. GitHub Pages cannot
execute PHP, so `scripts/build_pages.py` renders every `index.php`, copies static
assets, and rewrites the historical `/realm` URL prefix for this project site.

## Current-game sprites

Current Realm Grinder artwork is stored once per atlas sprite in
`assets/game/sprites/`. Exact atlas names and crop/frame metadata live in the
generated `manifest.json`; semantic selection metadata lives in
`assets/game/sprite-selection.json`. Wiki-authored images belong under
`assets/wiki/`, not in the generated sprite directory.

To regenerate the selected sprites from a locally installed v4.3.15 client:

```sh
python3 -m pip install -r scripts/requirements-assets.txt
python3 scripts/extract_game_sprites.py \
  --game-assets "/path/to/RealmGrinderDesktop.app/Contents/Resources/images"
```

The extractor reconstructs trimmed TexturePacker frames and fails on missing
sprites, ambiguous selected atlas names, or normalized filename collisions.
When the game repeats an exact sprite name across atlases, add `atlas_xml` to
that sprite's selection entry to disambiguate it.

Build and validate locally:

```sh
python3 scripts/build_pages.py --base-path /not-a-wiki
python3 scripts/validate_pages.py --base-path /not-a-wiki
python3 -m http.server 8000 --directory _site
```

Because the generated links contain the project base path, test the production
layout by making `_site` available at `/not-a-wiki`, or use `--base-path ''` for
a root-hosted local preview.

The `Deploy GitHub Pages` workflow publishes pushes to `local-4.3.15`. In the
fork's **Settings → Pages**, set the source to **GitHub Actions**. The resulting
project site is `https://chombler.github.io/not-a-wiki/`.
