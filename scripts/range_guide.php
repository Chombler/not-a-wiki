<?php
require_once __DIR__ . '/guide_components.php';

function range_guide_entries($era) {
    if ($era === 'A0') {
        $data = json_decode(file_get_contents(__DIR__ . '/../content/A0/builds.json'), true);
        $entries = array();
        foreach (array('mercenary', 'research') as $kind) foreach ($data[$kind] as $build) {
            $entries[] = array('name' => $build['title'], 'type' => $build['type'], 'code' => $build['template'], 'facts' => isset($build['details']) ? array('Faction' => $build['details']) : array(), 'notes' => isset($build['notes']) ? $build['notes'] : '', 'author' => isset($build['author']) ? $build['author'] : '');
        }
        return $entries;
    }
    if ($era === 'A1') {
        $data = json_decode(file_get_contents(__DIR__ . '/../content/A1/templates.json'), true);
        $entries = array();
        foreach (array('research', 'mercenary') as $kind) foreach ($data[$kind] as $build) {
            $entries[] = array('name' => $build['text'], 'type' => guide_build_type($build['text']), 'code' => $build['tp'], 'facts' => array(), 'notes' => '', 'author' => '');
        }
        return $entries;
    }
    if ($era === 'A2') {
        $source = file_get_contents(__DIR__ . '/../content/A2/a2-builds-v4.3.9.md');
        preg_match('/([A-Za-z0-9+\/=]{500,})\s*$/', $source, $match);
        $data = json_decode(base64_decode($match[1]), true);
        $entries = array();
        foreach ($data['research'] as $build) $entries[] = array('name' => $build['text'], 'type' => guide_build_type($build['text']), 'code' => trim($build['tp']) === 'S1' ? '' : $build['tp'], 'facts' => array(), 'notes' => trim($build['tp']) === 'S1' ? 'Configuration-only build; consult the source notes for its setup.' : '', 'author' => '');
        return $entries;
    }
    return range_guide_markdown_entries($era);
}

function range_guide_markdown_entries($era) {
    $path = $era === 'A3' ? __DIR__ . '/../content/A3/a3-reference-v4.3.11.md' : __DIR__ . '/../content/A4/a4-builds-v4.3.11.md';
    $source = file_get_contents($path);
    if ($era === 'A4') $source = preg_split('/^# Archived Full Builds List.*$/m', $source, 2)[0];
    $entries = array(); $section = ''; $phase = ''; $current = null;
    $flush = function () use (&$entries, &$current) { if ($current && $current['code'] !== '') $entries[] = $current; $current = null; };
    foreach (preg_split('/\R/', $source) as $raw) {
        $line = trim($raw);
        if (preg_match('/^#\s+(?:\*\*)?(.*?)(?:\*\*)?\s*$/', $line, $m)) { $flush(); $section = trim(str_replace(array('**', '\\'), '', $m[1])); if ($era === 'A4' && stripos($section, 'Endgame Buff Builds') !== false) $phase = 'post-A4'; continue; }
        $isBuild = preg_match('/^##\s+(?:\*\*)?(.*?)(?:\*\*)?\s*$/', $line, $m) || preg_match('/^\\##\s+(.*?)(?:\s+\{#.*\})?$/', $line, $m) || preg_match('/^\*\*(.+?)\*\*\s*$/', $line, $m);
        if ($isBuild) {
            $name = trim(str_replace(array('**', '~~', '\\'), '', $m[1]));
            if ($name === '' || stripos($name, 'README') === 0 || stripos($name, 'x²Progression') === 0 || preg_match('/^R\d+(?:-|–|\+)/', $name)) continue;
            $flush();
            $current = array('name' => $name, 'type' => guide_section_type($section), 'code' => '', 'facts' => array(), 'notes' => '', 'author' => '', 'section' => trim($phase . ' ' . $section));
            continue;
        }
        if (!$current) continue;
        if (preg_match('/^(Author|Original Author|Range|Faction|Alignment|Bloodline|Lineage|Set|Artifact Set|Requirement|Requirements):\s*(.*)$/i', $line, $m)) {
            $label = ucwords(strtolower($m[1])); if ($label === 'Requirements') $label = 'Requirement'; if ($label === 'Artifact Set') $label = 'Set';
            if ($label === 'Author' || $label === 'Original Author') $current['author'] = trim($m[2]); else $current['facts'][$label] = trim($m[2]);
            continue;
        }
        $tokens = array_values(array_filter(array_map('trim', explode(',', $line)), 'strlen'));
        $valid = count($tokens) > 2;
        foreach ($tokens as $token) if (!preg_match('/^(?:[A-Z]{1,3}\d+|(?:SP|UB|UNN|MA):[^,]+)$/', $token)) $valid = false;
        if ($valid) { $current['code'] .= ($current['code'] === '' ? '' : ',') . implode(',', $tokens); continue; }
        if ($line !== '' && $line !== '---' && !preg_match('/^(Gameplay Notes|Notable Buffs|Upgrades & Researches|Researches|Mobile).*[:;,]$/i', $line)) $current['notes'] .= ($current['notes'] === '' ? '' : ' ') . trim(str_replace(array('**', '*', '\\'), '', $line));
    }
    $flush(); return $entries;
}

function range_guide_numbers($entry) {
    $haystack = $entry['name'] . ' ' . (isset($entry['facts']['Range']) ? $entry['facts']['Range'] : '') . ' ' . (isset($entry['section']) ? $entry['section'] : '');
    if (preg_match('/R\s*(\d+)\s*(?:-|–|to)\s*R?\s*(\d+)/i', $haystack, $m)) return array((int)$m[1], (int)$m[2]);
    if (preg_match('/R\s*(\d+)\s*\+/i', $haystack, $m)) return array((int)$m[1], 999);
    if (preg_match('/R\s*(\d+)/i', $haystack, $m)) return array((int)$m[1], (int)$m[1]);
    return null;
}

function range_guide_select($entries, $start, $end, $special = false) {
    return array_values(array_filter($entries, function ($entry) use ($start, $end, $special) {
        $range = range_guide_numbers($entry);
        if ($special) return $range === null;
        return $range !== null && $range[0] <= $end && $range[1] >= $start;
    }));
}

function render_range_guide($config) {
    $entries = range_guide_select(range_guide_entries($config['era']), $config['start'], $config['end'], !empty($config['special']));
    if (!empty($config['includeUnscoped'])) {
        foreach (range_guide_select(range_guide_entries($config['era']), 0, 0, true) as $entry) $entries[] = $entry;
    }
    if (!empty($config['sectionMatch'])) {
        $entries = array_values(array_filter($entries, function ($entry) use ($config) { return stripos(isset($entry['section']) ? $entry['section'] : '', $config['sectionMatch']) !== false; }));
    }
    echo '<div class="guide-intro"><p class="guide-kicker">' . htmlspecialchars($config['era'] . ' · ' . $config['range']) . '</p><p>' . htmlspecialchars($config['summary']) . '</p><nav class="guide-jump"><a href="/realm/' . htmlspecialchars($config['landing']) . '">Ascension overview</a><a href="#builds">Builds</a><a href="#source-status">Source</a></nav></div>';
    if (!empty($config['milestones'])) { echo '<aside class="guide-milestones"><strong>Goals for this range</strong>'; foreach ($config['milestones'] as $goal) echo '<span>' . htmlspecialchars($goal) . '</span>'; echo '</aside>'; }
    echo '<section class="guide-section" id="builds"><div class="guide-section-heading"><div><span>' . count($entries) . ' applicable entries</span><h2>' . htmlspecialchars($config['range'] . ' builds') . '</h2></div><a href="' . htmlspecialchars($config['sourceHref']) . '">Edit source</a></div>';
    guide_filter(strtolower($config['era']) . '-' . $config['start'] . '-filter', 'Filter these builds', 'Production, unlock, faction…', '#range-builds');
    echo '<div class="guide-build-entries" id="range-builds">';
    foreach ($entries as $entry) guide_compact_build($entry['name'], $entry['type'], $entry['code'], $entry['facts'], $entry['notes'], $entry['author'], $config['sourceLabel'], $config['version']);
    echo '</div></section>';
    guide_source_status($config['version'], $config['range'] . ' progression and applicable builds', $config['sourceHref'], 'Canonical source');
}

function render_ascension_routes($era) {
    require __DIR__ . '/range_page_configs.php';
    echo '<section class="guide-section" id="progression-ranges"><div class="guide-section-heading"><div><span>Choose your current range</span><h2>' . htmlspecialchars($era) . ' progression</h2></div></div><div class="guide-stage-grid">';
    foreach ($rangePageConfigs as $key => $config) {
        if ($config['era'] !== $era) continue;
        echo '<a href="/realm/' . htmlspecialchars($key) . '"><strong>' . htmlspecialchars($config['range']) . '</strong><span>' . htmlspecialchars($config['summary']) . '</span></a>';
    }
    echo '</div></section>';
}
?>
