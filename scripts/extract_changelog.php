<?php

if ($argc !== 2) {
    fwrite(STDERR, "Usage: php scripts/extract_changelog.php /path/to/class_1506.as\n");
    exit(1);
}

$source = file_get_contents($argv[1]);
preg_match_all('/method_346\("([^"]+)",\[(.*?)\]\);/s', $source, $entries, PREG_SET_ORDER);

$releaseMetadata = array(
    '4.3.12' => array('Jun 29, 2026', 'Goblin Invasion Event', 'The Goblin Invasion Event runs from Jul 7th 2026, 12.01 PM UTC to Jul 14th 2026, 6.59 PM UTC.'),
    '4.3.11' => array('May 4, 2026', 'Blood War Event', 'The Blood War Event runs from May 15th 2026, 12.01 PM UTC to May 21st 2026, 6.59 PM UTC.'),
    '4.3.10' => array('Mar 17, 2026', 'Easter Event', 'The Easter Event runs from Apr 3rd 2026, 12.01 PM UTC to Apr 10th 2026, 6.59 PM UTC.'),
    '4.3.9' => array('Feb 3, 2026', 'Valentine Event', 'The Valentine Event runs from Feb 12th 2026, 1.01 PM UTC to Feb 17th 2026, 7.59 PM UTC.'),
    '4.3.8' => array('Dec 8, 2025', 'Christmas Event', 'The Christmas Event runs from Dec 21st 2025, 1.01 PM UTC to Jan 4th 2026, 7.59 PM UTC.'),
    '4.3.7' => array('Nov 18, 2025', 'New Gifts and Mobile UI Update', 'The recurring Thanksgiving Event runs from Nov 26th 2025, 1.01 PM UTC to Nov 30th 2025, 7.59 PM UTC.'),
    '4.3.6' => array('Oct 21, 2025', 'Halloween Event', 'The Halloween Event runs from Oct 28th 2025, 1.01 PM UTC to Nov 4th 2025, 7.59 PM UTC.'),
    '4.3.5' => array('Sep 15, 2025', 'Idillium Event', 'The Idillium Event runs from Sep 23rd 2025, 12.01 PM UTC to Sep 30th 2025, 6.59 PM UTC.'),
    '4.3.4' => array('Aug 18, 2025', 'Summer Festival Event', 'The Summer Festival Event runs from Aug 21st 2025, 12.01 PM UTC to Aug 28th 2025, 6.59 PM UTC.'),
    '4.3.3' => array('Jul 2, 2025', 'Goblin Invasion Event', 'The Goblin Invasion Event runs from Jul 7th 2025, 12.01 PM UTC to Jul 11th 2025, 6.59 PM UTC.'),
    '4.3.2' => array('May 13, 2025', 'Blood War Event', 'The Blood War Event runs from May 16th 2025, 12.01 PM UTC to May 20th 2025, 6.59 PM UTC.'),
    '4.3.1' => array('Apr 14, 2025', 'Easter Event', 'The Easter Event runs from Apr 17th 2025, 12.01 PM UTC to Apr 24th 2025, 6.59 PM UTC.'),
    '4.3.0' => array('Mar 26, 2025', 'Major Overhaul Update', null),
    '4.2.27' => array('Feb 5, 2025', 'Valentine Event', 'The Valentine Event runs from Feb 13th 2025, 1.01 PM UTC to Feb 17th 2025, 7.59 PM UTC.'),
    '4.2.26' => array('Dec 10, 2024', 'Christmas Event', 'The Christmas Event runs from Dec 20th 2024, 1.01 PM UTC to Jan 4th 2025, 7.59 PM UTC.'),
    '4.2.25' => array('Oct 17, 2024', 'Halloween Event', 'The Halloween Event runs from Oct 28th 2024, 1.01 PM UTC to Nov 4th 2024, 7.59 PM UTC.'),
    '4.2.24' => array('Sep 11, 2024', 'Idillium Event', 'The Idillium Event runs from Sep 23rd 2024, 12.01 PM UTC to Sep 30th 2024, 6.59 PM UTC.'),
    '4.2.23' => array('Aug 12, 2024', 'Summer Festival Event', 'The Summer Festival Event runs from Aug 16th 2024, 12.01 PM UTC to Aug 23rd 2024, 6.59 PM UTC.'),
    '4.2.22' => array('Jul 9, 2024', 'Goblin Invasion Event', 'The Goblin Invasion Event runs from Jul 12th 2024, 12.01 PM UTC to Jul 16th 2024, 6.59 PM UTC.'),
    '4.2.21' => array('May 28, 2024', 'Blood War Event Hotfix and Rerun', 'The rerun of the Blood War Event runs from Jun 10th 2024, 12.01 PM UTC to Jun 14th 2024, 6.59 PM UTC.'),
    '4.2.20' => array('May 14, 2024', 'Blood War Event', 'The Blood War Event runs from May 17th 2024, 12.01 PM UTC to May 21st 2024, 6.59 PM UTC.'),
    '4.2.19' => array('Mar 25, 2024', 'Easter Event', 'The Easter Event runs from Mar 29th 2024, 1.01 PM UTC to Apr 5th 2024, 6.59 PM UTC.'),
    '4.2.18' => array('Feb 9, 2024', 'Valentine Event', 'The Valentine Event runs from Feb 12th 2024, 12.01 PM UTC to Feb 16th 2024, 7.59 PM UTC.'),
    '4.2.17' => array('Dec 18, 2023', 'Christmas Event', 'The Christmas Event runs from Dec 21st 2023, 12.01 PM UTC to Jan 5th 2024, 7.59 PM UTC.'),
    '4.2.16' => array('Oct 16, 2023', 'Halloween Event', 'The Halloween Event runs from Oct 27th 2023, 12.01 PM UTC to Nov 3rd 2023, 7.59 PM UTC.'),
    '4.2.15' => array('Sep 18, 2023', 'Idillium Event', 'The Idillium Event runs from Sep 21st 2023, 12.01 PM UTC to Sep 28th 2023, 6.59 PM UTC.'),
    '4.2.14' => array('Jul 31, 2023', 'Summer Festival Event', 'The Summer Festival Event runs from Aug 16th 2023, 12.01 PM UTC to Aug 23rd 2023, 6.59 PM UTC.'),
    '4.2.13' => array('Jul 4, 2023', 'Goblin Invasion Event', 'The Goblin Invasion Event runs from Jul 6th 2023, 12.01 PM UTC to Jul 10th 2023, 6.59 PM UTC.'),
);

echo "<!-- Releases below are transcribed from the changelog embedded in the 4.3.15 client. -->\n";
foreach ($entries as $entry) {
    $version = $entry[1];
    if (version_compare($version, '4.2.12', '<=')) {
        continue;
    }

    if (!isset($releaseMetadata[$version])) {
        fwrite(STDERR, "Missing release metadata for v{$version}\n");
        exit(1);
    }

    list($date, $title, $eventWindow) = $releaseMetadata[$version];
    $sourcePage = version_compare($version, '4.3.0', '>=')
        ? 'https://www.divinegames.it/discuss/viewtopic.php?id=395&amp;p=8'
        : 'https://www.divinegames.it/discuss/viewtopic.php?id=395&amp;p=7';

    preg_match_all('/"((?:\\\\.|[^"])*)"/s', $entry[2], $rawNotes);
    echo "\t\t<div class=\"shelementwhole\">\n";
    echo "\t\t\t<p onclick=\"shohid($(this));\"><b> <a href=\"#\" onclick=\"return false;\">v", htmlspecialchars($version, ENT_QUOTES, 'UTF-8'), ', ', $date, ', ', htmlspecialchars($title, ENT_QUOTES, 'UTF-8'), "</a></b></p>\n";
    echo "\t\t\t<div class=\"autohide\">\n";
    if ($eventWindow !== null) {
        echo "\t\t\t\t<p><b>Global Reminder</b>: ", htmlspecialchars($eventWindow, ENT_QUOTES, 'UTF-8'), "</p>\n";
    }
    echo "\t\t\t\t<p><b>Official announcement</b>: <a href=\"", $sourcePage, "\" target=\"_blank\">Divine Games Developers' Diary</a></p>\n";

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
