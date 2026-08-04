<?php

if ($argc !== 2) {
    fwrite(STDERR, "Usage: php scripts/extract_changelog.php /path/to/class_1506.as\n");
    exit(1);
}

$source = file_get_contents($argv[1]);
preg_match_all('/method_346\("([^"]+)",\[(.*?)\]\);/s', $source, $entries, PREG_SET_ORDER);

echo "<!-- Releases below are transcribed from the changelog embedded in the 4.3.15 client. -->\n";
foreach ($entries as $entry) {
    $version = $entry[1];
    if (version_compare($version, '4.2.12', '<=')) {
        continue;
    }

    preg_match_all('/"((?:\\\\.|[^"])*)"/s', $entry[2], $rawNotes);
    echo "\t\t<div class=\"shelementwhole\">\n";
    echo "\t\t\t<p onclick=\"shohid($(this));\"><b> <a href=\"#\" onclick=\"return false;\">v", htmlspecialchars($version, ENT_QUOTES, 'UTF-8'), "</a></b></p>\n";
    echo "\t\t\t<div class=\"autohide\">\n";

    foreach ($rawNotes[1] as $encoded) {
        $note = stripcslashes($encoded);
        if ($note === '' || $note === '{nextevent}') {
            continue;
        }

        $prefix = '';
        if (str_starts_with($note, '{mobile}')) {
            $prefix = '<b>Mobile:</b> ';
            $note = substr($note, 8);
        } elseif (str_starts_with($note, '{web}')) {
            $prefix = '<b>Web:</b> ';
            $note = substr($note, 5);
        }

        $escaped = htmlspecialchars($note, ENT_QUOTES, 'UTF-8');
        if (in_array($note, array('NEW', 'SYSTEM CHANGES', 'BALANCE CHANGES'), true)) {
            echo "\t\t\t\t<p><b>", $escaped, "</b></p>\n";
        } else {
            echo "\t\t\t\t<p>", $prefix, $escaped, "</p>\n";
        }
    }

    echo "\t\t\t</div>\n\t\t</div>\n";
}
