import type { IconAffiliation } from './referenceIcons';

export interface SpellMenuEntry {
  id: string;
  name: string;
  icon: string;
  affiliation?: IconAffiliation;
  target: string;
  tooltip: string;
}

export interface SpellMenu {
  spells: SpellMenuEntry[];
  upgrades: SpellMenuEntry[];
  challenges: SpellMenuEntry[];
}

export function validateSpellMenu(menu: SpellMenu) {
  const expected = { spells: 30, upgrades: 16, challenges: 16 } as const;
  const ids = new Set<string>();
  for (const kind of Object.keys(expected) as Array<keyof typeof expected>) {
    if (menu[kind].length !== expected[kind]) {
      throw new Error(`Spell menu has ${menu[kind].length} ${kind}; expected ${expected[kind]}`);
    }
    for (const entry of menu[kind]) {
      if (ids.has(entry.id)) throw new Error(`Duplicate spell-menu ID: ${entry.id}`);
      ids.add(entry.id);
    }
  }
}
