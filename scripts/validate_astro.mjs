import fs from 'node:fs';
import path from 'node:path';

const root = path.resolve(import.meta.dirname, '..');
const output = path.join(root, 'dist');
const base = process.env.BASE_PATH || '/not-a-wiki';
const normalizedBase = `/${base.replace(/^\/+|\/+$/g, '')}/`;
const baselinePath = path.join(root, 'scripts', 'known-missing-assets.json');
const writeBaseline = process.argv.includes('--write-baseline');
const failures = [];

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
  .map((file) => publicRoute(file, root, 'index.php')));
const builtFiles = walk(output, (file) => file.endsWith('.html'));
const builtRoutes = new Set(builtFiles.map((file) => publicRoute(file, output, 'index.html')));
for (const route of legacyRoutes) if (!builtRoutes.has(route)) failures.push(`Missing legacy route: /${route}`);

const missingAssets = new Set();
for (const file of builtFiles) {
  const html = fs.readFileSync(file, 'utf8').replace(/<!--[\s\S]*?-->/g, '');
  for (const icon of html.matchAll(/<img\b[^>]*\/assets\/game\/sprites\/(?!black-gold-trim\.png)[^>]*>/gi)) {
    const prefix = html.slice(Math.max(0, icon.index - 80), icon.index);
    if (!/<span class="game-icon-frame">\s*$/.test(prefix)) {
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
  'Artifacts/index.html': ['name="QuestArtifacts-map"', 'name="LoreArtifacts-map"', 'href="/not-a-wiki/LoreArtifacts/#WallFragment"', 'href="/not-a-wiki/LoreArtifacts/#WallChunk"'],
  'LoreArtifacts/index.html': ['id="WallFragment"', 'id="WallChunk"', 'class="numtable tier-table'],
  'ResearchList/index.html': ['id="spellcraft"', 'class="research-entry"'],
  'Researchtree/index.html': ['usemap="#ResearchTreeA4-map"', 'data-research='],
  'Spells/index.html': ['(11 - T) ^ 5', 'Hall of Legends</td><td>0 × ln(1 + x)^6%', 'class="numtable primal-balance-table"', '<td>11 (all)</td>'],
  'TrophyPage/index.html': ['id="mathematician-building-bonuses"', 'Mathematician bonus by building', 'Hall of Legends</td><td>10%'],
  'A0Guide/index.html': ['class="progression-plot"', 'class="guide-stage-grid"', 'class="guide-pager"'],
  'A4Guide/index.html': ['class="a4-budget-table"', 'class="guide-stage-grid"'],
  'A4PostA4/index.html': ['data-guide-filter', 'class="guide-build-entry"', 'class="build-credit"'],
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
validateTrophyGrid('Miscellaneous Trophies', 170);
validateTrophyGrid('Magic Trophies', 62);

const allTrophiesHtml = fs.readFileSync(path.join(output, 'AllTrophies/index.html'), 'utf8');
if (!allTrophiesHtml.includes('903 Total Trophies')) failures.push('AllTrophies lost the current 903-trophy total');
const trophyEntries = [...allTrophiesHtml.matchAll(/class="trophy-entry"/g)].length;
if (trophyEntries !== 903) failures.push(`AllTrophies has ${trophyEntries}/903 text records`);
for (const [heading, expected] of [['Secret Trophies', 60], ['Allegiance Trophies', 45], ['Miscellaneous Trophies', 170], ['Magic Trophies', 62], ['Building Trophies', 566]]) {
  if (!allTrophiesHtml.includes(`<summary>${heading} (${expected})</summary>`)) {
    failures.push(`AllTrophies lost canonical ${heading} count`);
  }
}
const trophyPageHtml = fs.readFileSync(path.join(output, 'TrophyPage/index.html'), 'utf8');
const trophyButtons = [...trophyPageHtml.matchAll(/class="trophy-grid-button"/g)].length;
if (trophyButtons !== 903) failures.push(`TrophyPage has ${trophyButtons}/903 interactive records`);
const linkedTrophyIcons = [...trophyPageHtml.matchAll(/<a class="trophy-grid-button"/g)].length;
if (linkedTrophyIcons !== 3) failures.push(`TrophyPage has ${linkedTrophyIcons}/3 guide-linked icons`);
if (!trophyPageHtml.includes('href="/not-a-wiki/MercBuilds/#TrophyBuilds"') || !trophyPageHtml.includes('href="/not-a-wiki/TrophyPage/#mathematician-building-bonuses"')) {
  failures.push('TrophyPage lost guide links or their section anchors');
}
if (!trophyPageHtml.includes('Harlequin') || !allTrophiesHtml.includes('Harlequin')) failures.push('Canonical trophy content is missing from one rendered view');
if (trophyPageHtml.includes('If a build is needed I will add a link to that build')) {
  failures.push('TrophyPage restored the obsolete build-link disclaimer');
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
