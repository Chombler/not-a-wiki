<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
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

$templateSource = trim(file_get_contents(__DIR__ . '/../content/A1/templates.txt'));
$templateData = json_decode(base64_decode($templateSource), true);
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 1 · R40–R99</p>
    <p>A1 production routes, Dragon progression, research builds, Mercenary support builds, and the complete game-import template bundle.</p>
    <nav class="guide-jump" aria-label="A1 guide sections">
        <a href="#plot">Plot</a>
        <a href="#research-builds">Research builds</a>
        <a href="#mercenary-builds">Mercenary builds</a>
        <a href="#templates">Template import</a>
        <a href="#progression-notes">Progression notes</a>
        <a href="#offline-mechanics">Offline mechanics</a>
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

<section class="guide-section" id="research-builds">
    <div class="guide-section-heading">
        <div><span><?php echo count($templateData['research']); ?> templates</span><h2>A1 research builds</h2></div>
    </div>
    <aside class="build-info" aria-labelledby="a1-notation-title">
        <strong id="a1-notation-title">Build notation</strong>
        <p>Bloodline and faction abbreviations precede the purpose in each label. For example, <code>DNGB</code> means Dwarfline Goblin. Rows marked as notes contain progression reminders rather than complete builds.</p>
    </aside>
    <label class="build-filter-label" for="a1-build-filter">Filter research builds</label>
    <input class="build-filter" id="a1-build-filter" type="search" placeholder="Try R65, Dragon, production…" autocomplete="off">
    <div class="research-build-list" id="a1-research-list">
    <?php foreach ($templateData['research'] as $build) { ?>
        <article class="research-build-row" data-build-row>
            <h4><?php echo htmlspecialchars($build['text']); ?></h4>
            <code><?php echo htmlspecialchars($build['tp']); ?></code>
            <button type="button" class="copy-build" data-build="<?php echo htmlspecialchars($build['tp']); ?>">Copy</button>
        </article>
    <?php } ?>
    </div>
</section>

<section class="guide-section" id="mercenary-builds">
    <div class="guide-section-heading">
        <div><span><?php echo count($templateData['mercenary']); ?> templates</span><h2>A1 Mercenary and support builds</h2></div>
    </div>
    <div class="build-card-grid">
    <?php foreach ($templateData['mercenary'] as $build) { ?>
        <article class="build-card">
            <h4><?php echo htmlspecialchars($build['text']); ?></h4>
            <div class="build-code"><code><?php echo htmlspecialchars($build['tp']); ?></code><button type="button" class="copy-build" data-build="<?php echo htmlspecialchars($build['tp']); ?>">Copy</button></div>
        </article>
    <?php } ?>
    </div>
</section>

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
    <div class="source-notes-body">
        <?php render_a1_notes(__DIR__ . '/../content/A1/research-notes.txt'); ?>
    </div>
</section>

<section class="guide-section source-notes" id="offline-mechanics">
    <div class="guide-section-heading"><div><span>Background reading</span><h2>Offline spell activity mechanics</h2></div><a href="/realm/content/A1/offline-notes.txt">Plain-text source</a></div>
    <div class="source-notes-body">
        <?php render_a1_notes(__DIR__ . '/../content/A1/offline-notes.txt'); ?>
    </div>
</section>

<script>
document.addEventListener('click', function (event) {
    var button = event.target.closest('.copy-build, .copy-template');
    if (!button) return;
    var target = button.getAttribute('data-template-target');
    var value = target ? document.getElementById(target).value : button.getAttribute('data-build');
    navigator.clipboard.writeText(value).then(function () {
        var original = button.textContent;
        button.textContent = 'Copied';
        window.setTimeout(function () { button.textContent = original; }, 1200);
    });
});

document.getElementById('a1-build-filter').addEventListener('input', function (event) {
    var query = event.target.value.toLowerCase().trim();
    document.querySelectorAll('[data-build-row]').forEach(function (row) {
        row.hidden = query && row.textContent.toLowerCase().indexOf(query) === -1;
    });
});
</script>

<?php include "../scripts/footer.html"; ?>
