<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
require_once __DIR__ . '/../scripts/guide_components.php';
function a3_inline($text) {
    $text = str_replace('\\*', '×', trim($text));
    $text = preg_replace('/\\\\([>+\-=.!*()#~\[\]])/', '$1', $text);
    $parts = preg_split('/(\[[^\]]+\]\(https?:\/\/[^)]+\))/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
    $output = '';
    foreach ($parts as $part) {
        if (preg_match('/^\[([^\]]+)\]\((https?:\/\/[^)]+)\)$/', $part, $match)) {
            $output .= '<a href="' . htmlspecialchars($match[2]) . '" target="_blank" rel="noopener">' . htmlspecialchars($match[1]) . '</a>';
        } else {
            $part = preg_replace('/\[([^\]]+)\]\(\)/', '$1', $part);
            $part = str_replace(array('**', '~~', '*'), '', $part);
            $output .= htmlspecialchars($part);
        }
    }
    return $output;
}

function a3_copy_code($line) {
    if (preg_match('/((?:S\d+)(?:,\s*[SCDEAWF]\d+){1,})/', $line, $match)) return rtrim($match[1], ',');
    if (strpos($line, 'SP:') !== false && substr_count($line, ',') >= 5) return rtrim(trim($line), ',');
    return null;
}

function render_a3_reference($path) {
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    $paragraph = array();
    $flush = function () use (&$paragraph) {
        if (!$paragraph) return;
        echo '<p>' . implode('<br>', array_map('a3_inline', $paragraph)) . '</p>';
        $paragraph = array();
    };

    foreach ($lines as $rawLine) {
        $line = trim($rawLine);
        if ($line === '') { $flush(); continue; }
        if ($line === '---') { $flush(); echo '<hr>'; continue; }
        if ($line === '# Landing Page') continue;
        if (strpos($line, '**Link for the A3 plot') === 0 || strpos($line, '**Link for patch 4.3') === 0 || strpos($line, '**The builds are split') === 0) continue;

        if (preg_match('/^(#{1,3})\s+(?:\*\*)?(.*?)(?:\*\*)?\s*$/', $line, $match)) {
            $flush();
            $level = strlen($match[1]) === 1 ? 2 : 3;
            echo '<h' . $level . '>' . a3_inline($match[2]) . '</h' . $level . '>';
            continue;
        }
        if (preg_match('/^\*\*(.+?)\*\*\s*(.*)$/', $line, $match)) {
            $flush();
            echo '<h3>' . a3_inline($match[1]) . '</h3>';
            if (trim($match[2]) !== '') echo '<p>' . a3_inline($match[2]) . '</p>';
            continue;
        }
        if (preg_match('/^\s*[-*]\s+(.*)$/', $rawLine, $match)) {
            $flush();
            echo '<p class="guide-bullet">' . a3_inline($match[1]) . '</p>';
            continue;
        }

        $code = a3_copy_code($line);
        if ($code !== null) {
            $flush();
            $prefix = trim(substr($line, 0, max(0, strpos($line, $code))));
            echo '<div class="source-build-code">';
            if ($prefix !== '') echo '<span>' . a3_inline($prefix) . '</span>';
            echo '<code>' . htmlspecialchars($code) . '</code>';
            echo '<button type="button" data-copy-build="' . htmlspecialchars($code, ENT_QUOTES) . '">Copy</button></div>';
            continue;
        }
        if (preg_match('/^(Author|Range|Faction|Bloodline|Set|Stoneheart|Requirements?|Alignment):\s*(.*)$/i', $line, $match)) {
            $flush();
            echo '<p class="build-metadata"><strong>' . a3_inline($match[1]) . ':</strong> ' . a3_inline($match[2]) . '</p>';
            continue;
        }
        $paragraph[] = $line;
    }
    $flush();
}

function a3_extract_builds($source) {
    $builds = array();
    $current = null;
    $category = 'Build';
    $flush = function () use (&$builds, &$current) {
        if (!$current) return;
        if ($current['codes'] || isset($current['facts']['Faction']) || isset($current['facts']['Author'])) $builds[] = $current;
        $current = null;
    };
    foreach (preg_split('/\R/', $source) as $rawLine) {
        $line = trim($rawLine);
        if (preg_match('/^#{1,3}\s+(?:\*\*)?(.*?)(?:\*\*)?\s*$/', $line, $heading)) {
            $flush();
            $name = trim(str_replace(array('**', '\\'), '', $heading[1]));
            $category = guide_section_type($name, $category);
            $current = array('name' => $name, 'type' => $category, 'facts' => array(), 'codes' => array());
            continue;
        }
        if (!$current) continue;
        if (preg_match('/^(Author|Authors|Range|Faction|Bloodline|Lineage|Set|Stoneheart|Requirement|Requirements):\s*(.*)$/i', $line, $fact)) {
            $label = ucfirst(strtolower($fact[1]));
            if ($label === 'Authors') $label = 'Author';
            if ($label === 'Requirements') $label = 'Requirement';
            $value = trim($fact[2]);
            if ($label === 'Author' && preg_match('/^(.*?),?\s+Modified by\s+(.+)$/i', $value, $credit)) {
                $current['facts']['Author'] = trim($credit[1], ', ');
                $current['facts']['Updated by'] = trim($credit[2]);
            } else $current['facts'][$label] = $value;
        }
        $code = a3_copy_code($line);
        if ($code !== null && !in_array($code, $current['codes'], true)) $current['codes'][] = $code;
    }
    $flush();
    return $builds;
}

function render_a3_build_index($builds) {
    foreach ($builds as $build) {
        $type = guide_build_type($build['name']);
        if ($type === 'Build') $type = $build['type'];
        $factLabels = array('Range', 'Faction', 'Bloodline', 'Lineage', 'Set', 'Stoneheart', 'Requirement');
        $hasFacts = false;
        foreach ($factLabels as $label) if (!empty($build['facts'][$label])) $hasFacts = true;
        echo '<article class="guide-build-card' . ($hasFacts ? '' : ' has-no-facts') . '" data-guide-entry><h3>' . a3_inline($build['name']) . '<span class="guide-entry-type">' . htmlspecialchars($type) . '</span></h3><dl class="build-facts">';
        foreach ($factLabels as $label) {
            if (!empty($build['facts'][$label])) echo '<div><dt>' . htmlspecialchars($label) . '</dt><dd>' . a3_inline($build['facts'][$label]) . '</dd></div>';
        }
        echo '</dl>';
        echo '<div class="guide-build-configs">';
        foreach ($build['codes'] as $code) echo '<div class="source-build-code"><code>' . htmlspecialchars($code) . '</code><button type="button" data-copy-build="' . htmlspecialchars($code, ENT_QUOTES) . '">Copy</button></div>';
        echo '</div>';
        guide_credit(isset($build['facts']['Author']) ? $build['facts']['Author'] : '', isset($build['facts']['Updated by']) ? $build['facts']['Updated by'] : '', 'A3 community build document', '4.3.11');
        echo '</article>';
    }
}

$a3SourcePath = __DIR__ . '/../content/A3/a3-reference-v4.3.11.md';
$a3Source = file_get_contents($a3SourcePath);
$a3CopyCount = 0;
foreach (preg_split('/\R/', $a3Source) as $a3SourceLine) {
    if (a3_copy_code(trim($a3SourceLine)) !== null) $a3CopyCount++;
}
$a3Builds = a3_extract_builds($a3Source);
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 3 · R160–R219</p>
    <p>Complete A3 progression reference covering production builds, research budget, unlocks, artifacts, trophies, buff builds, and Mercenary challenges.</p>
    <nav class="guide-jump" aria-label="A3 guide sections">
        <a href="#source-status">Source status</a>
        <a href="#progression-overview">Overview</a>
        <a href="#research-budget">Research budget</a>
        <a href="#build-index">Build lookup</a>
        <a href="#a3-reference">Progression guide</a>
    </nav>
</div>

<?php guide_view_switcher('a3'); ?>

<?php guide_source_status('4.3.11', 'R160–R219 progression, production, buffs, unlocks, artifacts, trophies, and Mercenary challenges', '/realm/content/A3/a3-reference-v4.3.11.md', 'Markdown source'); ?>

<section class="guide-section" id="progression-overview">
    <div class="guide-section-heading"><div><span>Orientation</span><h2>A3 progression overview</h2></div></div>
    <div class="a3-source-links">
        <a href="https://i.imgur.com/KOmAgQO.png" target="_blank" rel="noopener"><strong>A3 plot</strong><span>Partially outdated; check gem ranges</span></a>
        <a href="https://docs.google.com/document/d/1xVXiP3R2WtRH9gwUfoo8mkKiYuQQgg8W8J6eMFcDNeQ/edit?tab=t.0" target="_blank" rel="noopener"><strong>Patch 4.3 notes</strong><span>External Google document</span></a>
    </div>
    <p class="guide-coverage-note">Use the build index for lookup and copying. The full guide contains the milestone roadmap, research-budget rules, setup order, and gameplay notes.</p>
</section>

<section class="guide-section" id="research-budget">
    <div class="guide-section-heading"><div><span>Mechanics reference · 4.3.11</span><h2>A3 research-budget sources</h2></div><a href="/realm/content/A3/a3-reference-v4.3.11.md">Markdown source</a></div>
    <div class="a4-budget-table-wrap"><table class="a4-budget-table">
        <thead><tr><th>Source</th><th>Research budget</th><th>Notes</th></tr></thead>
        <tbody>
            <tr><td>R170 power</td><td><code>450 + 3.5 × R</code></td><td><code>R = current Reincarnation − 159</code>; increased Reincarnation-count effects apply after subtraction</td></tr>
            <tr><td>First Mercenary contract</td><td><code>500</code> per branch</td><td>Base contract budget</td></tr>
            <tr><td>Fourth Mercenary contract</td><td><code>1,000</code> per branch</td><td>Additional contract budget</td></tr>
            <tr><td>Chosen Mercenary spell</td><td><code>1,000 + 5√x</code>, capped at 5,000</td><td><code>x</code>: chosen spell activity time; split across affiliated facilities when necessary</td></tr>
            <tr><td>Faction union</td><td><code>400 × x</code></td><td><code>x</code>: upgrades owned for the associated faction; prestige unions split the result across their branches</td></tr>
            <tr><td>Research facility artifact</td><td><code>500 + ln(√((1 + x)(1 + y)))³</code></td><td><code>x</code> and <code>y</code>: the facility faction’s two alignment times this Reincarnation</td></tr>
            <tr><td>Forbidden facility artifact</td><td><code>500 + 0.75 × ln(1 + √(xy))³</code></td><td><code>x</code>: greater of Good/Evil time; <code>y</code>: greatest of Order/Chaos/Balance time</td></tr>
            <tr><td>Archon Bloodline</td><td><code>ln(1 + x)³</code></td><td><code>x</code>: time spent this Era</td></tr>
            <tr><td>Goblin Lineage Perk 6</td><td><code>4√x</code>, capped at 3,000</td><td><code>x</code>: Tax Collection worth in seconds</td></tr>
            <tr><td>Dwarf Lineage Perk 6</td><td><code>0.6 × x<sup>0.6</sup></code>, capped at 3,000</td><td><code>x</code>: excavation depth</td></tr>
        </tbody>
    </table></div>
</section>

<section class="guide-section" id="build-index" data-guide-view-content="lookup" hidden>
    <div class="guide-section-heading"><div><span><?php echo count($a3Builds); ?> entries · <?php echo $a3CopyCount; ?> copyable strings</span><h2>A3 build lookup</h2></div></div>
    <?php guide_filter('a3-build-filter', 'Filter A3 builds', 'Try R180, trophy, Mercenary, Fairy…', '#a3-build-index'); ?>
    <div class="guide-build-index guide-build-index--long" id="a3-build-index"><?php render_a3_build_index($a3Builds); ?></div>
</section>

<section class="guide-section a2-guide" id="a3-reference" data-guide-view-content="progression">
    <div class="guide-section-heading">
        <div><span>Detailed source · v4.3.11</span><h2>A3 progression and builds</h2></div>
        <a href="/realm/content/A3/a3-reference-v4.3.11.md">Markdown source</a>
    </div>
    <div class="a2-guide-body a4-guide-body guide-detail-source"><?php render_a3_reference($a3SourcePath); ?></div>
</section>

<?php include "../scripts/footer.html"; ?>
