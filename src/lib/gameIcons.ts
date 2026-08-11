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

const trophyMaps: Record<string, string> = {
  'SecretTrophies-map': 'Secret Trophies',
  'AllegiancesTrophies-map': 'Allegiance Trophies',
  'MiscTrophies-map': 'Miscellaneous Trophies',
  'MagicTrophies-map': 'Magic Trophies',
  'BuildingTrophies-map': 'Building Trophies',
};

/** Convert the old prebaked trophy image maps into responsive, accessible grids. */
export function renderTrophyGrids(html: string) {
  const escapeAttribute = (value: string) => value
    .replaceAll('&', '&amp;')
    .replaceAll('"', '&quot;')
    .replaceAll('<', '&lt;')
    .replaceAll('>', '&gt;');
  for (const [mapName, heading] of Object.entries(trophyMaps)) {
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
        return `<button type="button" class="trophy-grid-button" research="${escapeAttribute(tooltip)}" aria-label="${escapeAttribute(label)}"><img src="${source}" alt=""></button>`;
      })
      .join('');
    const grid = `<section class="trophy-grid-section"><h2>${heading}</h2><div class="trophy-icon-grid">${buttons}</div></section>`;
    const imagePattern = new RegExp(`<p>\\s*<img[^>]*usemap="#${mapName}"[^>]*>\\s*<\\/p>`);
    html = html.replace(imagePattern, grid).replace(mapPattern, '');
  }
  return html;
}
