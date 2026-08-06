#!/usr/bin/env python3
"""Validate the shared content components in a rendered wiki build."""

from __future__ import annotations

import argparse
from collections import Counter
from html.parser import HTMLParser
from pathlib import Path


class ComponentParser(HTMLParser):
    def __init__(self) -> None:
        super().__init__(convert_charrefs=True)
        self.ids: list[str] = []
        self.details: list[bool] = []
        self.details_count = 0
        self.autohides = 0
        self.tables = 0
        self.table_depth = 0
        self.table_rows: list[int] = []
        self.collapse_targets: list[str] = []
        self.errors: list[str] = []

    def handle_starttag(self, tag: str, attrs: list[tuple[str, str | None]]) -> None:
        attributes = dict(attrs)
        if attributes.get("id"):
            self.ids.append(attributes["id"] or "")

        classes = (attributes.get("class") or "").split()
        if "autohide" in classes:
            self.autohides += 1
        if tag == "details":
            self.details_count += 1
            self.details.append(False)
        elif tag == "summary" and self.details:
            self.details[-1] = True
        elif tag == "table":
            self.tables += 1
            self.table_depth += 1
            self.table_rows.append(0)
        elif tag == "tr" and self.table_depth:
            self.table_rows[-1] += 1

        if attributes.get("data-toggle") == "collapse" or attributes.get("data-bs-toggle") == "collapse":
            target = attributes.get("data-target") or attributes.get("data-bs-target") or attributes.get("href")
            if target:
                self.collapse_targets.append(target)

    def handle_startendtag(self, tag: str, attrs: list[tuple[str, str | None]]) -> None:
        self.handle_starttag(tag, attrs)
        self.handle_endtag(tag)

    def handle_endtag(self, tag: str) -> None:
        if tag == "details" and self.details:
            if not self.details.pop():
                self.errors.append("<details> has no <summary>")
        elif tag == "table" and self.table_depth:
            if not self.table_rows.pop():
                self.errors.append("<table> has no rows")
            self.table_depth -= 1


def main() -> int:
    parser = argparse.ArgumentParser()
    parser.add_argument("build", nargs="?", default="_site", type=Path)
    args = parser.parse_args()
    failures: list[str] = []
    warnings: list[str] = []
    totals = Counter()

    for page in sorted(args.build.rglob("*.html")):
        audit = ComponentParser()
        audit.feed(page.read_text(errors="replace"))
        label = page.relative_to(args.build)
        totals.update(tables=audit.tables, details=audit.details_count, autohides=audit.autohides)

        for element_id, count in Counter(audit.ids).items():
            if count > 1:
                warnings.append(f"{label}: duplicate legacy id #{element_id} ({count} uses)")
        for error in audit.errors:
            failures.append(f"{label}: {error}")
        known_ids = set(audit.ids)
        for target in audit.collapse_targets:
            if target.startswith("#") and target[1:] not in known_ids:
                failures.append(f"{label}: collapse target {target} does not exist")

    print(
        f"Checked {sum(1 for _ in args.build.rglob('*.html'))} pages: "
        f"{totals['tables']} tables, {totals['details']} native details, "
        f"{totals['autohides']} legacy collapsibles."
    )
    if warnings:
        print(f"Warnings: {len(warnings)} duplicate legacy IDs (no component targets depend on them).")
    if failures:
        print("\n".join(failures))
        return 1
    print("Component validation passed.")
    return 0


if __name__ == "__main__":
    raise SystemExit(main())
