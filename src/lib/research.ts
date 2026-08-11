import type { CollectionEntry } from 'astro:content';

type ResearchData = CollectionEntry<'research'>['data'];

export function researchTooltip(research: ResearchData) {
  const rows = research.details.map((detail) => `<p><b>${detail.label}</b>: ${detail.text}</p>`).join('');
  const tableNote = research.tierTable ? '<p><b>Table</b>: Select this research to view its building-tier values.</p>' : '';
  return `<p><b>${research.code}</b> - For ${research.availableTo}</p><p><b>Research Name</b>: ${research.name}</p>${rows}${tableNote}`;
}
