#!/usr/bin/env python3
"""Compile the legacy PHP-template wiki into a GitHub Pages artifact."""

from __future__ import annotations

import argparse
import shutil
import subprocess
from pathlib import Path


TEXT_SUFFIXES = {".css", ".html", ".js", ".json", ".svg", ".txt", ".xml"}
IGNORED_PARTS = {".git", ".github", "__pycache__", "_site"}


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser()
    parser.add_argument("--output", type=Path, default=Path("_site"))
    parser.add_argument("--base-path", default="/not-a-wiki")
    return parser.parse_args()


def copy_static(source: Path, output: Path) -> None:
    for path in source.rglob("*"):
        relative = path.relative_to(source)
        if any(part in IGNORED_PARTS for part in relative.parts):
            continue
        if path.is_dir() or path.suffix.lower() == ".php":
            continue
        if relative == Path("SiteMap/update.html"):
            continue
        destination = output / relative
        destination.parent.mkdir(parents=True, exist_ok=True)
        shutil.copy2(path, destination)


def render_php_pages(source: Path, output: Path) -> int:
    pages = sorted(source.rglob("index.php"))
    for page in pages:
        relative = page.relative_to(source)
        result = subprocess.run(
            ["php", "index.php"],
            cwd=page.parent,
            check=True,
            capture_output=True,
        )
        if result.stderr:
            raise RuntimeError(f"PHP emitted diagnostics for {relative}:\n{result.stderr.decode()}")
        destination = output / relative.with_suffix(".html")
        destination.parent.mkdir(parents=True, exist_ok=True)
        destination.write_bytes(result.stdout)
    return len(pages)


def rewrite_base_path(output: Path, base_path: str) -> None:
    base_path = "/" + base_path.strip("/") if base_path.strip("/") else ""
    for path in output.rglob("*"):
        if not path.is_file() or path.suffix.lower() not in TEXT_SUFFIXES:
            continue
        try:
            content = path.read_text(encoding="utf-8-sig")
        except UnicodeDecodeError:
            continue
        content = content.replace("/realm/", f"{base_path}/")
        for terminator in ('"', "'", "#", "?"):
            content = content.replace(f"/realm{terminator}", f"{base_path}{terminator}")
        path.write_text(content, encoding="utf-8")


def main() -> None:
    args = parse_args()
    source = Path(__file__).resolve().parents[1]
    output = args.output.resolve()
    if output == source or source in output.parents and output.name != "_site":
        raise SystemExit("Refusing to overwrite the source tree")
    if output.exists():
        shutil.rmtree(output)
    output.mkdir(parents=True)
    copy_static(source, output)
    count = render_php_pages(source, output)
    rewrite_base_path(output, args.base_path)
    (output / ".nojekyll").touch()
    shutil.copy2(output / "index.html", output / "404.html")
    print(f"Built {count} pages in {output} for {args.base_path or '/'}")


if __name__ == "__main__":
    main()
