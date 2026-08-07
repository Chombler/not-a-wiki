#!/usr/bin/env python3
"""Extract selected Realm Grinder sprites into the wiki's canonical namespace."""

from __future__ import annotations

import argparse
import json
import re
import unicodedata
import xml.etree.ElementTree as ET
from pathlib import Path

from PIL import Image


def parse_args() -> argparse.Namespace:
    parser = argparse.ArgumentParser()
    parser.add_argument(
        "--game-assets",
        type=Path,
        required=True,
        help="Directory containing the game's TexturePacker XML and PNG atlases",
    )
    parser.add_argument(
        "--selection",
        type=Path,
        default=Path("assets/game/sprite-selection.json"),
        help="JSON file describing the sprites to export",
    )
    parser.add_argument(
        "--output",
        type=Path,
        default=Path("assets/game/sprites"),
        help="Canonical sprite output directory",
    )
    return parser.parse_args()


def normalized_key(name: str) -> str:
    ascii_name = unicodedata.normalize("NFKD", name).encode("ascii", "ignore").decode()
    return re.sub(r"[^a-z0-9]+", "-", ascii_name.lower()).strip("-")


def load_atlas_entries(game_assets: Path) -> dict[str, list[tuple[Path, dict[str, str]]]]:
    entries: dict[str, list[tuple[Path, dict[str, str]]]] = {}
    for xml_path in sorted(game_assets.glob("*.xml")):
        root = ET.parse(xml_path).getroot()
        image_path = game_assets / root.attrib["imagePath"]
        if not image_path.is_file():
            raise SystemExit(f"Missing atlas image for {xml_path.name}: {image_path}")
        for element in root:
            name = element.attrib.get("name")
            if not name:
                continue
            metadata = dict(element.attrib)
            metadata["atlas_xml"] = xml_path.name
            metadata["atlas_image"] = image_path.name
            entries.setdefault(name, []).append((image_path, metadata))
    return entries


def extract_sprite(atlas: Image.Image, metadata: dict[str, str]) -> Image.Image:
    x = int(metadata["x"])
    y = int(metadata["y"])
    width = int(metadata["width"])
    height = int(metadata["height"])
    region = atlas.crop((x, y, x + width, y + height)).convert("RGBA")

    frame_width = int(metadata.get("frameWidth", width))
    frame_height = int(metadata.get("frameHeight", height))
    frame_x = int(metadata.get("frameX", 0))
    frame_y = int(metadata.get("frameY", 0))
    framed = Image.new("RGBA", (frame_width, frame_height), (0, 0, 0, 0))
    framed.alpha_composite(region, (-frame_x, -frame_y))
    return framed


def main() -> None:
    args = parse_args()
    selection_path = args.selection.resolve()
    output = args.output.resolve()
    selections = json.loads(selection_path.read_text(encoding="utf-8"))["sprites"]
    atlas_entries = load_atlas_entries(args.game_assets.resolve())

    seen_keys: dict[str, str] = {}
    manifest_entries = []
    atlas_cache: dict[Path, Image.Image] = {}
    output.mkdir(parents=True, exist_ok=True)

    for selection in selections:
        sprite_name = selection["sprite_name"]
        key = normalized_key(sprite_name)
        if key in seen_keys:
            raise SystemExit(
                f"Normalized key collision {key!r}: {seen_keys[key]!r} and {sprite_name!r}"
            )
        seen_keys[key] = sprite_name
        if sprite_name not in atlas_entries:
            raise SystemExit(f"Sprite not found in current game atlases: {sprite_name!r}")

        candidates = atlas_entries[sprite_name]
        requested_atlas = selection.get("atlas_xml")
        if requested_atlas:
            candidates = [item for item in candidates if item[1]["atlas_xml"] == requested_atlas]
            if not candidates:
                raise SystemExit(
                    f"Sprite {sprite_name!r} was not found in requested atlas {requested_atlas!r}"
                )
        if len(candidates) != 1:
            atlases = ", ".join(item[1]["atlas_xml"] for item in candidates)
            raise SystemExit(
                f"Sprite name {sprite_name!r} is ambiguous across atlases ({atlases}); "
                "add atlas_xml to its selection"
            )
        atlas_path, metadata = candidates[0]
        if atlas_path not in atlas_cache:
            atlas_cache[atlas_path] = Image.open(atlas_path).convert("RGBA")
        sprite = extract_sprite(atlas_cache[atlas_path], metadata)
        destination = output / f"{key}.png"
        sprite.save(destination, optimize=True)

        manifest_entries.append(
            {
                "key": key,
                "path": f"assets/game/sprites/{key}.png",
                "sprite_name": sprite_name,
                "atlas_xml": metadata["atlas_xml"],
                "atlas_image": metadata["atlas_image"],
                "region": {
                    field: int(metadata[field])
                    for field in ("x", "y", "width", "height")
                },
                "frame": {
                    "x": int(metadata.get("frameX", 0)),
                    "y": int(metadata.get("frameY", 0)),
                    "width": int(metadata.get("frameWidth", metadata["width"])),
                    "height": int(metadata.get("frameHeight", metadata["height"])),
                },
                "kind": selection["kind"],
                "entity": selection["entity"],
                "role": selection["role"],
            }
        )

    manifest = {
        "format_version": 1,
        "source": "Realm Grinder v4.3.15 desktop TexturePacker atlases",
        "sprites": manifest_entries,
    }
    (output / "manifest.json").write_text(
        json.dumps(manifest, indent=2, ensure_ascii=False) + "\n", encoding="utf-8"
    )
    print(f"Extracted {len(manifest_entries)} sprites into {output}")


if __name__ == "__main__":
    main()
