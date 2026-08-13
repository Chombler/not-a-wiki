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
    // Raw reference pages also embed HTML inside double-quoted imagemap
    // tooltip attributes. Single quotes keep this wrapper valid in both that
    // context and ordinary page markup.
    return `<span class='game-icon-frame'>${image}</span>`;
  });
}
