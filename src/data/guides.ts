import rangeData from './guides/ranges.json';
import a0Entries from './guides/A0.json';
import a1Entries from './guides/A1.json';
import a2Entries from './guides/A2.json';
import a3Entries from './guides/A3.json';
import a4Entries from './guides/A4.json';

export interface GuideEntry {
  name: string;
  type: string;
  code: string;
  facts: Record<string, string>;
  notes: string;
  author: string;
  section?: string;
}

export interface RangeConfig {
  era: GuideEra;
  range: string;
  start: number;
  end: number;
  landing: string;
  summary: string;
  milestones: string[];
  sourceHref: string;
  sourceLabel: string;
  version: string;
  special?: boolean;
  includeUnscoped?: boolean;
  sectionMatch?: string;
}

export type GuideEra = 'A0' | 'A1' | 'A2' | 'A3' | 'A4';

export const rangeConfigs = rangeData as Record<string, RangeConfig>;
const entriesByEra = { A0: a0Entries, A1: a1Entries, A2: a2Entries, A3: a3Entries, A4: a4Entries };
export const guideEntries = Object.fromEntries(
  Object.entries(entriesByEra).map(([era, entries]) => [era, entries.map((entry) => ({
    ...entry,
    facts: Array.isArray(entry.facts) ? {} : entry.facts,
  }))]),
) as unknown as Record<GuideEra, GuideEntry[]>;

export const guideSequence: Record<string, string> = {
  A0Guide: 'Ascension 0 overview', 'A0R0-R15': 'A0 · R0–R15', 'A0R16-R29': 'A0 · R16–R29', 'A0R30-R39': 'A0 · R30–R39',
  A1Guide: 'Ascension 1 overview', 'A1R40-R59': 'A1 · R40–R59', 'A1R60-R74': 'A1 · R60–R74', 'A1R75-R99': 'A1 · R75–R99',
  A2Guide: 'Ascension 2 overview', 'A2R100-R115': 'A2 · R100–R115', 'A2R116-R124': 'A2 · R116–R124', 'A2R125-R138': 'A2 · R125–R138', 'A2R139-R159': 'A2 · R139–R159',
  A3Guide: 'Ascension 3 overview', 'A3R160-R180': 'A3 · R160–R180', 'A3R181-R189': 'A3 · R181–R189', 'A3R190-R205': 'A3 · R190–R205', 'A3R206-R219': 'A3 · R206–R219', A3SpecialBuilds: 'A3 · Special-purpose builds',
  A4Guide: 'Ascension 4 overview', 'A4R220-R229': 'A4 · R220–R229', 'A4R230-R254': 'A4 · R230–R254', 'A4R255-R279': 'A4 · R255–R279', A4PostA4: 'Post-A4 builds',
};

export const landingData: Record<GuideEra, { kicker: string; summary: string; plot?: string; alt?: string; caption?: string }> = {
  A0: { kicker: 'Pre-Ascension · R0–R39', summary: 'A current community progression route for Ascension 0. Use the plot for orientation, then choose the reincarnation range you are currently playing.', plot: 'content/A0/a0plot.png', alt: 'Pre-Ascension production guide from R0 through R39', caption: 'Recommended production route by reincarnation and gem range. Stripes indicate Dwarf or Drow prestige factions. Plot by ensteffahn for game version 4.3.11.' },
  A1: { kicker: 'Ascension 1 · R40–R99', summary: 'A1 production routes, Dragon progression, research builds, and Mercenary support builds.', plot: 'content/A1/a1plot.png', alt: 'Ascension 1 production guide from R40 through R99', caption: 'Recommended production route across Ascension 1. The lower notes mark important unlocks, trophies, and goals before A2.' },
  A2: { kicker: 'Ascension 2 · R100–R159', summary: 'Production, buff, unlock, lineage, and challenge builds for A2.', plot: 'content/A2/a2plot.png', alt: 'Ascension 2 production guide from R100 through R159', caption: 'Recommended production route across A2, with lineage, artifact-set, astral unlock, and challenge milestones.' },
  A3: { kicker: 'Ascension 3 · R160–R219', summary: 'Faction and Mercenary production, challenge, unlock, and special-purpose builds for A3.' },
  A4: { kicker: 'Ascension 4 · R220+', summary: 'Current progression, unlock, production, buff, and endgame builds for Ascension 4.' },
};

function entryRange(entry: GuideEntry): [number, number] | null {
  const text = `${entry.name} ${entry.facts.Range ?? ''} ${entry.section ?? ''}`;
  let match = text.match(/R\s*(\d+)\s*(?:-|–|to)\s*R?\s*(\d+)/i);
  if (match) return [Number(match[1]), Number(match[2])];
  match = text.match(/R\s*(\d+)\s*\+/i);
  if (match) return [Number(match[1]), 999];
  match = text.match(/R\s*(\d+)/i);
  return match ? [Number(match[1]), Number(match[1])] : null;
}

export function entriesFor(config: RangeConfig) {
  return guideEntries[config.era].filter((entry) => {
    const range = entryRange(entry);
    let included = config.special ? range === null : range !== null && range[0] <= config.end && range[1] >= config.start;
    if (!included && config.includeUnscoped && range === null) included = true;
    if (included && config.sectionMatch) included = (entry.section ?? '').toLowerCase().includes(config.sectionMatch.toLowerCase());
    return included;
  });
}
