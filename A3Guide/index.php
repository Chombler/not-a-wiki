<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
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

$a3SourcePath = __DIR__ . '/../content/A3/a3-reference-v4.3.11.md';
$a3Source = file_get_contents($a3SourcePath);
$a3CopyCount = 0;
foreach (preg_split('/\R/', $a3Source) as $a3SourceLine) {
    if (a3_copy_code(trim($a3SourceLine)) !== null) $a3CopyCount++;
}
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 3 · R160–R219</p>
    <p>Complete A3 progression reference covering production builds, research budget, unlocks, artifacts, trophies, buff builds, and Mercenary challenges.</p>
    <nav class="guide-jump" aria-label="A3 guide sections">
        <a href="#source-status">Source status</a>
        <a href="#a3-reference">Full A3 guide</a>
    </nav>
</div>

<section class="guide-section" id="source-status">
    <div class="guide-section-heading"><div><span>Version and coverage</span><h2>A3 source status</h2></div></div>
    <aside class="build-info" aria-labelledby="a3-version-title">
        <strong id="a3-version-title">Complete source · v4.3.11</strong>
        <p>This document includes the previously missing R160–R180 and R181–R219 build sections. It contains <?php echo $a3CopyCount; ?> research and Mercenary build strings with copy controls.</p>
    </aside>
    <div class="a3-source-links">
        <a href="https://i.imgur.com/KOmAgQO.png" target="_blank" rel="noopener"><strong>A3 plot</strong><span>Partially outdated; check gem ranges</span></a>
        <a href="https://docs.google.com/document/d/1xVXiP3R2WtRH9gwUfoo8mkKiYuQQgg8W8J6eMFcDNeQ/edit?tab=t.0" target="_blank" rel="noopener"><strong>Patch 4.3 notes</strong><span>External Google document</span></a>
    </div>
</section>

<section class="guide-section a2-guide" id="a3-reference">
    <div class="guide-section-heading">
        <div><span>Detailed source · v4.3.11</span><h2>A3 progression and builds</h2></div>
        <a href="/realm/content/A3/a3-reference-v4.3.11.md">Markdown source</a>
    </div>
    <div class="a2-guide-body a4-guide-body"><?php render_a3_reference($a3SourcePath); ?></div>
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
    if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(value).catch(legacyCopy);
    else legacyCopy();
    button.textContent = 'Copied';
    window.setTimeout(function () { button.textContent = 'Copy'; }, 1200);
});
</script>

<?php include "../scripts/footer.html"; ?>
