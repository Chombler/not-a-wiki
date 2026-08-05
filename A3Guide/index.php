<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
require_once __DIR__ . '/../scripts/guide_components.php';

function a3_inline($text) {
    $text = str_replace('\*', '×', trim($text));
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
    $tokens = array_values(array_filter(array_map('trim', explode(',', trim($line))), 'strlen'));
    if (count($tokens) < 2) return null;
    foreach ($tokens as $token) {
        if (!preg_match('/^(?:[A-Z]{1,3}\d+|(?:SP|UB|UNN|MA):[^,]+)$/', $token)) return null;
    }
    return implode(',', $tokens);
}

function a3_is_research_token($token) {
    return preg_match('/^[SCDEAWF]\d+$/', $token) === 1;
}

function a3_render_configuration($code, $combined) {
    $tokens = array_values(array_filter(array_map('trim', explode(',', $code)), 'strlen'));
    $research = array_values(array_filter($tokens, 'a3_is_research_token'));
    $setup = array_values(array_filter($tokens, function ($token) { return !a3_is_research_token($token); }));
    if ($combined && $setup && $research) {
        echo '<div class="guide-combined-template">';
        echo '<div class="guide-template-segment"><strong>Mercenary upgrades and setup</strong><code>' . htmlspecialchars(implode(',', $setup)) . '</code></div>';
        echo '<div class="guide-template-segment"><strong>Researches</strong><code>' . htmlspecialchars(implode(',', $research)) . '</code></div>';
        echo '<div class="guide-template-actions"><button type="button" data-copy-build="' . htmlspecialchars(implode(',', $setup), ENT_QUOTES) . '">Copy setup</button><button type="button" data-copy-build="' . htmlspecialchars(implode(',', $research), ENT_QUOTES) . '">Copy researches</button><button type="button" data-copy-build="' . htmlspecialchars($code, ENT_QUOTES) . '">Copy full build</button></div></div>';
        return;
    }
    $label = $research && !$setup ? 'Copy researches' : 'Copy build';
    echo '<div class="source-build-code"><code>' . htmlspecialchars($code) . '</code><button type="button" data-copy-build="' . htmlspecialchars($code, ENT_QUOTES) . '">' . $label . '</button></div>';
}

function a3_heading($line) {
    if (!preg_match('/^(#{1,3})\s+(?:\*\*)?(.*?)(?:\*\*)?\s*$/', trim($line), $match)) return null;
    $name = preg_replace('/\s+\{#.*\}$/', '', $match[2]);
    $name = trim(str_replace(array('**', '\\'), '', $name));
    return array('level' => strlen($match[1]), 'name' => $name);
}

function a3_group_name($heading) {
    $name = strtolower(preg_replace('/\s+/', ' ', trim($heading)));
    if (preg_match('/r160\s*-\s*r171/', $name)) return 'R160–R171 · Early production';
    if (preg_match('/r172\s*-\s*r180/', $name)) return 'R172–R180 · Late faction production';
    if ($name === 'r181-r219' || $name === 'r181–r219') return 'R181–R219 · Mercenary production';
    if ($name === 'max buildings' || $name === 'non merc builds') return 'Specialized builds · Buildings';
    if ($name === 'clicks') return 'Specialized builds · Clicks';
    if ($name === 'spell buffing') return 'Specialized builds · Spells';
    if ($name === 'max assistants') return 'Specialized builds · Assistants';
    if ($name === 'max excavations') return 'Specialized builds · Excavations';
    if ($name === 'mercenary duel' || $name === 'mercenary duel r172') return 'Mercenary Duel';
    if ($name === 'unlock builds' || $name === 'artifacts r180/r181') return 'Unlocks, artifacts, and trophies';
    if ($name === 'challenges') return 'Mercenary challenges';
    return null;
}

function a3_extract_grouped_builds($source) {
    $groups = array();
    $currentGroup = null;
    $current = null;
    $fieldNames = 'Type|Purpose|Author|Authors|Updated by|Range|Faction|Alignment|Bloodline|Lineage|Set|Stoneheart|Duration|Requirement|Requirements|Use when|Replace when';
    $flush = function () use (&$groups, &$current, &$currentGroup) {
        if (!$current) return;
        if ($current['codes'] || $current['facts'] || $current['body']) {
            if ($currentGroup === null) $currentGroup = 'Other A3 builds';
            if (!isset($groups[$currentGroup])) $groups[$currentGroup] = array('notes' => array(), 'builds' => array());
            if ($current['codes'] || $current['facts'] || array_filter(array_map('trim', $current['body']))) {
                $current['group'] = $currentGroup;
                $groups[$currentGroup]['builds'][] = $current;
            }
        }
        $current = null;
    };

    foreach (preg_split('/\R/', $source) as $rawLine) {
        $line = trim($rawLine);
        $heading = a3_heading($line);
        if ($heading) {
            $group = a3_group_name($heading['name']);
            if ($currentGroup === 'Mercenary Duel' && in_array(strtolower($heading['name']), array('clicks', 'spells cast', 'assistants', 'faction coins', 'buildings'), true)) $group = null;
            if ($group !== null) {
                $flush();
                $currentGroup = $group;
                if (!isset($groups[$currentGroup])) $groups[$currentGroup] = array('notes' => array(), 'builds' => array());
                if (strtolower($heading['name']) === 'max excavations') {
                    $current = array('name' => $heading['name'], 'facts' => array(), 'codes' => array(), 'body' => array());
                }
                continue;
            }
            if (in_array(strtolower($heading['name']), array('landing page', 'realm grinder a3 builds for v4.3.11', 'a3 roadmap', 'research budget in a3', 'r160-r180'), true)) {
                $flush();
                continue;
            }
            if ($currentGroup === null) continue;
            $flush();
            $current = array('name' => $heading['name'], 'facts' => array(), 'codes' => array(), 'body' => array());
            continue;
        }

        if (!$current) {
            if ($currentGroup !== null && $line !== '' && $line !== '---') $groups[$currentGroup]['notes'][] = $rawLine;
            continue;
        }
        if (preg_match('/^(' . $fieldNames . '):\s*(.*)$/i', $line, $fact)) {
            $label = ucwords(strtolower($fact[1]));
            if ($label === 'Authors') $label = 'Author';
            if ($label === 'Requirements') $label = 'Requirement';
            $value = trim($fact[2]);
            if ($label === 'Author' && preg_match('/^(.*?),?\s+Modified by\s+(.+)$/i', $value, $credit)) {
                $current['facts']['Author'] = trim($credit[1], ', ');
                $current['facts']['Updated By'] = trim($credit[2]);
            } else {
                $current['facts'][$label] = $value;
            }
            continue;
        }
        $code = a3_copy_code($line);
        if ($code !== null && !in_array($code, $current['codes'], true)) $current['codes'][] = $code;
        $current['body'][] = $rawLine;
    }
    $flush();
    return $groups;
}

function a3_render_lines($lines) {
    $paragraph = array();
    $flush = function () use (&$paragraph) {
        if (!$paragraph) return;
        echo '<p>' . implode('<br>', array_map('a3_inline', $paragraph)) . '</p>';
        $paragraph = array();
    };
    $lineCount = count($lines);
    for ($index = 0; $index < $lineCount; $index++) {
        $rawLine = $lines[$index];
        $line = trim($rawLine);
        if ($line === '') { $flush(); continue; }
        if ($line === '---') { $flush(); continue; }
        if (preg_match('/^\s*[-*]\s+(.*)$/', $rawLine, $match)) {
            $flush();
            echo '<p class="guide-bullet">' . a3_inline($match[1]) . '</p>';
            continue;
        }
        $configurationHeading = null;
        if (preg_match('/^(Upgrades & Researches|Researches & Upgrades|Researches|Secondary Researches|Full Research import|Mobile)(.*?)[,:]$/i', $line)) {
            $configurationHeading = rtrim($line, ':,');
        }
        if ($configurationHeading !== null) {
            $flush();
            echo '<h4>' . a3_inline($configurationHeading) . '</h4>';
            $parts = array();
            while ($index + 1 < $lineCount) {
                $candidate = a3_copy_code(trim($lines[$index + 1]));
                if ($candidate === null) break;
                $parts[] = $candidate;
                $index++;
            }
            if ($parts) {
                $combined = preg_match('/^(?:Upgrades & Researches|Researches & Upgrades|Mobile)/i', $configurationHeading) === 1;
                a3_render_configuration(implode(',', $parts), $combined);
            }
            continue;
        }
        $code = a3_copy_code($line);
        if ($code !== null) {
            $flush();
            a3_render_configuration($code, false);
            continue;
        }
        if (preg_match('/^Variant:\s*(.+)$/i', $line, $variant)) {
            $flush();
            echo '<h4>' . a3_inline($variant[1]) . '</h4>';
            continue;
        }
        if (preg_match('/^(Gameplay Notes|Notable Buffs)(.*):$/i', $line)) {
            $flush();
            echo '<h4>' . a3_inline(rtrim($line, ':')) . '</h4>';
            continue;
        }
        $paragraph[] = $line;
    }
    $flush();
}

function a3_render_build($build) {
    $facts = $build['facts'];
    if (!empty($facts['Purpose'])) $purpose = $facts['Purpose'];
    elseif (!empty($facts['Type'])) $purpose = $facts['Type'];
    elseif (stripos($build['group'], 'production') !== false) $purpose = 'Production';
    elseif (stripos($build['group'], 'challenge') !== false || $build['group'] === 'Mercenary Duel') $purpose = 'Challenge';
    elseif (stripos($build['group'], 'unlock') !== false) $purpose = 'Unlock';
    else {
        $purpose = guide_build_type($build['name']);
        if ($purpose === 'Build' && stripos($build['group'], 'specialized') !== false) $purpose = 'Buff';
    }
    $summaryBits = array();
    foreach (array('Range', 'Faction', 'Bloodline') as $label) if (!empty($facts[$label])) $summaryBits[] = $facts[$label];
    echo '<details class="guide-build-entry" data-guide-entry><summary><span class="guide-build-summary-main"><strong>' . a3_inline($build['name']) . '</strong><span class="guide-entry-type">' . htmlspecialchars($purpose) . '</span></span>';
    if ($summaryBits) echo '<span class="guide-build-summary-meta">' . a3_inline(implode(' · ', $summaryBits)) . '</span>';
    echo '</summary><div class="guide-build-entry-body"><dl class="build-facts">';
    foreach (array('Range', 'Faction', 'Alignment', 'Bloodline', 'Lineage', 'Set', 'Stoneheart', 'Duration', 'Requirement', 'Use When', 'Replace When') as $label) {
        if (!empty($facts[$label])) echo '<div><dt>' . htmlspecialchars($label) . '</dt><dd>' . a3_inline($facts[$label]) . '</dd></div>';
    }
    echo '</dl><div class="guide-build-notes">';
    a3_render_lines($build['body']);
    echo '</div>';
    guide_credit(isset($facts['Author']) ? $facts['Author'] : '', isset($facts['Updated By']) ? $facts['Updated By'] : '', 'A3 community build document', '4.3.11');
    echo '</div></details>';
}

function a3_group_id($name) {
    return trim(preg_replace('/[^a-z0-9]+/', '-', strtolower($name)), '-');
}

function a3_section_lines($source, $startName, $endName) {
    $capturing = false;
    $lines = array();
    foreach (preg_split('/\R/', $source) as $rawLine) {
        $heading = a3_heading(trim($rawLine));
        if ($heading && strtolower($heading['name']) === strtolower($startName)) {
            $capturing = true;
            continue;
        }
        if ($capturing && $heading && strtolower($heading['name']) === strtolower($endName)) break;
        if ($capturing) $lines[] = $rawLine;
    }
    return $lines;
}

$a3SourcePath = __DIR__ . '/../content/A3/a3-reference-v4.3.11.md';
$a3Source = file_get_contents($a3SourcePath);
$a3Groups = a3_extract_grouped_builds($a3Source);
$a3RoadmapLines = a3_section_lines($a3Source, 'A3 Roadmap', 'Research budget in A3');
$a3BudgetLines = a3_section_lines($a3Source, 'Research budget in A3', 'R160-R180');
$a3BuildCount = 0;
foreach ($a3Groups as $group) $a3BuildCount += count($group['builds']);
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 3 · R160–R219</p>
    <p>A build-centered A3 reference. Start with your Reincarnation range, then open only the production route, unlock, challenge, or specialized build you need.</p>
    <nav class="guide-jump" aria-label="A3 guide sections">
        <a href="#progression-overview">Progression</a>
        <a href="#a3-builds">Builds</a>
        <a href="#research-budget">Research budget</a>
        <a href="#source-status">Source and contribution</a>
    </nav>
</div>

<section class="guide-section a3-at-a-glance" id="progression-overview">
    <div class="guide-section-heading"><div><span>Start here</span><h2>A3 progression</h2></div></div>
    <div class="guide-stage-grid">
        <a href="#r160-r171-early-production"><strong>R160–R171</strong><span>Early faction production</span></a>
        <a href="#r172-r180-late-faction-production"><strong>R172–R180</strong><span>Late faction production and Mercenary preparation</span></a>
        <a href="#r181-r219-mercenary-production"><strong>R181–R219</strong><span>Mercenary production</span></a>
        <a href="#unlocks-artifacts-and-trophies"><strong>Unlocks</strong><span>Artifacts, trophies, and research</span></a>
        <a href="#mercenary-challenges"><strong>Challenges</strong><span>Mercenary Challenge builds</span></a>
    </div>
    <aside class="guide-milestones">
        <strong>Major milestones</strong>
        <span><b>R165</b> Prestige factions</span><span><b>R172</b> Astral factions and Mercenary Duel</span><span><b>R180</b> Facility artifacts and L75 lineages</span><span><b>R190–206</b> Mercenary Challenges</span><span><b>Before A4</b> All research and required trophies</span>
    </aside>
    <details class="guide-reference-details">
        <summary>Complete milestone roadmap</summary>
        <div><?php a3_render_lines($a3RoadmapLines); ?></div>
    </details>
    <div class="a3-source-links">
        <a href="https://i.imgur.com/KOmAgQO.png" target="_blank" rel="noopener"><strong>A3 progression plot</strong><span>Partially outdated; check the guide’s gem ranges</span></a>
        <a href="https://docs.google.com/document/d/1xVXiP3R2WtRH9gwUfoo8mkKiYuQQgg8W8J6eMFcDNeQ/edit?tab=t.0" target="_blank" rel="noopener"><strong>Patch 4.3 notes</strong><span>External community document</span></a>
    </div>
</section>

<section class="guide-section" id="a3-builds">
    <div class="guide-section-heading"><div><span><?php echo $a3BuildCount; ?> maintained entries</span><h2>A3 builds</h2></div><a href="https://github.com/chombler/not-a-wiki/edit/local-4.3.15/content/A3/a3-reference-v4.3.11.md" target="_blank" rel="noopener">Edit Markdown source</a></div>
    <?php guide_filter('a3-build-filter', 'Filter A3 builds', 'Try R180, trophy, assistants, Fairy…', '#a3-build-groups'); ?>
    <div id="a3-build-groups">
    <?php foreach ($a3Groups as $groupName => $group) { if (!$group['builds']) continue; ?>
        <section class="guide-build-group">
            <header><div><span><?php echo count($group['builds']); ?> entries</span><h3 id="<?php echo htmlspecialchars(a3_group_id($groupName)); ?>"><?php echo htmlspecialchars($groupName); ?></h3></div><a href="https://github.com/chombler/not-a-wiki/edit/local-4.3.15/content/A3/a3-reference-v4.3.11.md" target="_blank" rel="noopener">Edit guide</a></header>
            <?php if ($group['notes']) { ?><div class="guide-group-note"><?php a3_render_lines($group['notes']); ?></div><?php } ?>
            <div class="guide-build-entries"><?php foreach ($group['builds'] as $build) a3_render_build($build); ?></div>
        </section>
    <?php } ?>
    </div>
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
            <tr><td>Faction union</td><td><code>400 × x</code></td><td><code>x</code>: upgrades owned for the associated faction</td></tr>
            <tr><td>Research facility artifact</td><td><code>500 + ln(√((1 + x)(1 + y)))³</code></td><td><code>x</code> and <code>y</code>: associated alignment times this Reincarnation</td></tr>
            <tr><td>Forbidden facility artifact</td><td><code>500 + 0.75 × ln(1 + √(xy))³</code></td><td>Greater Good/Evil time and greatest Order/Chaos/Balance time</td></tr>
            <tr><td>Archon Bloodline</td><td><code>ln(1 + x)³</code></td><td><code>x</code>: time spent this Era</td></tr>
            <tr><td>Goblin Lineage Perk 6</td><td><code>4√x</code>, capped at 3,000</td><td><code>x</code>: Tax Collection worth in seconds</td></tr>
            <tr><td>Dwarf Lineage Perk 6</td><td><code>0.6 × x<sup>0.6</sup></code>, capped at 3,000</td><td><code>x</code>: excavation depth</td></tr>
        </tbody>
    </table></div>
    <details class="guide-reference-details">
        <summary>Complete formulas, affiliations, and examples</summary>
        <div><?php a3_render_lines($a3BudgetLines); ?></div>
    </details>
</section>

<?php guide_source_status('4.3.11', 'R160–R219 progression, production, buffs, unlocks, artifacts, trophies, and Mercenary challenges', 'https://github.com/chombler/not-a-wiki/edit/local-4.3.15/content/A3/a3-reference-v4.3.11.md', 'Edit guide source'); ?>

<?php include "../scripts/footer.html"; ?>
