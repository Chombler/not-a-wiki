<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
require_once __DIR__ . '/../scripts/guide_components.php';
function clean_a2_markdown($text) {
    $text = preg_replace('/\\\\([>+\-!<])/', '$1', $text);
    $text = str_replace(array('**', '\\~'), array('', '~'), $text);
    return trim($text);
}

function render_a2_guide($path) {
    $lines = file($path, FILE_IGNORE_NEW_LINES);
    $paragraph = array();
    $collectingResearch = false;
    $awaitingMobile = false;
    $inGuide = false;
    $flush = function () use (&$paragraph) {
        if (!$paragraph) return;
        echo '<p>' . nl2br(htmlspecialchars(implode("\n", $paragraph))) . '</p>';
        $paragraph = array();
    };
    foreach ($lines as $rawLine) {
        $line = trim($rawLine);
        if (preg_match('/^#\s+\*\*All Templates\*\*/', $line)) break;
        if (!$inGuide) {
            if (preg_match('/^#\s+\*\*R100-R109\*\*/', $line)) $inGuide = true;
            else continue;
        }
        if ($line === '' || preg_match('/^\s*-{3,}\s*$/', str_replace('\\', '', $line))) {
            $flush();
            continue;
        }
        if (preg_match('/^(#{1,4})\s*(.*)$/', $line, $match)) {
            $flush();
            $title = clean_a2_markdown($match[2]);
            if ($title === '' || $title === '---' || stripos($title, 'REALM GRINDER A2') !== false) continue;
            $level = min(4, strlen($match[1]) + 1);
            echo '<h' . $level . '>' . htmlspecialchars($title) . '</h' . $level . '>';
            $collectingResearch = false;
            $awaitingMobile = false;
            continue;
        }
        if (preg_match('/^\|\s*:?-+/', $line)) continue;
        if (strpos($line, '|') === 0) {
            $flush();
            $cells = array_values(array_filter(array_map('trim', explode('|', trim($line, '| '))), 'strlen'));
            if ($cells) {
                echo '<div class="guide-format-row"><code>' . htmlspecialchars(clean_a2_markdown($cells[0])) . '</code>';
                if (isset($cells[1])) echo '<span>' . htmlspecialchars(clean_a2_markdown($cells[1])) . '</span>';
                echo '</div>';
            }
            continue;
        }
        $plain = clean_a2_markdown($line);
        if (preg_match('/^RESEARCHES:\s*$/i', $plain)) {
            $flush();
            $collectingResearch = true;
            continue;
        }
        if (preg_match('/^Mobile:\s*$/i', $plain)) {
            $flush();
            $collectingResearch = false;
            $awaitingMobile = true;
            continue;
        }
        if ($awaitingMobile) {
            if (substr_count($plain, ',') >= 2) {
                echo '<div class="source-build-code"><code>' . htmlspecialchars($plain) . '</code><button type="button" class="copy-build" data-build="' . htmlspecialchars($plain) . '">Copy</button></div>';
                $awaitingMobile = false;
                continue;
            }
            $awaitingMobile = false;
        }
        if ($collectingResearch) continue;
        if (preg_match('/^(GAMEPLAY NOTES|NOTABLE BUFFS(?: \([^)]*\))?):?$/i', $plain, $match)) {
            $flush();
            echo '<h5>' . htmlspecialchars($match[1]) . '</h5>';
        } elseif (preg_match('/^(RANGE|PREREQS|FACTION|BLOODLINE|SET|STONEHEART):\s*(.*)$/i', $plain, $match)) {
            $flush();
            echo '<p class="build-metadata"><strong>' . htmlspecialchars(strtoupper($match[1])) . '</strong><span>' . htmlspecialchars($match[2]) . '</span></p>';
        } elseif (preg_match('/^(\s*)\*\s+(.*)$/', $rawLine, $match)) {
            $flush();
            $depth = min(3, (int) floor(strlen($match[1]) / 2));
            echo '<p class="guide-bullet guide-bullet-' . $depth . '">' . htmlspecialchars(clean_a2_markdown($match[2])) . '</p>';
        } else {
            $paragraph[] = $plain;
        }
    }
    $flush();
}

$guidePath = __DIR__ . '/../content/A2/a2-builds-v4.3.9.md';
$guideSource = file_get_contents($guidePath);
preg_match('/([A-Za-z0-9+\/=]{500,})\s*$/', $guideSource, $templateMatch);
$templateSource = isset($templateMatch[1]) ? $templateMatch[1] : '';
$templateData = json_decode(base64_decode($templateSource), true);
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 2 · R100–R159</p>
    <p>Production, buff, unlock, lineage, and challenge builds for A2. The supplied build reference is explicitly versioned for game version 4.3.9.</p>
    <nav class="guide-jump" aria-label="A2 guide sections">
        <a href="#plot">Plot</a>
        <a href="#progression-ranges">Reincarnation ranges</a>
    </nav>
</div>

<section class="guide-section" id="plot">
    <div class="guide-section-heading">
        <div><span>Overview</span><h2>Ascension 2 progression plot</h2></div>
        <a href="/realm/content/A2/a2plot.png" target="_blank">Open full size</a>
    </div>
    <figure class="progression-plot">
        <a href="/realm/content/A2/a2plot.png" target="_blank"><img src="/realm/content/A2/a2plot.png" alt="Ascension 2 production guide chart showing recommended factions and bloodlines from R100 through R159, gem ranges, lineage goals, astral unlocks, and challenges"></a>
        <figcaption>Recommended production route across A2, with lineage, artifact-set, astral unlock, and challenge milestones.</figcaption>
    </figure>
</section>

<?php require_once __DIR__ . '/../scripts/range_guide.php'; render_ascension_routes('A2'); include "../scripts/footer.html"; return; ?>

<section class="guide-section" id="template-index">
    <div class="guide-section-heading">
        <div><span><?php echo count($templateData['research']); ?> builds · source v4.3.9</span><h2>A2 build index</h2></div>
    </div>
    <aside class="build-info" aria-labelledby="a2-index-info">
        <strong id="a2-index-info">Using this index</strong>
        <p>Use these rows for quick template imports. The detailed guide below contains required sets, prerequisites, targeting instructions, swaps, and notable buffs.</p>
    </aside>
    <?php guide_filter('a2-build-filter', 'Filter A2 builds', 'Try R139, challenge, lineage…', '#a2-build-list'); ?>
    <div class="guide-build-entries" id="a2-build-list">
    <?php foreach ($templateData['research'] as $build) { ?>
        <?php $buildTitle = trim($build['tp']) === 'S1' ? 'MKC4 — configuration-only challenge' : $build['text']; ?>
        <?php $configurationOnly = trim($build['tp']) === 'S1'; ?>
        <?php guide_compact_build($buildTitle, guide_build_type($buildTitle), $configurationOnly ? '' : $build['tp'], array(), $configurationOnly ? 'Configuration-only build; no research template is required. See MKC4 in the progression guide for faction, set, and execution notes.' : 'Open the progression guide for prerequisites, sets, targeting instructions, swaps, and notable buffs.', '', 'A2 Builds Master Reference', '4.3.9'); ?>
    <?php } ?>
    </div>
</section>

<section class="guide-section a2-guide" id="build-guide">
    <div class="guide-section-heading">
        <div><span>Detailed source · v4.3.9</span><h2>A2 progression and execution notes</h2></div>
        <a href="/realm/content/A2/a2-builds-v4.3.9.md">Markdown source</a>
    </div>
    <details class="guide-reference-details"><summary>Open the complete progression and execution notes</summary><div class="a2-guide-body guide-detail-source"><?php render_a2_guide($guidePath); ?></div></details>
</section>

<?php include "../scripts/footer.html"; ?>
