<!doctype html>
<html lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<?php
function a3_inline($text) {
    $text = preg_replace('/\\\\([>+\-=.!*()])/', '$1', trim($text));
    $text = str_replace('**', '', $text);
    $parts = preg_split('/(\[[^\]]+\]\(https?:\/\/[^)]+\))/', $text, -1, PREG_SPLIT_DELIM_CAPTURE);
    $output = '';
    foreach ($parts as $part) {
        if (preg_match('/^\[([^\]]+)\]\((https?:\/\/[^)]+)\)$/', $part, $match)) {
            $output .= '<a href="' . htmlspecialchars($match[2]) . '" target="_blank" rel="noopener">' . htmlspecialchars($match[1]) . '</a>';
        } else {
            $output .= htmlspecialchars($part);
        }
    }
    return $output;
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
        $headingLine = preg_replace('/\\\\([.])/', '$1', $line);
        if ($line === '') { $flush(); continue; }
        if (preg_match('/^#\s+/', $line)) continue;
        if (preg_match('/^##\s+(.*)$/', $line, $match)) {
            $flush();
            echo '<h2>' . a3_inline($match[1]) . '</h2>';
        } elseif (preg_match('/^\*\*([0-9]+\.\s+[^*]+)\*\*(.*)$/', $headingLine, $match)) {
            $flush();
            echo '<h3>' . a3_inline($match[1]) . '</h3>';
            if (trim($match[2]) !== '') echo '<p>' . a3_inline($match[2]) . '</p>';
        } elseif (preg_match('/^(\s*)\*\s+(.*)$/', $rawLine, $match)) {
            $flush();
            $depth = min(3, (int) floor(strlen($match[1]) / 2));
            echo '<p class="guide-bullet guide-bullet-' . $depth . '">' . a3_inline($match[2]) . '</p>';
        } else {
            $paragraph[] = $line;
        }
    }
    $flush();
}

$a3SourcePath = __DIR__ . '/../content/A3/a3-reference-v4.3.11.md';
?>

<div class="guide-intro">
    <p class="guide-kicker">Ascension 3 · R160–R219</p>
    <p>A3 progression milestones and research-budget mechanics from the supplied v4.3.11 reference.</p>
    <nav class="guide-jump" aria-label="A3 guide sections">
        <a href="#source-status">Source status</a>
        <a href="#a3-reference">Roadmap &amp; research budget</a>
    </nav>
</div>

<section class="guide-section" id="source-status">
    <div class="guide-section-heading"><div><span>Version and coverage</span><h2>A3 source status</h2></div></div>
    <aside class="build-info" aria-labelledby="a3-version-title">
        <strong id="a3-version-title">Source version</strong>
        <p>This reference is marked for game version <code>4.3.11</code>. Its linked A3 plot is explicitly described as partially outdated, especially its gem ranges.</p>
    </aside>
    <div class="a3-source-links">
        <a href="https://i.imgur.com/KOmAgQO.png" target="_blank" rel="noopener"><strong>A3 plot</strong><span>Partially outdated; check gem ranges</span></a>
        <a href="https://docs.google.com/document/d/1xVXiP3R2WtRH9gwUfoo8mkKiYuQQgg8W8J6eMFcDNeQ/edit?tab=t.0" target="_blank" rel="noopener"><strong>Patch 4.3 notes</strong><span>External Google document</span></a>
    </div>
    <p class="guide-coverage-note">The supplied file says the detailed R160–R180 and R181–R219 builds were stored in separate document tabs. Those build tables are not present in this source, so this page currently contains the roadmap and research-budget reference only.</p>
</section>

<section class="guide-section a2-guide" id="a3-reference">
    <div class="guide-section-heading">
        <div><span>Detailed source · v4.3.11</span><h2>A3 roadmap and research budget</h2></div>
        <a href="/realm/content/A3/a3-reference-v4.3.11.md">Markdown source</a>
    </div>
    <div class="a2-guide-body">
        <?php render_a3_reference($a3SourcePath); ?>
    </div>
</section>

<?php include "../scripts/footer.html"; ?>
