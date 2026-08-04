# GitHub Pages deployment

The editable wiki remains in its legacy PHP-template format. GitHub Pages cannot
execute PHP, so `scripts/build_pages.py` renders every `index.php`, copies static
assets, and rewrites the historical `/realm` URL prefix for this project site.

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
