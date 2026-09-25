import fs from 'node:fs';
import path from 'node:path';

const root = path.resolve(import.meta.dirname, '..');
const output = path.join(root, 'dist');
const base = process.env.BASE_PATH || '/not-a-wiki';
const normalizedBase = `/${base.replace(/^\/+|\/+$/g, '')}/`;
const baselinePath = path.join(root, 'scripts', 'known-missing-assets.json');
const siteScope = JSON.parse(fs.readFileSync(path.join(root, 'src', 'data', 'site-scope.json'), 'utf8'));
const withheldGuidanceRoutes = new Set(siteScope.withheldGuidanceRoutes);
const writeBaseline = process.argv.includes('--write-baseline');
const failures = [];

const siteScript = fs.readFileSync(path.join(root, 'public', 'scripts', 'site.js'), 'utf8');
if (!siteScript.includes("main.querySelectorAll('h2[id], h3[id]')") || !siteScript.includes('if (headings.length < 2) return;')) {
  failures.push('Page TOC no longer requires at least two authored, stable section headings');
}
const gameWindowSource = fs.readFileSync(path.join(root, 'src', 'page-content', 'reference', 'GameWindow.html'), 'utf8');
if (/rtree\.css/i.test(gameWindowSource)) {
  failures.push('GameWindow restored the legacy Research Tree stylesheet and its global layout overrides');
}

function walk(directory, predicate) {
  if (!fs.existsSync(directory)) return [];
  return fs.readdirSync(directory, { withFileTypes: true }).flatMap((entry) => {
    const target = path.join(directory, entry.name);
    return entry.isDirectory() ? walk(target, predicate) : predicate(target) ? [target] : [];
  });
}

function publicRoute(file, directory, indexName) {
  const relative = path.relative(directory, file).split(path.sep).join('/');
  return relative === indexName ? '' : relative.replace(new RegExp(`/${indexName.replace('.', '\\.')}$`), '');
}

function targetExists(relative) {
  return [path.join(output, relative), path.join(output, relative, 'index.html')].some(fs.existsSync);
}

const legacyRoutes = new Set(walk(root, (file) => file.endsWith('/index.php') || file.endsWith(`${path.sep}index.php`))
  .filter((file) => !file.includes(`${path.sep}node_modules${path.sep}`))
  .filter((file) => !file.includes(`${path.sep}local-support${path.sep}`))
  .map((file) => publicRoute(file, root, 'index.php')));
const builtFiles = walk(output, (file) => file.endsWith('.html'));
const builtRoutes = new Set(builtFiles.map((file) => publicRoute(file, output, 'index.html')));
for (const route of legacyRoutes) {
  if (!builtRoutes.has(route) && !withheldGuidanceRoutes.has(route)) failures.push(`Missing legacy route: /${route}`);
}
for (const route of withheldGuidanceRoutes) {
  if (builtRoutes.has(route)) failures.push(`Withheld community-guidance route was published: /${route}`);
}

const missingAssets = new Set();
for (const file of builtFiles) {
  const html = fs.readFileSync(file, 'utf8').replace(/<!--[\s\S]*?-->/g, '');
  const route = publicRoute(file, output, 'index.html');
  if (route) {
    const breadcrumb = html.match(/<nav class="breadcrumbs"[\s\S]*?<\/nav>/i)?.[0];
    if (!breadcrumb) failures.push(`${path.relative(output, file)} has no navigation breadcrumb`);
    else if ([...breadcrumb.matchAll(/<li>/g)].length < 2) failures.push(`${path.relative(output, file)} has no classified parent in its breadcrumb`);
  }
  for (const route of withheldGuidanceRoutes) {
    if (new RegExp(`href=["'][^"']*/${route}/?(?:[#?][^"']*)?["']`, 'i').test(html)) {
      failures.push(`${path.relative(output, file)} links to withheld community guidance: ${route}`);
    }
  }
  for (const icon of html.matchAll(/<img\b[^>]*\/assets\/game\/sprites\/(?!black-gold-trim\.png)[^>]*>/gi)) {
    if (/data-game-icon-unframed/i.test(icon[0])) continue;
    const prefix = html.slice(Math.max(0, icon.index - 80), icon.index);
    if (!/<span class=(?:"game-icon-frame"|'game-icon-frame')>\s*$/.test(prefix)) {
      failures.push(`${path.relative(output, file)} contains an unframed canonical game icon`);
    }
  }
  if (/<area\b(?:(?!>).)*\b(?:data-)?research=(["'])(?:(?!\1).)*<table/is.test(html)) {
    failures.push(`${path.relative(output, file)} contains table markup inside an image-map tooltip`);
  }
  for (const match of html.matchAll(/(?:href|src)=(["'])(.*?)\1/g)) {
    const raw = match[2].split('#')[0].split('?')[0];
    if (!raw.startsWith(normalizedBase)) continue;
    const relative = decodeURIComponent(raw.slice(normalizedBase.length));
    if (!relative || targetExists(relative)) continue;
    if (/\.[a-z0-9]{2,5}$/i.test(relative)) missingAssets.add(relative);
    else failures.push(`${path.relative(output, file)} links to missing route: ${relative}`);
  }
}

const currentMissing = [...missingAssets].sort();
if (writeBaseline) {
  process.stdout.write(`${JSON.stringify(currentMissing, null, 2)}\n`);
  process.exit(0);
}
const knownMissing = fs.existsSync(baselinePath) ? JSON.parse(fs.readFileSync(baselinePath, 'utf8')) : [];
const knownSet = new Set(knownMissing);
for (const asset of currentMissing) if (!knownSet.has(asset)) failures.push(`New missing asset: ${asset}`);
for (const asset of knownMissing) if (!missingAssets.has(asset)) failures.push(`Remove repaired asset from baseline: ${asset}`);

const contracts = {
  'index.html': ['class="site-shell"', 'class="site-sidebar"', 'class="reference-home-header"', '--game-icon-frame: url(&quot;/not-a-wiki/assets/game/sprites/black-gold-trim.png&quot;)'],
  'Artifacts/index.html': ['name="QuestArtifacts-map"', 'name="LoreArtifacts-map"', 'href="/not-a-wiki/LoreArtifacts/#WallFragment"', 'href="/not-a-wiki/LoreArtifacts/#WallChunk"', 'id="artifact-overview"', 'id="excavations"'],
  'LoreArtifacts/index.html': ['id="WallFragment"', 'id="WallChunk"', 'id="ascension-0"', 'id="ascension-4"', 'class="numtable tier-table'],
  'ResearchList/index.html': ['id="spellcraft"', 'id="forbidden"', 'class="research-entry"'],
  'Researchtree/index.html': ['id="research-point-calculator"', 'id="research-tree"', 'usemap="#ResearchTreeA4-map"', 'data-research='],
  'Spells/index.html': ['id="default-spells"', 'id="special-spells"', '(11 - T) ^ 5', 'Hall of Legends</td><td>0 × ln(1 + x)^6%', 'class="numtable primal-balance-table"', '<td>11 (all)</td>'],
  'SpellTiers/index.html': ['id="spell-tier-mechanics"', 'id="tier-upgrades-and-autocasting"', 'id="spell-tier-unlocks"'],
  'Factions/index.html': ['id="base-factions"', 'id="astral-factions"', 'id="faction-spells-and-upgrades"', 'usemap="#FactionGrid-map"', 'Click a faction icon to open its complete reference page', 'href="/not-a-wiki/FairyFaction/"'],
  'TrophyPage/index.html': ['id="mathematician-building-bonuses"', 'Mathematician bonus by building', 'Hall of Legends</td><td>10%'],
  'AllTrophies/index.html': ['id="allegiance-trophies"', 'id="building-trophies"', '903 Total Trophies'],
  'FairyFaction/index.html': ['id="faction-overview"', 'id="faction-spell"', 'id="tier-4-upgrades"'],
  'Fairy/index.html': ['id="FRC1"', 'id="FRCR"'],
  'Reincarnation/index.html': ['id="reincarnation-power"', 'id="current-powers"', 'id="kept-at-reincarnation"'],
  'Bloodline/index.html': ['<h3 id="Fairy">', '<h3 id="Dwarf">', '<h3 id="Makers">'],
  'Lineages/index.html': ['<h3 id="Fairy">', '<h3 id="Dwarven">', '<h3 id="Makers">'],
  'QuestArtifacts/index.html': ['id="ascension-0"', 'id="ascension-1"', 'id="ascension-2"', 'id="iron-fragments"', 'id="ascension-3"', 'id="ascension-4"'],
  'Heritages/index.html': ['<h2 id="Heritages">', '<h3 id="FRH">', '<h2 id="AdvancedHeritages">', '<h3 id="DGAH">'],
  'UniqueBuilding/index.html': ['id="unique-building-reference"', 'id="fairy"', 'id="makers"'],
  'ArtifactSet/index.html': ['id="artifact-set-reference"', '<h3 id="Fairy">', '<h3 id="Mercenary">'],
  'Challenges/index.html': ['id="challenge-rules"', 'id="challenge-factions"', 'id="challenge-map"'],
  'Events/index.html': ['id="permanent-seasonal-rewards"', 'id="seasonal-event-upgrades"', 'id="events-2015"'],
  'Terminology/index.html': ['id="shortcuts"', 'id="game-terminology"', 'id="abbreviations"'],
  'BuildingAlignments/index.html': ['id="building-tiers"', '250,000 × <var>T</var>', 'id="alignment-and-proofs"', 'id="hall-of-legends"', 'id="building-costs"', 'id="next-building-cost"', 'id="multiple-building-cost"', 'id="cost-multiplier"', 'id="related-building-pages"', '/BuildingUpgrades/', '/UniqueBuilding/'],
  'GameWindow/index.html': ['id="game-window"', 'id="options-window"'],
  'Upgrades/index.html': ['id="alignment-upgrades"', 'id="assistant-upgrades"'],
  'FactionUpgrades/index.html': ['id="tier-1-upgrades"', 'id="tier-4-upgrades"'],
  'Notation/index.html': ['id="suffix-table"', 'id="full-number-list"'],
  'Rubies/index.html': ['id="getting-rubies"', 'id="ruby-excavation-calculator"', 'function calculateRubyExcavation()', 'Math.expm1(growth)', 'calculator.addEventListener', 'currently owned Rubies', 'id="spending-rubies"', 'ruby-assistant-upgrade.png', 'ruby-mana-upgrade.png', 'ruby-max-mana-upgrade.png', 'ruby-gem-upgrade.png', 'ruby-exchange-upgrade.png', '+1 Mana per second', 'id="ruby-reset-behavior"', 'Spent Rubies are refunded', 'id="ruby-upgrade-panel"', 'Ruby Power tiers', 'ruby-power-upgrade.png', 'ruby-upgrade1.png', 'ruby-upgrade50.png', '50 Rubies', 'id="ruby-appearance"', 'Rubies have one standard appearance'],
  'Resources/index.html': ['id="resource-summary"', 'id="resource-pages"', 'id="other-currencies"', 'id="cosmetic-appearances"', 'mana-bubble-full.png'],
  'Mana/index.html': ['id="mana-values"', 'id="online-mana"', 'id="offline-mana"', 'min(Maximum Mana, offline Mana Regeneration)', 'id="mana-appearance"'],
  'CoinsAndGems/index.html': ['id="coin-currencies"', 'id="gems"', '5e11 * n * (n + 1)', 'id="coin-and-gem-resets"', 'diamond-coin.png', 'id="coin-appearance"', 'Selectable coin particles', 'particle-valentine.png', 'particle-summer1.png', 'Summer — Snow', 'particle-summer2.png', 'Summer — Fire', 'particle-idillium.png'],
  'FactionCoins/index.html': ['id="faction-coin-types"', 'Corresponding faction', 'Elven Coins</td><td><a href="/not-a-wiki/ElfFaction/">Elf</a>', 'Dwarven Coins</td><td><a href="/not-a-wiki/DwarfFaction/">Dwarf</a>', 'Drow Coins</td><td><a href="/not-a-wiki/DrowFaction/">Drow</a>', 'id="neutral-factions"', 'Titan</a></td><td><span class="faction-coin-list"', 'id="later-factions"', 'Prestige and Astral faction currency pairs', 'Dragon</a></td><td><span class="faction-coin-list"', 'id="finding-faction-coins"', 'id="spending-faction-coins"', 'Faction affiliation and tier unlocks', 'Lineage levels', 'Mercenary contracts and upgrades', 'Legacy Containers and Legacy Combos', 'fairy-coin-small.png', 'id="faction-coin-appearance"', 'particle-fairy-coin.png', 'particle-drow-coin.png'],
};
for (const [relative, markers] of Object.entries(contracts)) {
  const file = path.join(output, relative);
  if (!fs.existsSync(file)) { failures.push(`Missing representative layout: ${relative}`); continue; }
  const html = fs.readFileSync(file, 'utf8');
  for (const marker of markers) if (!html.includes(marker)) failures.push(`${relative} lost layout marker: ${marker}`);
}

function validateTrophyGrid(heading, expected) {
  const html = fs.readFileSync(path.join(output, 'TrophyPage/index.html'), 'utf8');
  const start = html.indexOf(`<span>${heading} (`);
  const end = html.indexOf('</details>', start);
  if (start === -1 || end === -1) {
    failures.push(`TrophyPage lost ${heading} grid`);
    return;
  }
  const grid = html.slice(start, end);
  const buttons = [...grid.matchAll(/class="trophy-grid-button"/g)].length;
  if (buttons !== expected) failures.push(`TrophyPage has ${buttons}/${expected} buttons in ${heading}`);
  if (/\/Factions\/picks\//i.test(grid)) failures.push(`TrophyPage retains legacy icons in ${heading}`);
}

validateTrophyGrid('Allegiance Trophies', 45);
validateTrophyGrid('Building Trophies', 566);
validateTrophyGrid('Secret Trophies', 60);
validateTrophyGrid('Misc Trophies', 170);
validateTrophyGrid('Magic Trophies', 62);

const allTrophiesHtml = fs.readFileSync(path.join(output, 'AllTrophies/index.html'), 'utf8');
if (!allTrophiesHtml.includes('903 Total Trophies')) failures.push('AllTrophies lost the current 903-trophy total');
const trophyEntries = [...allTrophiesHtml.matchAll(/class="trophy-entry"/g)].length;
if (trophyEntries !== 903) failures.push(`AllTrophies has ${trophyEntries}/903 text records`);
for (const [heading, expected] of [['Secret Trophies', 60], ['Allegiance Trophies', 45], ['Misc Trophies', 170], ['Magic Trophies', 62], ['Building Trophies', 566]]) {
  if (!allTrophiesHtml.includes(`<summary>${heading} (${expected})</summary>`)) {
    failures.push(`AllTrophies lost canonical ${heading} count`);
  }
}
const trophyPageHtml = fs.readFileSync(path.join(output, 'TrophyPage/index.html'), 'utf8');
function requireIncreasingOrder(html, markers, label) {
  let previous = -1;
  for (const marker of markers) {
    const current = html.indexOf(marker);
    if (current === -1 || current <= previous) {
      failures.push(`${label} no longer follows current-game order at: ${marker}`);
      return;
    }
    previous = current;
  }
}
const gameCategoryOrder = ['Allegiance Trophies', 'Misc Trophies', 'Magic Trophies', 'Building Trophies', 'Secret Trophies'];
requireIncreasingOrder(trophyPageHtml, gameCategoryOrder.map((heading) => `<span>${heading} (`), 'TrophyPage categories');
requireIncreasingOrder(allTrophiesHtml, gameCategoryOrder.map((heading) => `<summary>${heading} (`), 'AllTrophies categories');
requireIncreasingOrder(trophyPageHtml, ['aria-label="Mercenary Oath"', 'aria-label="Dragon Tamer"'], 'TrophyPage Allegiance trophies');
requireIncreasingOrder(allTrophiesHtml, ['id="mercenary-oath"', 'id="dragon-tamer-trophy"'], 'AllTrophies Allegiance trophies');
requireIncreasingOrder(trophyPageHtml, ['aria-label="Reality Crater"', 'aria-label="Holy Frenzy"'], 'TrophyPage Magic trophies');
requireIncreasingOrder(allTrophiesHtml, ['id="reality-crater-trophy"', 'id="holy-frenzy-trophy"'], 'AllTrophies Magic trophies');
requireIncreasingOrder(trophyPageHtml, ['aria-label="Spell Cataclysm"', 'aria-label="Double Bottom"', 'aria-label="Advisor Insight"'], 'TrophyPage Secret trophies');
requireIncreasingOrder(allTrophiesHtml, ['id="spell-cataclysm-trophy"', 'id="double-bottom-trophy"', 'id="ui-tip-trophy"'], 'AllTrophies Secret trophies');
const trophyStyles = fs.readFileSync(path.join(root, 'scripts/common.css'), 'utf8');
if (/\.progression-nav:focus-within\s+\.guide-range-nav/.test(trophyStyles)) {
  failures.push('Sidebar focus globally expands every nested navigation branch');
}
if (!trophyStyles.includes('font-family: "Realm Grinder Liony", Georgia, serif') || !trophyStyles.includes('font-size: 32px') || !trophyStyles.includes('row-gap: 2px') || !trophyStyles.includes('var(--trophy-header-skin)') || !trophyStyles.includes('var(--trophy-collapse-up)') || !trophyStyles.includes('var(--trophy-collapse-down)')) {
  failures.push('Trophy section controls no longer use the game\'s font and collapse-arrow textures');
}
for (const asset of ['assets/game/fonts/liony-bold.otf', 'assets/game/ui/black-stone-header.png', 'assets/game/ui/collapse-arrow-up.png', 'assets/game/ui/collapse-arrow-down.png']) {
  if (!fs.existsSync(path.join(root, 'public', asset))) failures.push(`Missing current-game trophy header asset: ${asset}`);
}
if (!trophyPageHtml.includes('@font-face{font-family:"Realm Grinder Liony"') || !trophyPageHtml.includes('/not-a-wiki/assets/game/fonts/liony-bold.otf') || !trophyPageHtml.includes('--trophy-header-skin: url(&quot;/not-a-wiki/assets/game/ui/black-stone-header.png&quot;)') || !trophyPageHtml.includes('--trophy-collapse-up: url(&quot;/not-a-wiki/assets/game/ui/collapse-arrow-up.png&quot;)') || !trophyPageHtml.includes('--trophy-collapse-down: url(&quot;/not-a-wiki/assets/game/ui/collapse-arrow-down.png&quot;)')) {
  failures.push('Trophy header game assets are not mounted through the configured site base path');
}
const trophyButtons = [...trophyPageHtml.matchAll(/class="trophy-grid-button"/g)].length;
if (trophyButtons !== 903) failures.push(`TrophyPage has ${trophyButtons}/903 interactive records`);
const linkedTrophyIcons = [...trophyPageHtml.matchAll(/<a class="trophy-grid-button"/g)].length;
if (linkedTrophyIcons !== 1) failures.push(`TrophyPage has ${linkedTrophyIcons}/1 published reference-linked icons`);
if (!trophyPageHtml.includes('href="/not-a-wiki/TrophyPage/#mathematician-building-bonuses"')) failures.push('TrophyPage lost the Mathematician reference link');
if (/href="\/not-a-wiki\/(?:MercBuilds|SpeedRun)\//.test(trophyPageHtml)) failures.push('TrophyPage publishes a withheld community-guidance link');
for (const source of walk(path.join(root, 'src/content/trophies'), (file) => file.endsWith('.yaml'))) {
  if (/<a\b/i.test(fs.readFileSync(source, 'utf8'))) {
    failures.push(`${path.relative(root, source)} contains a description-only link; use the structured guide field`);
  }
}
if (!trophyPageHtml.includes('Harlequin') || !allTrophiesHtml.includes('Harlequin')) failures.push('Canonical trophy content is missing from one rendered view');
if (trophyPageHtml.includes('If a build is needed I will add a link to that build')) {
  failures.push('TrophyPage restored the obsolete build-link disclaimer');
}

const factionsSource = fs.readFileSync(path.join(root, 'src/page-content/reference/Factions.html'), 'utf8');
if (/<area\b[^>]*\bresearch=/i.test(factionsSource)) {
  failures.push('Factions navigation map regained independently maintained faction summaries');
}
if ([...factionsSource.matchAll(/<area\b/g)].length !== 16) {
  failures.push('Factions navigation map does not contain all 16 faction destinations');
}

const spellPageHtml = fs.readFileSync(path.join(output, 'Spells/index.html'), 'utf8');
const spellTierPageHtml = fs.readFileSync(path.join(output, 'SpellTiers/index.html'), 'utf8');
const authoredSpellSource = fs.readFileSync(path.join(root, 'src/page-content/reference/Spells.html'), 'utf8');
const spellMenuSource = fs.readFileSync(path.join(root, 'src/content/spell-menu/menu.yaml'), 'utf8');
const allowedSpellComposites = new Set([
  'SpellsTopPage.png',
  'RealmGrinderHeader.png',
]);
for (const [page, html] of [['Spells', spellPageHtml], ['SpellTiers', spellTierPageHtml]]) {
  const legacyImages = [...html.matchAll(/Factions\/picks\/([^&"']+\.png)/g)]
    .map((match) => match[1])
    .filter((name) => !allowedSpellComposites.has(name));
  if (legacyImages.length) failures.push(`${page} retains legacy individual icons: ${[...new Set(legacyImages)].join(', ')}`);
}
const currentSpellSprites = [...spellPageHtml.matchAll(/assets\/game\/sprites\/([^&"']+\.png)/g)];
if (currentSpellSprites.length < 100) failures.push(`Spells renders only ${currentSpellSprites.length} current-game sprite references`);
for (const [kind, expected] of [['spell', 30], ['upgrade', 16], ['challenge', 16]]) {
  const count = [...spellPageHtml.matchAll(new RegExp(`spell-grid-button--${kind}`, 'g'))].length;
  if (count !== expected) failures.push(`Spells renders ${count} ${kind} grid entries; expected ${expected}`);
}
if ([...spellPageHtml.matchAll(/class="spell-entry"/g)].length !== 30) failures.push('Spells does not render 30 detailed spell entries');
if (spellPageHtml.includes('<map ') || spellPageHtml.includes('SpellsMap.png')) failures.push('Spells restored a baked imagemap instead of canonical spell records');
if (!spellPageHtml.includes(`href="#GodsHand"`) || !spellPageHtml.includes(`gods-hand-icon.png`)) failures.push('Spells lost the God\'s Hand anchor or current icon');
if ([...authoredSpellSource.matchAll(/class="spell-entry"/g)].length !== 30 || !authoredSpellSource.includes('<realm-spell-menu>')) {
  failures.push('Spells reference content is no longer authored as one readable page around the reusable icon menu');
}
for (const normalizedField of ['supplement:', 'section:', 'upgradeId:', 'challengeId:']) {
  if (spellMenuSource.includes(normalizedField)) failures.push(`Spell menu regained full-reference field: ${normalizedField}`);
}
if (!spellTierPageHtml.includes('assets/game/sprites/tiered-autocast-upgrade.png')) failures.push('SpellTiers lost the current Tiered Autocasting icon');
const sunForceHtml = fs.readFileSync(path.join(output, 'SunForce/index.html'), 'utf8');
for (const icon of ['dawnstone-artifact.png', 'duskstone-artifact.png', 'planetary-force-artifact.png']) {
  if (!sunForceHtml.includes(`assets/game/sprites/${icon}`)) failures.push(`SunForce lost current-game icon: ${icon}`);
}

console.log(`Routes: ${builtRoutes.size} built, ${legacyRoutes.size} legacy routes covered`);
console.log(`Internal links: checked across ${builtFiles.length} pages`);
console.log(`Known missing assets: ${currentMissing.length}`);
console.log(`Representative layouts: ${Object.keys(contracts).length} checked`);
if (failures.length) {
  console.error(`\nValidation failed (${failures.length}):\n${failures.join('\n')}`);
  process.exit(1);
}
console.log('Astro parity validation passed.');
