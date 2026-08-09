import type { CollectionEntry } from 'astro:content';
import { tierTableHtml } from './tierTables';

type ResearchData = CollectionEntry<'research'>['data'];

export function researchTooltip(research: ResearchData) {
  const rows = research.details.map((detail) => `<p><b>${detail.label}</b>: ${detail.text}</p>`).join('');
  const table = research.tierTable ? tierTableHtml(research.tierTable.key, research.tierTable.heading) : '';
  return `<p><b>${research.code}</b> - For ${research.availableTo}</p><p><b>Research Name</b>: ${research.name}</p>${rows}${table}`;
}
