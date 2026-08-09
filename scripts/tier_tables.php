<?php

function realm_tier_buildings($tier)
{
    $buildings = array(
        1 => 'Farm',
        2 => 'Inn',
        3 => 'Blacksmith',
        4 => 'Warrior Barracks / Slave Pen / Deep Mine',
        5 => "Knight's Joust / Orcish Arena / Stone Pillars",
        6 => 'Wizard Tower / Witch Conclave / Alchemist Lab',
        7 => 'Cathedral / Dark Temple / Monastery',
        8 => 'Citadel / Necropolis / Labyrinth',
        9 => 'Royal Castle / Evil Fortress / Iron Stronghold',
        10 => "Heaven's Gate / Hell Portal / Ancient Pyramid",
        11 => 'Hall of Legends',
    );

    return $buildings[$tier];
}

function realm_tier_number($value)
{
    if ($value == 0) {
        return '0';
    }
    if (abs($value) >= 1000000) {
        return rtrim(rtrim(sprintf('%.4g', $value), '0'), '.');
    }
    if (abs($value) >= 1000) {
        $decimals = abs($value - round($value)) < 0.00000001 ? 0 : 2;
        return number_format($value, $decimals, '.', ',');
    }
    if (abs($value) >= 1) {
        return rtrim(rtrim(number_format($value, 4, '.', ''), '0'), '.');
    }
    return rtrim(rtrim(number_format($value, 8, '.', ''), '0'), '.');
}

function realm_tier_value($kind, $tier)
{
    switch ($kind) {
        case 'druidic-vocabulary': return array(4000 * (12 - $tier), '%');
        case 'mabinogion': return array(12 * pow(1.8, 12 - $tier), '%');
        case 'grove-farming': return array(0.8 * pow(6 - abs(6 - $tier), 4), '%');
        case 'overflowing-magic': return array(3 * (12 - $tier), ' × x^0.7%');
        case 'abyssal-furnace': return array(0.5 * pow($tier, 1.5), ' × x^0.5%');
        case 'bedrock-foundations': return array(pow(10, 0.75 * $tier), ' base production/s');
        case 'dwarf-bloodline': return array(pow(10, pow(1.25 * $tier, 0.75)), ' × ln(1 + x)^1.75 base production/s');
        case 'hierarchy': return array(0.1 * pow(12 - $tier, 2), ' × x^0.45%');
        case 'apprenticeship': return array(pow(1.4, 12 - $tier), ' × B');
        case 'decentralization': return array(pow(3 - 0.25 * $tier, 4), ' × x^0.6%');
        case 'upheaval': return array(0.5 * pow(12 - $tier, 2.15), ' × (60 + x)^0.75%');
        case 'wall-fragment': return array(3 * pow(2 * (11 - $tier), 3), '%');
        case 'wall-chunk': return array(30000 * pow(11 - $tier, 3.5), '%');
        case 'mathematician': return array(10 * (12 - $tier), '%');
        case 'maelstrom': return array(100 * (12 - $tier), '% base-assistant multiplier');
        case 'dragons-breath-green': return array(0.000001 * pow(11 - $tier, 5), ' × ln(1 + x)^6%');
    }

    return array(0, '');
}

function realm_tier_table($kind, $heading = 'Bonus by building')
{
    $html = "<table class='numtable tier-table'><caption><b>" . htmlspecialchars($heading, ENT_QUOTES, 'UTF-8') . "</b></caption><thead><tr><th>Tier</th><th>Building</th><th>Bonus / formula</th></tr></thead><tbody>";
    for ($tier = 1; $tier <= 11; $tier++) {
        list($value, $suffix) = realm_tier_value($kind, $tier);
        $html .= '<tr><td>' . $tier . '</td><td>' . realm_tier_buildings($tier) . '</td><td>' . realm_tier_number($value) . $suffix . '</td></tr>';
    }
    return $html . '</tbody></table>';
}
