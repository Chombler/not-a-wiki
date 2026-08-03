<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
	<style>
		.calculator table {
			border-collapse: collapse;
		}

		.calculator th {
			font-size: 14px;
		}

		.calculator td {
			font-size: 14px;
		}

		.calculator th, .calculator td {
			border: 1px solid #000000;
		}

		.calculator tr:hover {
			background-color: #ffffff
		}

		.calculator table {
			width: 100%;
		}

		.calculator td {
			text-align: center;
		}

		.calculator form {
			text-align: center;
		}

		.calculator input {
			text-align: center;
		}

		.calculator th {
			background-color: #b3bcc6;
			color: black;
		}
		#calcformtiers td input {
			width: 100px;
			box-sizing: border-box;
		}
		#calcformtiers td {
			width: 50%;
		}
	</style>
<?php include "../scripts/header.html"; ?>
	<h6><img src="/realm/Factions/picks/SpellsTopPage.png"></h6>
	<p><b>From R42+, Spell Tiers become available.</b> A spell's purchased tier is the number of simultaneous casts and normally multiplies its production effect once per cast.</p>
	<p>The generalized formula for the final spell bonus is (B ^ T), where B is the base spell production (<b>not</b> as a percentage bonus but as a multiplier) and T is the tier of the spell. The exceptions to this are Gem Grinder, which increases its production by a linear amount, and Dragon's Breath, which simply adds one new type of Dragon Breath to the current breaths in effect. Other peripheral effects, such as the tripling of assistants granted from Fairy Chanting, are also not impacted by spell tiers.</p>
	<p>Ordinary spells unlock at most one additional tier per Ascension: Tier 1 in Ascension 0, Tier 2 in Ascension 1, Tier 3 in Ascension 2, and so on. Tax Collection with Round Table, Dragon's Breath, Catalyst, Twisting Nether, and seasonal spells use their own rules.</p>
	<p>Each tier has its own Ascension penalty. For an ordinary spell with at least one tier upgrade, a base multiplier B at Ascension A and purchased tier T uses an exponent of (0.5 / A) * 0.5 ^ (A - T) when T is no greater than A. Casting a tier above A applies one additional square-root penalty. A spell with no tier upgrade uses exponent 0.1 / A.</p>
	<p>Dragon's Breath starts with five colors and gains colors across Ascensions. Its production effects do not suffer Ascension penalties.</p>
	<br/>
	<hr>
	<p><b>Spell Tier Upgrades and Autocasting</b>:</p>
	<p>Require the <img src="/realm/Factions/picks/TieredAutocastingTrophy.png" align="middle"><b> Tiered Autocasting</b> (R40+, 200 M Mana Produced this Reincarnation) trophy.</p>
	<p>Tiered Autocasting will automatically set the autocasted spell tier at the highest you have bought, but you can change it to a lower tier if you wish.</p>
	<p>Reverse Autocasting and Tiered Autocasting are separate, independent upgrades; Tiered Autocasting does not require Reverse Autocasting.</p>
	<p>The Spell Tier upgrades need to be unlocked once (see chapter below), but they need to be purchased in every abdication and cost Diamond Coins (free in A2+) and Faction Coins.</p>
	<p><b>Additional Effects</b>: Each tier upgrade has a spell-specific effect and, except for Dragon's Breath, also increases offline production based on Mana statistics. It also multiplicatively increases Faction Coins found while offline by 200% per tier, stacking additively with other sources.</p>
	<p><b>Raw offline-production formula per tier upgrade</b>: (m ^ (2 / max(3, A)) + (30 * r) ^ (2 / max(3, A))) ^ 0.4%, where m is Maximum Mana, r is Mana Regeneration per second, and A is the current Ascension. Each upgrade's result is then subjected to the Ascension penalty assigned to that tier; the in-game tooltip shows the combined purchased bonus.</p>
	<p><b>Note</b>: Offline bonuses from tier upgrades are assigned to the Ascension in which that tier becomes available. Dragon's Breath tier upgrades do not provide these offline bonuses.</p>
	<br/>
	<hr>
	<p><b>Spell Tier Unlocks</b>
	<p><b>Unlock Requirement</b>: For ordinary spells, Tier N requires N - 1 hours of that spell's activity time accumulated during the current Reincarnation, plus a spell-specific statistic requirement. A tier cannot appear before its Ascension is reached, and the appropriate tier challenge must be completed.</p>
	<p>In the table below, <b>n = N - 1</b> for the tier being unlocked. These are the exact additional statistic requirements shown by the 4.3.15 tier-upgrade logic.</p>
	<table class="numtable">
		<tr><th>Spell</th><th>Additional requirement for Tier N</th></tr>
		<tr><td>Call to Arms</td><td>((60,000 if below A4; 10,000 in A4+) / Ascension) * n buildings</td></tr>
		<tr><td>Holy Light</td><td>200,000 * n clicks in this Reincarnation</td></tr>
		<tr><td>Fairy Chanting</td><td>40,000 * n assistants</td></tr>
		<tr><td>Moon Blessing</td><td>8e12 * n Faction Coins</td></tr>
		<tr><td>God's Hand</td><td>500,000 * n Mana Regeneration</td></tr>
		<tr><td>Diamond Pickaxe</td><td>4,000 * n excavation depth</td></tr>
		<tr><td>Blood Frenzy</td><td>7,200 * n seconds of cumulative Evil-spell activity in this Reincarnation</td></tr>
		<tr><td>Goblin's Greed</td><td>1,000,000 * n Tax Collection casts</td></tr>
		<tr><td>Night Time</td><td>80,000 * n% offline bonus</td></tr>
		<tr><td>Hellfire Blast</td><td>12 * n casts during the first 5 minutes of a new Era</td></tr>
		<tr><td>Combo Strike</td><td>100 * n Combo Strike counter</td></tr>
		<tr><td>Gem Grinder</td><td>1e30 * 10 ^ (3 * n) Gems</td></tr>
		<tr><td>Lightning Strike</td><td>15,000 * n% Royal Exchange bonus</td></tr>
		<tr><td>Grand Balance</td><td>200,000 * n Maximum Mana</td></tr>
		<tr><td>Brainwave</td><td>3,600 * n seconds of Brainwave duration</td></tr>
		<tr><td>Spiritual Surge</td><td>60 * n Reincarnations</td></tr>
		<tr><td>Temporal Flux</td><td>300 * n seconds spent in this Era</td></tr>
		<tr><td>All Creation</td><td>100 * n Royal Exchanges made</td></tr>
		<tr><td>Maelstrom</td><td>4 * n active spells</td></tr>
		<tr><td>Precognition</td><td>360 * n seconds of Precognition duration</td></tr>
		<tr><td>Infinite Spiral</td><td>1.6e41 * n Faction Coins</td></tr>
		<tr><td>Limited Wish</td><td>1e10 ^ (0.25 * (1 + n)) Maximum Mana</td></tr>
	</table>
	<p><b>Dragon's Breath</b> uses Reincarnation requirements instead of activity/statistic pairs: Tier 2 at R54, Tier 3 at R60, Tier 4 at R66, and Tier 5 at R72.</p>
<?php include "../scripts/footer.html"; ?>
