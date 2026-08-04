#!/usr/bin/env python3
"""Validate the generated GitHub Pages artifact without external packages."""

from __future__ import annotations

import argparse
import re
from pathlib import Path
from urllib.parse import unquote, urlsplit


ATTR_RE = re.compile(r'''(href|src)\s*=\s*["']([^"']+)["']''', re.IGNORECASE)
COMMENT_RE = re.compile(r"<!--.*?-->", re.DOTALL)
LEGACY_PATH_RE = re.compile(r'''/realm(?=[/\#?"'])''')


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser()
    parser.add_argument("--site", type=Path, default=Path("_site"))
    parser.add_argument("--base-path", default="/not-a-wiki")
    parser.add_argument("--expected-pages", type=int, default=107)
    return parser.parse_args()


def resolve_target(site: Path, page: Path, value: str, base_path: str) -> Path | None:
    parsed = urlsplit(value)
    if parsed.scheme or parsed.netloc or value.startswith(("mailto:", "javascript:", "data:", "#")):
        return None
    path = unquote(parsed.path)
    if not path:
        return None
    if path.startswith("/"):
        if base_path and path != base_path and not path.startswith(base_path + "/"):
            raise ValueError(f"root-relative URL escapes Pages base path: {value}")
        path = path[len(base_path):].lstrip("/") if base_path else path.lstrip("/")
        target = site / path
    else:
        target = page.parent / path
    if target.is_dir():
        target /= "index.html"
    elif not target.suffix:
        target /= "index.html"
    return target


def main() -> None:
    args = parse_args()
    site = args.site.resolve()
    base_path = "/" + args.base_path.strip("/") if args.base_path.strip("/") else ""
    pages = sorted(site.rglob("index.html"))
    errors: list[str] = []
    missing_assets: set[str] = set()
    if len(pages) != args.expected_pages:
        errors.append(f"expected {args.expected_pages} pages, found {len(pages)}")
    for page in pages:
        content = page.read_text(encoding="utf-8")
        if "<?php" in content:
            errors.append(f"unrendered PHP in {page.relative_to(site)}")
        if LEGACY_PATH_RE.search(content):
            errors.append(f"legacy /realm URL in {page.relative_to(site)}")
        content_without_comments = COMMENT_RE.sub("", content)
        for attribute, value in ATTR_RE.findall(content_without_comments):
            try:
                target = resolve_target(site, page, value, base_path)
            except ValueError as exc:
                errors.append(f"{page.relative_to(site)}: {exc}")
                continue
            if target is not None and not target.exists() and attribute.lower() == "href":
                errors.append(f"{page.relative_to(site)}: missing {value}")
            elif target is not None and not target.exists():
                missing_assets.add(value)
    if errors:
        print("\n".join(errors[:100]))
        raise SystemExit(f"Validation failed with {len(errors)} error(s)")
    print(f"Validated {len(pages)} pages with no missing local navigation links")
    if missing_assets:
        print(f"Warning: {len(missing_assets)} legacy image/media references have no matching repository asset")


if __name__ == "__main__":
    main()
