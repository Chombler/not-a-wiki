<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
require_once __DIR__ . '/../scripts/guide_components.php';
function render_a1_notes($path) {
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    $paragraph = array();
    $flush = function () use (&$paragraph) {
        if (!$paragraph) return;
        echo '<p>' . nl2br(htmlspecialchars(implode("\n", $paragraph))) . '</p>';
        $paragraph = array();
    };
    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '') { $flush(); continue; }
        if (preg_match('/^(.+?)\s+—\s+(.+)$/u', $line, $match)) {
            $flush();
            echo '<p class="source-attribution"><strong>' . htmlspecialchars($match[1]) . '</strong><span>' . htmlspecialchars($match[2]) . '</span></p>';
        } elseif (strlen($line) > 55 && preg_match('/^(?:[A-Z]{1,3}[0-9]+|MA:|SP:)/', $line) && substr_count($line, ',') > 5) {
            $flush();
            echo '<div class="source-build-code"><code>' . htmlspecialchars($line) . '</code><button type="button" class="copy-build" data-build="' . htmlspecialchars($line) . '">Copy</button></div>';
        } elseif (preg_match('/^(Dragon build Megapost|Dragon Challenges|Faction recommendations|General Note|Lineage Leveler \(Pre-Mercs\)|W300 buff.*|lineage leveler|E3300 unlock build|D3350 unlock build|Primal Balance 10 buff build.*|TL\/DR):?$/i', $line)) {
            $flush();
            echo '<h3>' . htmlspecialchars(rtrim($line, ':')) . '</h3>';
        } else {
            $paragraph[] = $line;
        }
    }
    $flush();
}

$templateData = json_decode(file_get_contents(__DIR__ . '/../content/A1/templates.json'), true);
$templateSource = base64_encode(json_encode($templateData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
?>

<?php require_once __DIR__ . '/../scripts/range_guide.php'; render_guide_pager('A1Guide'); ?>
<div class="guide-intro">
    <p class="guide-kicker">Ascension 1 · R40–R99</p>
    <p>A1 production routes, Dragon progression, research builds, Mercenary support builds, and the complete game-import template bundle.</p>
    <nav class="guide-jump" aria-label="A1 guide sections">
        <a href="#plot">Plot</a>
        <a href="#progression-ranges">Reincarnation ranges</a>
    </nav>
</div>

<section class="guide-section" id="plot">
    <div class="guide-section-heading">
        <div><span>Overview</span><h2>Ascension 1 progression plot</h2></div>
        <a href="/realm/content/A1/a1plot.png" target="_blank">Open full size</a>
    </div>
    <figure class="progression-plot">
        <a href="/realm/content/A1/a1plot.png" target="_blank"><img src="/realm/content/A1/a1plot.png" alt="Ascension 1 production guide chart showing recommended factions and bloodlines from R40 through R99, gem ranges, Dragon progression, trophies, challenges, and research unlocks"></a>
        <figcaption>Recommended production route across Ascension 1. The lower notes mark important unlocks, trophies, and goals before A2.</figcaption>
    </figure>
</section>

<?php require_once __DIR__ . '/../scripts/range_guide.php'; render_ascension_routes('A1'); include "../scripts/footer.html"; return; ?>

<section class="guide-section" id="build-index">
    <div class="guide-section-heading"><div><span><?php echo count($templateData['research']) + count($templateData['mercenary']); ?> copy-ready entries</span><h2>A1 build index</h2></div><a href="/realm/content/A1/templates.json">Build source</a></div>
    <?php guide_filter('a1-build-filter', 'Filter A1 builds', 'Try R65, Dragon, production, buff…', '#a1-build-groups'); ?>
</section>
<div id="a1-build-groups">
<section class="guide-build-group" id="research-builds">
    <header><div><span><?php echo count($templateData['research']); ?> templates</span><h3>A1 research builds</h3></div></header>
    <aside class="build-info" aria-labelledby="a1-notation-title">
        <strong id="a1-notation-title">Build notation</strong>
        <p>Bloodline and faction abbreviations precede the purpose in each label. For example, <code>DNGB</code> means Dwarfline Goblin. Remove range-specific templates after leaving their listed reincarnation range; milestone reminders remain in the progression notes and plot.</p>
    </aside>
    <div class="guide-build-entries" id="a1-research-list">
    <?php foreach ($templateData['research'] as $build) { ?>
        <?php guide_compact_build($build['text'], guide_build_type($build['text']), $build['tp'], array(), '', '', 'A1 community compilation (ensteffahn, tonberry pancakes, draig121)', '4.3.11'); ?>
    <?php } ?>
    </div>
</section>

<section class="guide-build-group" id="mercenary-builds">
    <header><div><span><?php echo count($templateData['mercenary']); ?> templates</span><h3>A1 Mercenary and support builds</h3></div></header>
    <div class="guide-build-entries" id="a1-merc-list">
    <?php foreach ($templateData['mercenary'] as $build) { ?>
        <?php guide_compact_build($build['text'], guide_build_type($build['text']), $build['tp'], array(), '', '', 'A1 community compilation (ensteffahn, tonberry pancakes, draig121)', '4.3.11'); ?>
    <?php } ?>
    </div>
</section>
</div>

<section class="guide-section" id="templates">
    <div class="guide-section-heading"><div><span>Game import</span><h2>Complete A1 template bundle</h2></div></div>
    <p>Copy this single import string to add the complete research and Mercenary template set to the game.</p>
    <div class="template-import">
        <textarea id="a1-template-source" readonly aria-label="Complete A1 template import string"><?php echo htmlspecialchars($templateSource); ?></textarea>
        <button type="button" class="copy-template" data-template-target="a1-template-source">Copy complete template bundle</button>
    </div>
</section>

<section class="guide-section source-notes" id="progression-notes">
    <div class="guide-section-heading"><div><span>Community source</span><h2>A1 progression and build notes</h2></div><a href="/realm/content/A1/research-notes.txt">Plain-text source</a></div>
    <details class="guide-reference-details"><summary>Open the complete progression notes</summary><div class="source-notes-body guide-detail-source"><?php render_a1_notes(__DIR__ . '/../content/A1/research-notes.txt'); ?></div></details>
</section>

<section class="guide-section source-notes" id="offline-mechanics">
    <div class="guide-section-heading"><div><span>Background reading</span><h2>Offline spell activity mechanics</h2></div><a href="/realm/content/A1/offline-notes.txt">Plain-text source</a></div>
    <details class="guide-reference-details"><summary>Open the offline-mechanics reference</summary><div class="source-notes-body guide-detail-source"><?php render_a1_notes(__DIR__ . '/../content/A1/offline-notes.txt'); ?></div></details>
</section>

<?php include "../scripts/footer.html"; ?>
