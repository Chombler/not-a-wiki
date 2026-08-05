<?php
function guide_source_status($version, $coverage, $sourceHref, $sourceLabel = 'Source file', $updated = '') {
    echo '<section class="guide-section guide-source-status" id="source-status">';
    echo '<div class="guide-section-heading"><div><span>Version and provenance</span><h2>Guide status</h2></div>';
    echo '<a href="' . htmlspecialchars($sourceHref) . '">' . htmlspecialchars($sourceLabel) . '</a></div>';
    echo '<dl class="guide-status-grid"><div><dt>Game version</dt><dd>' . htmlspecialchars($version) . '</dd></div>';
    if ($updated !== '') echo '<div><dt>Source updated</dt><dd>' . htmlspecialchars($updated) . '</dd></div>';
    echo '<div><dt>Coverage</dt><dd>' . htmlspecialchars($coverage) . '</dd></div></dl>';
    echo '<p class="guide-contribute-note">Contributing? Edit the source above and follow the <a href="/realm/content/GUIDE_AUTHORING.md">shared build format</a>. Preserve original credit and list later changes separately.</p></section>';
}

function guide_credit($author = '', $updatedBy = '', $source = '', $version = '') {
    $author = trim($author) !== '' ? $author : 'Uncredited community source';
    echo '<footer class="build-credit"><span><strong>Original build:</strong> ' . htmlspecialchars($author) . '</span>';
    if (trim($updatedBy) !== '') echo '<span><strong>Updated by:</strong> ' . htmlspecialchars($updatedBy) . '</span>';
    if (trim($source) !== '' || trim($version) !== '') {
        echo '<details class="build-credit-details"><summary>Provenance</summary><span>';
        if (trim($source) !== '') echo '<strong>Source:</strong> ' . htmlspecialchars($source);
        if (trim($source) !== '' && trim($version) !== '') echo ' · ';
        if (trim($version) !== '') echo '<strong>Version:</strong> ' . htmlspecialchars($version);
        echo '</span></details>';
    }
    echo '</footer>';
}

function guide_filter($id, $label, $placeholder, $target) {
    echo '<div class="guide-filter-bar">';
    echo '<label for="' . htmlspecialchars($id) . '">' . htmlspecialchars($label) . '</label>';
    echo '<input id="' . htmlspecialchars($id) . '" type="search" placeholder="' . htmlspecialchars($placeholder) . '" autocomplete="off" data-guide-filter data-guide-filter-target="' . htmlspecialchars($target) . '">';
    echo '<span data-guide-filter-count aria-live="polite"></span></div>';
}

function guide_compact_build($name, $type, $template, $facts = array(), $notes = '', $author = '', $source = '', $version = '') {
    $summary = array();
    foreach (array('Range', 'Faction', 'Bloodline') as $label) {
        if (!empty($facts[$label])) $summary[] = $facts[$label];
    }
    echo '<details class="guide-build-entry" data-guide-entry><summary><span class="guide-build-summary-main"><strong>' . htmlspecialchars($name) . '</strong><span class="guide-entry-type">' . htmlspecialchars($type) . '</span></span>';
    if ($summary) echo '<span class="guide-build-summary-meta">' . htmlspecialchars(implode(' · ', $summary)) . '</span>';
    echo '</summary><div class="guide-build-entry-body">';
    if ($facts) {
        echo '<dl class="build-facts">';
        foreach ($facts as $label => $value) if (trim($value) !== '') echo '<div><dt>' . htmlspecialchars($label) . '</dt><dd>' . htmlspecialchars($value) . '</dd></div>';
        echo '</dl>';
    }
    if (trim($notes) !== '') echo '<p class="build-entry-note">' . htmlspecialchars($notes) . '</p>';
    if (trim($template) !== '') {
        $tokens = array_values(array_filter(array_map('trim', explode(',', $template)), 'strlen'));
        $research = array_values(array_filter($tokens, function ($token) { return preg_match('/^[SCDEAWF]\d+$/', $token); }));
        $setup = array_values(array_filter($tokens, function ($token) { return !preg_match('/^[SCDEAWF]\d+$/', $token); }));
        if ($research && $setup) {
            echo '<div class="guide-combined-template"><div class="guide-template-segment"><strong>Mercenary upgrades and setup</strong><code>' . htmlspecialchars(implode(',', $setup)) . '</code></div><div class="guide-template-segment"><strong>Researches</strong><code>' . htmlspecialchars(implode(',', $research)) . '</code></div><div class="guide-template-actions"><button type="button" data-copy-build="' . htmlspecialchars(implode(',', $setup), ENT_QUOTES) . '">Copy setup</button><button type="button" data-copy-build="' . htmlspecialchars(implode(',', $research), ENT_QUOTES) . '">Copy researches</button><button type="button" data-copy-build="' . htmlspecialchars($template, ENT_QUOTES) . '">Copy full build</button></div></div>';
        } else {
            echo '<div class="source-build-code"><code>' . htmlspecialchars($template) . '</code><button type="button" data-copy-build="' . htmlspecialchars($template, ENT_QUOTES) . '">Copy build</button></div>';
        }
    }
    guide_credit($author, '', $source, $version);
    echo '</div></details>';
}

function guide_build_type($label) {
    $lower = strtolower($label);
    $types = array('production' => 'Production', 'prod' => 'Production', 'buff' => 'Buff', 'unlock' => 'Unlock', 'challenge' => 'Challenge', 'mcc' => 'Challenge', 'trophy' => 'Trophy', 'lineage' => 'Lineage', 'excav' => 'Excavation', 'spell' => 'Spell');
    foreach ($types as $needle => $type) {
        if (strpos($lower, $needle) !== false) return $type;
    }
    return 'Build';
}

function guide_section_type($label, $fallback = 'Build') {
    $lower = strtolower($label);
    if (preg_match('/r\d+.*r\d+|r\d+\+|production|progression|pre-|post-|astral/', $lower)) return 'Production';
    if (preg_match('/challenge|mcc|duel/', $lower)) return 'Challenge';
    if (preg_match('/unlock|artifact|troph/', $lower)) return 'Unlock';
    if (preg_match('/buff|building|click|assistant|spell|mana|excav|faction coin|miscellaneous/', $lower)) return 'Buff';
    if (strpos($lower, 'lineage') !== false) return 'Lineage';
    return $fallback;
}
?>
