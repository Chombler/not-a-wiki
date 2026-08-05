<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
require_once __DIR__ . '/../scripts/guide_components.php';
function render_guide_text($path) {
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
        if (preg_match('/^PART ([0-9]+):\s*(.+)$/i', $line, $match)) {
            $flush();
            $id = 'part-' . $match[1];
            echo '<h3 id="' . $id . '">Part ' . htmlspecialchars($match[1]) . ': ' . htmlspecialchars($match[2]) . '</h3>';
        } elseif (preg_match('/^([1-4])\)\s+(.+)$/', $line, $match)) {
            $flush();
            echo '<h3>' . htmlspecialchars($match[1] . ') ' . $match[2]) . '</h3>';
        } elseif (preg_match('/^(R(?:[0-9]+(?:\+|-[0-9]+)?|s\b)[^:]*:|Unlocking Research:|Step [0-9]+:|Research Naming Convention:|How to read templates:|Speedrun Guide:|Some Trophies[^:]*:|Excavations:|OPTIONAL:)(.*)$/i', $line, $match)) {
            $flush();
            echo '<h4>' . htmlspecialchars($match[1]) . '</h4>';
            if (trim($match[2]) !== '') echo '<p>' . htmlspecialchars(trim($match[2])) . '</p>';
        } elseif (strpos($line, '- ') === 0) {
            $flush();
            echo '<p class="guide-step">' . htmlspecialchars(substr($line, 2)) . '</p>';
        } else {
            $paragraph[] = $line;
        }
    }
    $flush();
}

$buildData = json_decode(file_get_contents(__DIR__ . '/../content/A0/builds.json'), true);
$templateData = array('research' => array(), 'mercenary' => array());
foreach ($buildData['research'] as $build) $templateData['research'][] = array('text' => $build['title'], 'tp' => $build['template']);
foreach ($buildData['mercenary'] as $build) $templateData['mercenary'][] = array('text' => $build['title'], 'tp' => $build['template']);
$templateSource = base64_encode(json_encode($templateData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE));
?>

<div class="guide-intro">
    <p class="guide-kicker">Pre-Ascension · R0–R39</p>
    <p>A current community progression route for Ascension 0. Use the plot for orientation, the walkthrough for unlock order, and the build index for importable templates.</p>
    <nav class="guide-jump" aria-label="A0 guide sections">
        <a href="#source-status">Source status</a>
        <a href="#plot">Plot</a>
        <a href="#progression-ranges">Reincarnation ranges</a>
    </nav>
</div>

<?php guide_source_status('4.3.11', 'R0–R39 progression, production, trophies, research, and walkthroughs', '/realm/content/A0/a0-guide.txt', 'Progression source'); ?>

<section class="guide-section" id="plot">
    <div class="guide-section-heading">
        <div><span>Overview</span><h2>Ascension 0 progression plot</h2></div>
        <a href="/realm/content/A0/a0plot.png" target="_blank">Open full size</a>
    </div>
    <figure class="progression-plot">
        <a href="/realm/content/A0/a0plot.png" target="_blank"><img src="/realm/content/A0/a0plot.png" alt="Pre-Ascension production guide chart showing recommended factions and builds from R0 through R39, gem ranges, trophies, challenges, artifacts, and offline-time goals"></a>
        <figcaption>Recommended production route by reincarnation and gem range. Stripes indicate Dwarf or Drow prestige factions. Plot by ensteffahn for game version 4.3.11.</figcaption>
    </figure>
</section>

<?php require_once __DIR__ . '/../scripts/range_guide.php'; render_ascension_routes('A0'); include "../scripts/footer.html"; return; ?>

<section class="guide-section" id="builds">
    <div class="guide-section-heading">
        <div><span>Search and copy</span><h2>A0 build index</h2></div>
        <a href="/realm/content/A0/builds.json">Build source</a>
    </div>
    <?php guide_filter('a0-build-filter', 'Filter A0 builds', 'Try R24, production, trophy, Fairy…', '#a0-build-index'); ?>
    <div id="a0-build-index">
    <section class="guide-build-group"><header><div><span><?php echo count($buildData['mercenary']); ?> entries</span><h3>Mercenary and trophy builds</h3></div></header>
    <div class="guide-build-entries">
    <?php foreach ($buildData['mercenary'] as $build) { ?>
        <?php guide_compact_build($build['title'], $build['type'], $build['template'], array('Faction' => $build['details']), isset($build['notes']) ? $build['notes'] : '', $build['author'], 'A0 community build compilation', '4.3.11'); ?>
    <?php } ?>
    </div></section>

    <section class="guide-build-group"><header><div><span><?php echo count($buildData['research']); ?> entries</span><h3>Research production builds</h3></div></header>
    <aside class="build-info" aria-labelledby="faction-notation-title">
        <strong id="faction-notation-title">Faction notation</strong>
        <p>The first pair is the bloodline and the second is the faction. For example, <code>FCGB</code> means Faceless-line Goblin.</p>
    </aside>
    <div class="research-build-notes">
        <p><b>R22–23:</b> Going offline for one minute each era is recommended once the build slows down.</p>
        <p><b>R26–28:</b> Dwarfline Druid requires Druid Challenge 4. Produce 3.2e6 mana for Primal Balance +2 while running Mana Fairies.</p>
        <p><b>R32–35:</b> With Flame of Bondelnar, add E225, W180, and W400.</p>
        <p><b>Excavations:</b> Swap one research for E270 when excavating for Dwarven Horn or Flame of Bondelnar.</p>
    </div>
    <div class="guide-build-entries">
    <?php foreach ($buildData['research'] as $build) { ?>
        <?php guide_compact_build($build['title'], $build['type'], $build['template'], array(), '', $build['author'], 'A0 community research compilation', '4.3.11'); ?>
    <?php } ?>
    </div></section>
    </div>
</section>

<section class="guide-section" id="templates">
    <div class="guide-section-heading"><div><span>Game import</span><h2>Complete A0 template bundle</h2></div></div>
    <details class="guide-reference-details"><summary>Open the complete game-import bundle</summary><div><p>This single import contains every research and Mercenary template listed above. Copy it and use the game's template import.</p>
    <div class="template-import">
        <textarea id="a0-template-source" readonly aria-label="Complete A0 template import string"><?php echo htmlspecialchars($templateSource); ?></textarea>
        <button type="button" class="copy-template" data-template-target="a0-template-source">Copy complete template bundle</button>
    </div></div></details>
</section>

<section class="guide-section walkthrough" id="r0-walkthrough">
    <div class="guide-section-heading"><div><span>First reincarnation</span><h2>R0 walkthrough</h2></div><a href="/realm/content/A0/r0-guide.txt">Plain-text source</a></div>
    <details class="guide-reference-details"><summary>Open the complete R0 walkthrough</summary><div class="guide-detail-source"><?php render_guide_text(__DIR__ . '/../content/A0/r0-guide.txt'); ?></div></details>
</section>

<section class="guide-section walkthrough" id="a0-walkthrough">
    <div class="guide-section-heading"><div><span>Full Ascension 0 route</span><h2>R1–R39 walkthrough</h2></div><a href="/realm/content/A0/a0-guide.txt">Plain-text source</a></div>
    <details class="guide-reference-details"><summary>Open the complete R1–R39 walkthrough</summary><div class="guide-detail-source"><?php render_guide_text(__DIR__ . '/../content/A0/a0-guide.txt'); ?></div></details>
</section>

<?php include "../scripts/footer.html"; ?>
