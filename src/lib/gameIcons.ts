const canonicalSprite = /\/assets\/game\/sprites\//i;
const frameSprite = /\/assets\/game\/sprites\/black-gold-trim\.png/i;

/**
 * Current-game atlas exports are raw sprite art. The gold frame is a shared
 * part of the game's icon renderer, so authors only need to insert the image.
 * Legacy Factions/picks images are intentionally excluded because many have
 * an older frame baked into the file and would otherwise be double-framed.
 */
export function frameGameIcons(html: string) {
  return html.replace(/<img\b[^>]*>/gi, (image) => {
    if (!canonicalSprite.test(image) || frameSprite.test(image) || /data-game-icon-unframed/i.test(image)) return image;
    return `<span class="game-icon-frame">${image}</span>`;
  });
}

const trophyMaps: Record<string, { label: string; count: number }> = {
  'SecretTrophies-map': { label: 'Secret Trophies', count: 65 },
  'AllegiancesTrophies-map': { label: 'Allegiance Trophies', count: 41 },
  'MiscTrophies-map': { label: 'Miscellaneous Trophies', count: 170 },
  'MagicTrophies-map': { label: 'Magic Trophies', count: 61 },
  'BuildingTrophies-map': { label: 'Building Trophies', count: 566 },
};

/** Convert the old prebaked trophy image maps into responsive, accessible grids. */
export function renderTrophyGrids(html: string) {
  const escapeAttribute = (value: string) => value
    .replaceAll('&', '&amp;')
    .replaceAll('"', '&quot;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;');
  for (const [mapName, section] of Object.entries(trophyMaps)) {
    const mapPattern = new RegExp(`<map name="${mapName}">([\\s\\S]*?)<\\/map>`);
    const match = html.match(mapPattern);
    if (!match) continue;
    const buttons = [...match[1].matchAll(/<area\b([\s\S]*?)(?=<area\b|$)/g)]
      .map((area) => {
        const tooltip = area[1].match(/(?:data-)?research="([\s\S]*?)"\s+(?:coords|shape)=/)?.[1];
        if (!tooltip) return '';
        const source = tooltip.match(/<img\b[^>]*\bsrc=&quot;([^&]+)&quot;/i)?.[1];
        if (!source) return '';
        const label = tooltip.match(/<b>([^<]+)<\/b>/i)?.[1].trim() || 'Trophy details';
        const decodedTooltip = tooltip.replaceAll('&quot;', '"').replaceAll('&amp;', '&');
        return `<button type="button" class="trophy-grid-button" research="${escapeAttribute(decodedTooltip)}" aria-label="${escapeAttribute(label)}"><img src="${source}" alt=""></button>`;
      })
      .join('');
    const initiallyOpen = mapName === 'SecretTrophies-map' ? ' open' : '';
    const grid = `<details class="trophy-grid-section"${initiallyOpen}><summary><span>${section.label} (${section.count}/${section.count})</span></summary><div class="trophy-icon-grid">${buttons}</div></details>`;
    const imagePattern = new RegExp(`<p>\\s*<img[^>]*usemap="#${mapName}"[^>]*>\\s*<\\/p>`);
    html = html.replace(imagePattern, grid).replace(mapPattern, '');
  }
  return html.replace(/((?:<details class="trophy-grid-section"[\s\S]*?<\/details>\s*){5})/, '<div class="trophy-drawer">$1</div>');
}
