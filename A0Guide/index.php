<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
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

$templateSource = trim(file_get_contents(__DIR__ . '/../content/A0/templates.txt'));
$buildData = require __DIR__ . '/../content/A0/builds.php';
?>

<div class="guide-intro">
    <p class="guide-kicker">Pre-Ascension · R0–R39</p>
    <p>A current community progression route for Ascension 0. Use the plot for orientation, the walkthrough for unlock order, and the build index for importable templates.</p>
    <nav class="guide-jump" aria-label="A0 guide sections">
        <a href="#plot">Plot</a>
        <a href="#builds">Builds</a>
        <a href="#templates">Template import</a>
        <a href="#r0-walkthrough">R0 walkthrough</a>
        <a href="#a0-walkthrough">R1–R39 walkthrough</a>
    </nav>
</div>

<section class="guide-section" id="plot">
    <div class="guide-section-heading">
        <div><span>Overview</span><h2>Ascension 0 progression plot</h2></div>
        <a href="/realm/content/A0/a0plot.png" target="_blank">Open full size</a>
    </div>
    <figure class="progression-plot">
        <a href="/realm/content/A0/a0plot.png" target="_blank"><img src="/realm/content/A0/a0plot.png" alt="Pre-Ascension production guide chart showing recommended factions and builds from R0 through R39, gem ranges, trophies, challenges, artifacts, and offline-time goals"></a>
        <figcaption>Recommended production route by reincarnation and gem range. Stripes indicate Dwarf or Drow prestige factions. Plot supplied for game version 4.3.11.</figcaption>
    </figure>
</section>

<section class="guide-section" id="builds">
    <div class="guide-section-heading">
        <div><span>Copy-ready</span><h2>A0 builds</h2></div>
    </div>
    <div class="build-notes">
        <article><h3>Mana Fairies <small>1e33–1e72 gems</small></h3><p><b>Authors:</b> krobbi, ensteffahn · Good Mercenary · Faceless bloodline at R7+</p><p>Use the low-gem version for a quick setup. The high-gem version trades setup ease for production.</p></article>
        <article><h3>Necro Lightning <small>1e60–1e72 gems</small></h3><p><b>Author:</b> MinimumGateway · Neutral Mercenary · Fairy bloodline</p><p>Requires at least five minutes offline this R. Around 1e60 gems, run the Evil Buildings Buff build for about one minute. Wait for Lightning Strike to target Farms or Inns before casting the combo.</p></article>
    </div>

    <h3 class="build-group-title">Mercenary and trophy builds</h3>
    <div class="build-card-grid">
    <?php foreach ($buildData['mercenary'] as $build) { ?>
        <article class="build-card">
            <h4><?php echo htmlspecialchars($build[0]); ?></h4>
            <p><?php echo htmlspecialchars($build[1]); ?></p>
            <div class="build-code"><code><?php echo htmlspecialchars($build[2]); ?></code><button type="button" class="copy-build" data-build="<?php echo htmlspecialchars($build[2]); ?>">Copy</button></div>
        </article>
    <?php } ?>
    </div>

    <h3 class="build-group-title">Research production builds</h3>
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
    <div class="research-build-list">
    <?php foreach ($buildData['research'] as $build) { ?>
        <article class="research-build-row">
            <h4><?php echo htmlspecialchars($build[0]); ?></h4>
            <code><?php echo htmlspecialchars($build[1]); ?></code>
            <button type="button" class="copy-build" data-build="<?php echo htmlspecialchars($build[1]); ?>">Copy</button>
        </article>
    <?php } ?>
    </div>
</section>

<section class="guide-section" id="templates">
    <div class="guide-section-heading"><div><span>Game import</span><h2>Complete A0 template bundle</h2></div></div>
    <p>This single import contains every research and Mercenary template listed above. Copy it and use the game's template import.</p>
    <div class="template-import">
        <textarea id="a0-template-source" readonly aria-label="Complete A0 template import string"><?php echo htmlspecialchars($templateSource); ?></textarea>
        <button type="button" class="copy-template">Copy complete template bundle</button>
    </div>
</section>

<section class="guide-section walkthrough" id="r0-walkthrough">
    <div class="guide-section-heading"><div><span>First reincarnation</span><h2>R0 walkthrough</h2></div><a href="/realm/content/A0/r0-guide.txt">Plain-text source</a></div>
    <?php render_guide_text(__DIR__ . '/../content/A0/r0-guide.txt'); ?>
</section>

<section class="guide-section walkthrough" id="a0-walkthrough">
    <div class="guide-section-heading"><div><span>Full Ascension 0 route</span><h2>R1–R39 walkthrough</h2></div><a href="/realm/content/A0/a0-guide.txt">Plain-text source</a></div>
    <?php render_guide_text(__DIR__ . '/../content/A0/a0-guide.txt'); ?>
</section>

<script>
document.addEventListener('click', function (event) {
    var button = event.target.closest('.copy-build, .copy-template');
    if (!button) return;
    var value = button.classList.contains('copy-template')
        ? document.getElementById('a0-template-source').value
        : button.getAttribute('data-build');
    navigator.clipboard.writeText(value).then(function () {
        var original = button.textContent;
        button.textContent = 'Copied';
        window.setTimeout(function () { button.textContent = original; }, 1200);
    });
});
</script>

<?php include "../scripts/footer.html"; ?>
