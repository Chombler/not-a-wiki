const canonicalSprite = /\/assets\/game\/sprites\//i;
const frameSprite = /\/assets\/game\/sprites\/black-gold-trim\.png/i;

import { factionAlignmentPair, type IconAffiliation, type SpellBackground } from './referenceIcons';

interface GameIconAppearance {
  icon: string;
  label: string;
  affiliation?: IconAffiliation;
  splitAffiliations?: [IconAffiliation, IconAffiliation];
  splitAlignments?: boolean;
  alignmentBackground?: SpellBackground;
}

const escapeAttribute = (value: string) => value
  .replaceAll('&', '&amp;')
  .replaceAll('"', '&quot;')
  .replaceAll('<', '&lt;')
  .replaceAll('>', '&gt;');

/** Render the same layered icon used by the interactive reference grids. */
export function gameIconHtml(item: GameIconAppearance, base: string) {
  const pair = item.affiliation ? factionAlignmentPair[item.affiliation] : undefined;
  const split = Boolean(item.splitAlignments && pair);
  const classes = [
    'game-icon-frame',
    item.splitAffiliations ? 'game-icon-frame--affiliation-split' : '',
    split ? 'game-icon-frame--alignment-split' : '',
    item.alignmentBackground ? 'game-icon-frame--alignment-full' : '',
  ].filter(Boolean).join(' ');
  const styles = [
    item.affiliation && `--reference-icon-frame:url('${base}assets/game/sprites/${item.affiliation}-trim.png')`,
    item.splitAffiliations && `--reference-icon-affiliation-primary:url('${base}assets/game/sprites/${item.splitAffiliations[0]}-trim.png')`,
    item.splitAffiliations && `--reference-icon-affiliation-secondary:url('${base}assets/game/sprites/${item.splitAffiliations[1]}-trim.png')`,
    split && pair && `--reference-icon-primary:url('${base}assets/game/sprites/spell-box-${pair[0]}-up.png')`,
    split && pair && `--reference-icon-secondary:url('${base}assets/game/sprites/spell-box-${pair[1]}-up.png')`,
    item.alignmentBackground && `--reference-icon-alignment:url('${base}assets/game/sprites/spell-box-${item.alignmentBackground}-up.png')`,
  ].filter(Boolean).join(';');
  const affiliationPanels = item.splitAffiliations
    ? '<span class="game-icon-affiliation game-icon-affiliation--primary"></span><span class="game-icon-affiliation game-icon-affiliation--secondary"></span>'
    : '';
  const alignmentPanels = split
    ? '<span class="game-icon-alignment game-icon-alignment--primary"></span><span class="game-icon-alignment game-icon-alignment--secondary"></span>'
    : item.alignmentBackground ? '<span class="game-icon-alignment game-icon-alignment--full"></span>' : '';
  return `<span class="${classes}"${styles ? ` style="${styles}"` : ''}><img data-game-icon-unframed src="${base}assets/game/sprites/${item.icon}" alt="${escapeAttribute(item.label)}">${affiliationPanels}${alignmentPanels}</span>`;
}

/**
 * Detailed spell prose stays hand-authored. Existing article IDs connect its
 * heading and related upgrade/challenge icons to the shared spell inventory.
 */
export function decorateSpellEntryIcons(html: string, items: Array<GameIconAppearance & { target: string }>, base: string) {
  const itemsByTarget = new Map<string, Array<GameIconAppearance & { target: string }>>();
  for (const item of items) itemsByTarget.set(item.target, [...(itemsByTarget.get(item.target) ?? []), item]);

  return html.replace(/<article class="spell-entry" id="([^"]+)">[\s\S]*?<\/article>/g, (article, target: string) => {
    const targetItems = itemsByTarget.get(target);
    if (!targetItems) return article;
    let decorated = article;
    for (const item of targetItems) {
      const imagePattern = new RegExp(`<span class='game-icon-frame'><img\\b[^>]*\\bsrc="[^"]*/${item.icon.replace(/[.*+?^${}()|[\\]\\]/g, '\\$&')}"[^>]*><\\/span>`);
      decorated = decorated.replace(imagePattern, gameIconHtml(item, base));
    }
    return decorated;
  });
}

/**
 * Current-game atlas exports are raw sprite art. The gold frame is a shared
 * part of the game's icon renderer, so authors only need to insert the image.
 * Legacy Factions/picks images are intentionally excluded because many have
 * an older frame baked into the file and would otherwise be double-framed.
 */
export function frameGameIcons(html: string) {
  return html.replace(/<img\b[^>]*>/gi, (image) => {
    if (!canonicalSprite.test(image) || frameSprite.test(image) || /data-game-icon-unframed/i.test(image)) return image;
    // Raw reference pages also embed HTML inside double-quoted imagemap
    // tooltip attributes. Single quotes keep this wrapper valid in both that
    // context and ordinary page markup.
    return `<span class='game-icon-frame'>${image}</span>`;
  });
}
