<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
require_once __DIR__ . '/../scripts/guide_components.php';
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

function a4_extract_builds($source) {
    $builds = array();
    $current = null;
    $category = 'Build';
    $flush = function () use (&$builds, &$current) {
        if ($current && $current['codes']) $builds[] = $current;
        $current = null;
    };
    foreach (preg_split('/\R/', $source) as $rawLine) {
        $line = trim($rawLine);
        if (preg_match('/^#\s+(?:\*\*)?(.*?)(?:\*\*)?\s*$/', $line, $section)) {
            $flush();
            $category = guide_section_type($section[1], $category);
            continue;
        }
        if (preg_match('/^\*\*(.+?)\*\*\s*$/', $line, $heading) || preg_match('/^\\##\s+(.+?)(?:\s+\{#.*\})?$/', $line, $heading)) {
            $flush();
            $current = array('name' => trim(str_replace(array('~~', '\\'), '', $heading[1])), 'type' => $category, 'facts' => array(), 'codes' => array());
            continue;
        }
        if (!$current) continue;
        if (preg_match('/^(Author|Authors|Original Author|Range|Faction|Bloodline|Lineage|Set|Requirements?|Requirement):\s*(.*)$/i', $line, $fact)) {
            $label = strtolower($fact[1]);
            if ($label === 'author' || $label === 'authors' || $label === 'original author') $label = 'Author';
            else $label = ucfirst(rtrim($label, 's'));
            $value = trim($fact[2]);
            if ($label === 'Author' && preg_match('/^(.*?),?\s+(?:updated(?: for [^ ]+)?|modified) by\s+(.+)$/i', $value, $credit)) {
                $current['facts']['Author'] = trim($credit[1], ', ');
                $current['facts']['Updated by'] = trim($credit[2]);
            } else $current['facts'][$label] = $value;
        }
        $code = a4_research_code($line);
        if ($code !== null && !in_array($code, $current['codes'], true)) $current['codes'][] = $code;
    }
    $flush();
    return $builds;
}

function render_a4_build_index($builds) {
    foreach ($builds as $build) {
        $type = guide_build_type($build['name']);
        if ($type === 'Build') $type = $build['type'];
        $factLabels = array('Range', 'Faction', 'Bloodline', 'Lineage', 'Set', 'Requirement');
        $hasFacts = false;
        foreach ($factLabels as $label) if (!empty($build['facts'][$label])) $hasFacts = true;
        $summary = array();
        foreach (array('Range', 'Faction', 'Bloodline') as $label) if (!empty($build['facts'][$label])) $summary[] = $build['facts'][$label];
        echo '<details class="guide-build-entry" data-guide-entry><summary><span class="guide-build-summary-main"><strong>' . a4_inline($build['name']) . '</strong><span class="guide-entry-type">' . htmlspecialchars($type) . '</span></span>';
        if ($summary) echo '<span class="guide-build-summary-meta">' . a4_inline(implode(' · ', $summary)) . '</span>';
        echo '</summary><div class="guide-build-entry-body"><dl class="build-facts">';
        foreach ($factLabels as $label) {
            if (!empty($build['facts'][$label])) echo '<div><dt>' . htmlspecialchars($label) . '</dt><dd>' . a4_inline($build['facts'][$label]) . '</dd></div>';
        }
        echo '</dl>';
        echo '<div class="guide-build-configs">';
        foreach ($build['codes'] as $code) echo '<div class="source-build-code"><code>' . htmlspecialchars($code) . '</code><button type="button" data-copy-build="' . htmlspecialchars($code, ENT_QUOTES) . '">Copy</button></div>';
        echo '</div>';
        guide_credit(isset($build['facts']['Author']) ? $build['facts']['Author'] : '', isset($build['facts']['Updated by']) ? $build['facts']['Updated by'] : '', 'A4 community build document', '4.3.11');
        echo '</div></details>';
    }
}

$a4SourcePath = __DIR__ . '/../content/A4/a4-builds-v4.3.11.md';
$a4FullSource = file_get_contents($a4SourcePath);
$a4Parts = preg_split('/^# Archived Full Builds List.*$/m', $a4FullSource, 2);
$a4CurrentSource = $a4Parts[0];
$a4CurrentSource = preg_replace('/\A.*?^# Progression and Unlock Builds \(R220-R279\)\s*$/ms', '', $a4CurrentSource);
preg_match_all('/((?:S\d+)(?:,\s*[SCDEAWF]\d+){2,})/', $a4CurrentSource, $a4Codes);
$a4BuildCount = count(array_unique(array_map(function ($code) { return rtrim($code, ','); }, $a4Codes[1])));
$a4Builds = a4_extract_builds($a4CurrentSource);
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 4 · R220+</p>
    <p>Current progression, unlock, production, buff, and endgame builds for Ascension 4, plus a compact reference for every A4 research-budget source.</p>
    <nav class="guide-jump" aria-label="A4 guide sections">
        <a href="#research-budget">Research budget</a>
        <a href="#progression-ranges">Reincarnation ranges</a>
    </nav>
</div>

<section class="guide-section guide-source-note">
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

<?php require_once __DIR__ . '/../scripts/range_guide.php'; render_ascension_routes('A4'); include "../scripts/footer.html"; return; ?>

<section class="guide-section" id="build-index">
    <div class="guide-section-heading"><div><span><?php echo count($a4Builds); ?> structured entries · <?php echo $a4BuildCount; ?> distinct research strings</span><h2>A4 build lookup</h2></div></div>
    <?php guide_filter('a4-build-filter', 'Filter A4 builds', 'Try R255, excavations, Fairy, buff…', '#a4-build-index'); ?>
    <div class="guide-build-entries" id="a4-build-index"><?php render_a4_build_index($a4Builds); ?></div>
</section>

<section class="guide-section a2-guide" id="a4-builds">
    <div class="guide-section-heading"><div><span>Maintained guide · v4.3.11</span><h2>A4 progression and endgame builds</h2></div><a href="/realm/content/A4/a4-builds-v4.3.11.md">Markdown source</a></div>
    <details class="guide-reference-details"><summary>Open the complete progression and execution notes</summary><div class="a2-guide-body a4-guide-body guide-detail-source"><?php render_a4_reference($a4CurrentSource); ?></div></details>
</section>

<?php include "../scripts/footer.html"; ?>
