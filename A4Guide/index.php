<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
function a4_inline($text) {
    $text = preg_replace('/\\\\([>+\-=.!*()#~\[\]])/', '$1', trim($text));
    $text = preg_replace('/\[([^\]]+)\]\(\)/', '$1', $text);
    $text = str_replace(array('**', '~~', '*'), '', $text);
    return htmlspecialchars($text);
}

function a4_research_code($line) {
    if (preg_match('/((?:S\d+)(?:,\s*[SCDEAWF]\d+){2,})/', trim($line), $match)) {
        return rtrim($match[1], ',');
    }
    return null;
}

function render_a4_reference($source) {
    $lines = preg_split('/\R/', $source);
    $paragraph = array();
    $flush = function () use (&$paragraph) {
        if (!$paragraph) return;
        echo '<p>' . implode('<br>', array_map('a4_inline', $paragraph)) . '</p>';
        $paragraph = array();
    };

    foreach ($lines as $rawLine) {
        $line = trim($rawLine);
        if ($line === '') { $flush(); continue; }
        if ($line === '# README' || $line === '# Progression and Unlock Builds (R220-R279)' || strpos($line, '**x²Progression') === 0) continue;

        if (preg_match('/^\\\\##\s+(.*?)(?:\s+\{#.*\})?$/', $line, $match)) {
            $flush();
            echo '<h3>' . a4_inline($match[1]) . '</h3>';
            continue;
        }

        if (preg_match('/^#\s+(?:\*\*)?(.*?)(?:\*\*)?\s*$/', $line, $match)) {
            $flush();
            echo '<h2>' . a4_inline($match[1]) . '</h2>';
            continue;
        }
        if (preg_match('/^\*\*(.+?)\*\*\s*$/', $line, $match)) {
            $flush();
            $label = a4_inline($match[1]);
            if (strpos($match[1], 'README') === 0 || strpos($match[1], 'x²Progression') === 0) {
                echo '<p class="build-metadata">' . $label . '</p>';
            } else {
                echo '<h3>' . $label . '</h3>';
            }
            continue;
        }
        if (preg_match('/^\s*[-*]\s+(.*)$/', $rawLine, $match)) {
            $flush();
            echo '<p class="guide-bullet">' . a4_inline($match[1]) . '</p>';
            continue;
        }

        $code = a4_research_code($line);
        if ($code !== null) {
            $flush();
            $prefix = trim(substr($line, 0, max(0, strpos($line, $code))));
            echo '<div class="source-build-code">';
            if ($prefix !== '') echo '<span>' . a4_inline($prefix) . '</span>';
            echo '<code>' . htmlspecialchars($code) . '</code>';
            echo '<button type="button" data-copy-build="' . htmlspecialchars($code, ENT_QUOTES) . '">Copy</button></div>';
            continue;
        }

        if (preg_match('/^(Author|Original Author|Faction|Bloodline|Requirements?|Requirement|Range|Alignment|Set|Legacy|Lineage):\s*(.*)$/i', $line, $match)) {
            $flush();
            echo '<p class="build-metadata"><strong>' . a4_inline($match[1]) . ':</strong> ' . a4_inline($match[2]) . '</p>';
            continue;
        }
        $paragraph[] = $line;
    }
    $flush();
}

$a4SourcePath = __DIR__ . '/../content/A4/a4-builds-v4.3.11.md';
$a4FullSource = file_get_contents($a4SourcePath);
$a4Parts = preg_split('/^# Archived Full Builds List.*$/m', $a4FullSource, 2);
$a4CurrentSource = $a4Parts[0];
preg_match_all('/((?:S\d+)(?:,\s*[SCDEAWF]\d+){2,})/', $a4CurrentSource, $a4Codes);
$a4BuildCount = count(array_unique(array_map(function ($code) { return rtrim($code, ','); }, $a4Codes[1])));
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 4 · R220+</p>
    <p>Current progression, unlock, production, buff, and endgame builds for Ascension 4, plus a compact reference for every A4 research-budget source.</p>
    <nav class="guide-jump" aria-label="A4 guide sections">
        <a href="#source-status">Source status</a>
        <a href="#research-budget">Research budget</a>
        <a href="#a4-builds">Builds</a>
    </nav>
</div>

<section class="guide-section" id="source-status">
    <div class="guide-section-heading"><div><span>Version and coverage</span><h2>A4 source status</h2></div></div>
    <aside class="build-info" aria-labelledby="a4-version-title">
        <strong id="a4-version-title">Build source: v4.3.11</strong>
        <p>The supplied community document was updated May 5, 2026 and covers progression through R279 plus post-completion buff builds. This page exposes <?php echo $a4BuildCount; ?> distinct research strings with one-click copy controls.</p>
    </aside>
    <p class="guide-coverage-note">The duplicate “Archived Full Builds List” is intentionally omitted from the rendered guide. It remains in the <a href="/realm/content/A4/a4-builds-v4.3.11.md">Markdown source</a> for historical reference.</p>
</section>

<section class="guide-section" id="research-budget">
    <div class="guide-section-heading"><div><span>Mechanics reference · 4.3</span><h2>A4 research-budget sources</h2></div><a href="/realm/content/A4/research-budget-kuile.txt">Text source</a></div>
    <p class="guide-coverage-note">Compiled by Kuile on April 16, 2025. Unless stated otherwise, alignment time is measured this Reincarnation. <code>ln</code> is the natural logarithm.</p>
    <div class="a4-budget-table-wrap"><table class="a4-budget-table">
        <thead><tr><th>Source</th><th>Research budget</th><th>Input</th></tr></thead>
        <tbody>
            <tr><td>Faction trade treaty</td><td><code>5,000</code></td><td>Base value</td></tr>
            <tr><td>Faction union</td><td><code>5,000</code></td><td>Base value</td></tr>
            <tr><td>R170 power</td><td><code>600 + 3.5 × R</code></td><td><code>R = current Reincarnation − 159</code>, including effects that increase Reincarnation count</td></tr>
            <tr><td>Standard research facility</td><td><code>500 + ln(√((1 + x)(1 + y)))³</code></td><td>Its two associated alignment times; see the table below</td></tr>
            <tr><td>Forbidden facility</td><td><code>500 + 0.75 × ln(1 + √(xy))³</code></td><td><code>x</code>: greater of Good/Evil time; <code>y</code>: greatest of Order/Chaos/Balance time</td></tr>
            <tr><td>Archon Bloodline</td><td><code>ln(1 + x)³</code></td><td><code>x</code>: time spent this Era</td></tr>
            <tr><td>Goblin Lineage Perk 6</td><td><code>4√x</code>, capped at 3,000</td><td><code>x</code>: Tax Collection worth in seconds</td></tr>
            <tr><td>Dwarf Lineage Perk 6</td><td><code>0.6 × x<sup>0.6</sup></code>, capped at 3,000</td><td><code>x</code>: excavation depth</td></tr>
            <tr><td>Faceless Set 2</td><td><code>ln(1 + x)<sup>1.5</sup></code>, capped at 3,000</td><td><code>x</code>: faction coins found this Era</td></tr>
            <tr><td>Goblin/Undead Legacy Combo</td><td><code>50 + 1.15 × ln(1 + min(x, y))<sup>3.15</sup></code>, capped at 3,000</td><td><code>x</code>: Order time; <code>y</code>: Balance time</td></tr>
        </tbody>
    </table></div>
    <h3>Research facility alignments</h3>
    <div class="a4-facility-grid">
        <span><strong>Spellcraft</strong>Good + Chaos</span><span><strong>Craftsmanship</strong>Good + Balance</span><span><strong>Divine</strong>Good + Order</span>
        <span><strong>Economics</strong>Evil + Balance</span><span><strong>Alchemy</strong>Evil + Order</span><span><strong>Warfare</strong>Evil + Chaos</span>
    </div>
</section>

<section class="guide-section a2-guide" id="a4-builds">
    <div class="guide-section-heading"><div><span>Maintained guide · v4.3.11</span><h2>A4 progression and endgame builds</h2></div><a href="/realm/content/A4/a4-builds-v4.3.11.md">Markdown source</a></div>
    <div class="a2-guide-body a4-guide-body"><?php render_a4_reference($a4CurrentSource); ?></div>
</section>

<script>
document.addEventListener('click', function (event) {
    var button = event.target.closest('[data-copy-build]');
    if (!button) return;
    var value = button.getAttribute('data-copy-build');
    function legacyCopy() {
        var field = document.createElement('textarea');
        field.value = value;
        field.setAttribute('readonly', '');
        field.style.position = 'fixed';
        field.style.opacity = '0';
        document.body.appendChild(field);
        field.select();
        document.execCommand('copy');
        field.remove();
    }
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(value).catch(legacyCopy);
    } else {
        legacyCopy();
    }
    button.textContent = 'Copied';
    window.setTimeout(function () { button.textContent = 'Copy'; }, 1200);
});
</script>

<?php include "../scripts/footer.html"; ?>
