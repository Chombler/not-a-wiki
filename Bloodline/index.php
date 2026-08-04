<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
	<h6><img src="/realm/Factions/picks/BloodlineTopPage.png"></h6>
	<p>
	<h6>The Bloodline</h6>
	<p>This upgrade appears at the 7th reincarnation with no other unlock requirement.</p>
	<p>This upgrade enables to choose a Faction Bloodline, giving a kind of cross-faction perk that resets at abdications.</p>
	<p><b>Cost</b>: Free</p>
	<p><b>Trophy & Upgrade</b></p>
	<p><b><img src="/realm/Factions/picks/BloodstreamSecretTrophy.png" alt="Bloodstream" align="middle"> Bloodstream</b></p>
	<p>Bloodstream Secret Trophy requirement: Purchase 100 upgrades of each faction (Anything that is faction colored counts) (All Game)</p>
	<p><b>In-game description</b>:Increase the production of all buildings based on the time spent as faction of the bloodline you are using. While you are Mercenary, a fraction of the total time spent as mercenary is added to your Bloodstream bonus based on the amount of mercenary upgrades purchased in this Era from the faction of the bloodline you are using.</p>
	<p><b>Cost</b>: 1Tg (1e93 coins), A1+ Free</p>
	<p><b>Effect</b>: Increases the production of all buildings based on the total time allied with the faction bloodline you are playing. ('Time Spent Allied with' at the bottom of the stats)</p>
	<p><b>Formula</b>: (0.1 * x ^ 0.65)%, where x is your (adjusted) time spent affiliated with the bloodline's faction.</p>
	<p><b>R28+</b>: Starting from R28, you might get Bloodspring research upgrade, that will grant you bloodline of the faction you're currently playing, in addition to the bloodline that you have chosen by basic upgrade.</p>
	<br/>
	<center><b>Bloodline Menu</b></center>
	<center><img src="/realm/Factions/picks/Bloodlines.png" usemap="#Bloodlines-map"></center>
	<map name="Bloodlines-map">
		<area href="#Fairy" research="
	<p><b><img src='/realm/Factions/picks/FairyBloodline.png' align='middle'> Fairy</b></p>
	<p><b>Effect</b>: Increase the production of Farm, Inn and Blacksmith based on the assistants you own.</p>
	<p><b>Formula</b>: (18 * ln(1 + x) ^ 3)%, where x is the number of assistants you have.</p>
		" coords="10,10,64,64" shape="rect">
		<area href="#Elven" research="
	<p><b><img src='/realm/Factions/picks/ElvenBloodline.png' align='middle'> Elven</b></p>
	<p><b>Effect</b>: Increase the chance to find Faction Coins based on Faction Coins found in this Era.</p>
	<p><b>Formula</b>: +(10 * ln(1 + x) ^ 1.75)%, where x is number of Faction Coins found in this Era.</p>
	<p><b>Effect</b>: Autoclick 3 times per second. Autoclicks made this way benefit from a 100 times higher clicking reward and Faction Coin find chance.</p>
	<p><b>Effect</b>: Also multiplicatively increase Faction Coin find chance based on the amount of clicks made in this Era.</p>
	<p><b>Formula</b>: (10 * ln(1 + x))%, where x is clicks made in this Era.</p>
		" coords="70,10,124,64" shape="rect">
		<area href="#Angel" research="
	<p><b><img src='/realm/Factions/picks/AngelBloodline.png' align='middle'> Angel</b></p>
	<p><b>Effect</b>: Increase the duration of all spells based on spells cast in this Era.</p>
	<p><b>Formula</b>: (5 * ln(1 + x) ^ 1.5)%, where x is spells cast in this Era.</p>
	<p><b>Effect</b>: Also provides the ability to cast Holy Light regardless of alignment. If your alignment is Good, Holy Light bonus increases over its duration.</p>
		" coords="130,10,184,64" shape="rect">
		<area href="#Goblin" research="
	<p><b><img src='/realm/Factions/picks/GoblinBloodline.png' align='middle'> Goblin</b></p>
	<p><b>Effect</b>: Reduce all building cost multipliers.</p>
	<p><b>Note</b>: Reduces cost multiplier by 0.01; with no other reductions applying, the multiplier will be 1.14 instead of 1.15.</p>
		" coords="10,70,64,124" shape="rect">
		<area href="#Undead" research="
	<p><b><img src='/realm/Factions/picks/UndeadBloodline.png' align='middle'> Undead</b></p>
	<p><b>Effect</b>: Multiplicatively increase assistants based on the amount of times you reincarnated.</p>
	<p><b>Formula</b>: (16 * x ^ 0.8)%, where x is the number of times you have reincarnated.</p>
		" coords="70,70,124,124" shape="rect">
		<area href="#Demon" research="
	<p><b><img src='/realm/Factions/picks/DemonBloodline.png' align='middle'> Demon</b></p>
	<p><b>Effect</b>: Spells cast count more based on the maximum amount of Hell Portals you had in this Reincarnation.</p>
	<p><b>Formula</b>: (2.5 * x ^ 0.5)%, where x is the maximum amount of Hell Portals in this Reincarnation.</p>
	<p><b>Effect</b>: Also provides the ability to cast Blood Frenzy regardless of alignment. If your alignment is Evil, Blood Frenzy bonus increases based on time spent as Evil across all Reincarnations.</p>
	<p><b>Formula</b>: (x ^ 0.5)%, where x is time spent as Evil (All Time).</p>
		" coords="130,70,184,124" shape="rect">
		<area href="#Titan" research="
	<p><b><img src='/realm/Factions/picks/TitanBloodline.png' align='middle'> Titan</b></p>
	<p><b>Effect</b>: Increase the production of all buildings based on the amount of Royal Exchanges you purchased.</p>
	<p><b>Formula</b>: (12 * x ^ 0.8)%, where x is the amount of Royal Exchanges you own.</p>
		" coords="10,130,64,184" shape="rect">
		<area href="#Druid" research="
	<p><b><img src='/realm/Factions/picks/DruidBloodline.png' align='middle'> Druid</b></p>
	<p><b>Effect</b>: Multiplicatively increase Mana Regeneration based on Maximum Mana.</p>
	<p><b>Formula</b>: ((0.25 * x ^ 0.5) + (0.0025 * ln(1 + x) ^ 5))%, where x is your Maximum Mana.</p>
		" coords="70,130,124,184" shape="rect">
		<area href="#Faceless" research="
	<p><b><img src='/realm/Factions/picks/FacelessBloodline.png' align='middle'> Faceless</b></p>
	<p><b>Effect</b>: Increase Maximum Mana based on Mana produced in this Era (additive).</p>
	<p><b>Formula</b>: +(0.5 * ln(1 + x) ^ 4), where x is your Mana produced in this Era.</p>
	<p><b>Effect</b>: Also provides the ability to cast Gem Grinder regardless of alignment. If your alignment is Neutral, Gem Grinder bonus increases chaotically based on assistants.</p>
	<p><b>Formula</b>: (20 * (ln(1 + x) / ln((x mod 10) + 2)) ^ 2)%, where x is assistants owned.</p>
		" coords="130,130,184,184" shape="rect">
		<area href="#Dwarf" research="
	<p><b><img src='/realm/Factions/picks/DwarvenBloodline.png' align='middle'> Dwarf</b></p>
	<p><b>Effect</b>: Increase the base production of each building based on Excavation depth. Bonus increases with building tier.</p>
	<p><b>Formula</b>: +(ln(1 + x) ^ 1.75 * 10 ^ ((1.25 * T) ^ 0.75) / 30) base production per second, where x is Excavation depth and T is the building tier.</p>
	<?php echo realm_tier_table('dwarf-bloodline'); ?>
		" coords="10,190,64,244" shape="rect">
		<area href="#Drow" research="
	<p><b><img src='/realm/Factions/picks/DrowBloodline.png' align='middle'> Drow</b></p>
	<p><b>Effect</b>: Increase the production of all buildings based on mana produced in this Reincarnation.</p>
	<p><b>Formula</b>: (2.75 * ln(1 + x) ^ 2.75)%, where x is mana produced in this Reincarnation.</p>
		" coords="70,190,124,244" shape="rect">
		<area href="#Dragon" research="
	<p><b><img src='/realm/Factions/picks/DragonBloodline.png' align='middle'> Dragon</b></p>
	<p><b>Effect</b>: Increase the production of Unique Buildings based on Faction Coin find chance.</p>
	<p><b>Formula</b>: (3 * x ^ 0.3)%, where x is your Faction Coin find chance.</p>
		" coords="130,190,184,244" shape="rect">
		<area href="#Archon" research="
	<p><b><img src='/realm/Factions/picks/ArchonBloodline.png' align='middle'> Archon</b></p>
	<p><b>Requirements</b>: Archon Unlocked, R130+</p><p><b>Effect</b>: Gain additional research slots based on time spent this Era.</p>
	<p><b>Formula</b>: (1 + floor(((1 + x / 16200) ^ 0.5 - 1) / 2)), where x is time spent in this Era (in seconds).</p>
	<p><b>Note</b>: +1 research at start, +2 at 2 days, +3 at 6 days, +4 at 12 days.. (T >= N * (N - 1)), where T is time in days and N is amount of extra researches.</p>
	<p><b>A3+ Effect</b>: You can purchase additional researches based on their research points cost. This budget increases with time spent in this Era.</p>
	<p><b>A3+ Formula</b>: +(ln(1 + x) ^ 3), where x is time spent in this Era.</p>
		" coords="10,250,64,304" shape="rect">
		<area href="#Djinn" research="
	<p><b><img src='/realm/Factions/picks/DjinnBloodline.png' align='middle'> Djinn</b></p>
	<p><b>Requirements</b>: Djinn Unlocked, R130+</p><p><b>Effect</b>: Gain a new spell that costs 500,000 mana and lasts 1 minute as a fixed duration. Each time you cast it, it activates two random Vanilla or base alignment spells at one tier below the Ascension maximum.</p>
		" coords="70,250,124,304" shape="rect">
		<area href="#Makers" research="
	<p><b><img src='/realm/Factions/picks/MakersBloodline.png' align='middle'> Makers</b></p>
	<p><b>Requirements</b>: Makers Unlocked, R130+</p><p><b>Effect</b>: Increase your Set power based on faction coins collected this Era.</p>
	<p><b>Formula</b>: (0.25 * ln(1 + x) ^ 1.35)%, where x is Faction Coins found in this Era.</p>
		" coords="130,250,184,304" shape="rect">
	</map>
	<br/>
	<hr>
	<p id="Fairy"><b><img src="/realm/Factions/picks/FairyBloodline.png" alt="fairy" align="middle"> Fairy</b></p>
	<p><b>Effect</b>: Increase the production of Farm, Inn and Blacksmith based on the assistants you own.</p>
	<p><b>Formula</b>: (18 * ln(1 + x) ^ 3)%, where x is the number of assistants you have.</p>
	<hr>
	<p id="Elven"><b><img src="/realm/Factions/picks/ElvenBloodline.png" alt="Elven" align="middle"> Elven</b></p>
	<p><b>Effect</b>: Increase the chance to find Faction Coins based on Faction Coins found in this Era.</p>
	<p><b>Formula</b>: +(10 * ln(1 + x) ^ 1.75)%, where x is number of Faction Coins found in this Era.</p>
	<p><b>Effect</b>: Autoclick 3 times per second. Autoclicks made this way benefit from a 100 times higher clicking reward and Faction Coin find chance.</p>
	<p><b>Effect</b>: Also multiplicatively increase Faction Coin find chance based on the amount of clicks made in this Era.</p>
	<p><b>Formula</b>: (10 * ln(1 + x))%, where x is clicks made in this Era.</p>
	<hr>
	<p id="Angel"><b><img src="/realm/Factions/picks/AngelBloodline.png" alt="Angel" align="middle"> Angel</b></p>
	<p><b>Effect</b>: Increase the duration of all spells based on spells cast in this Era.</p>
	<p><b>Formula</b>: (5 * ln(1 + x) ^ 1.5)%, where x is spells cast in this Era.</p>
	<p><b>Effect</b>: Also provides the ability to cast Holy Light regardless of alignment. If your alignment is Good, Holy Light bonus increases over its duration.</p>
	<hr>
	<p id="Goblin"><b><img src="/realm/Factions/picks/GoblinBloodline.png" alt="Goblin" align="middle"> Goblin</b></p>
	<p><b>Effect</b>: Reduce all building cost multipliers.</p>
	<p><b>Note</b>: Reduces cost multiplier by 0.01; with no other reductions applying, the multiplier will be 1.14 instead of 1.15.</p>
	<hr>
	<p id="Undead"><b><img src="/realm/Factions/picks/UndeadBloodline.png" alt="Undead" align="middle"> Undead</b></p>
	<p><b>Effect</b>: Multiplicatively increase assistants based on the amount of times you reincarnated.</p>
	<p><b>Formula</b>: (16 * x ^ 0.8)%, where x is the number of times you have reincarnated.</p>
	<hr>
	<p id="Demon"><b><img src="/realm/Factions/picks/DemonBloodline.png" alt="Demon" align="middle"> Demon</b></p>
	<p><b>Effect</b>: Spells cast count more based on the maximum amount of Hell Portals you had in this Reincarnation.</p>
	<p><b>Formula</b>: (2.5 * x ^ 0.5)%, where x is the maximum amount of Hell Portals in this Reincarnation.</p>
	<p><b>Effect</b>: Also provides the ability to cast Blood Frenzy regardless of alignment. If your alignment is Evil, Blood Frenzy bonus increases based on time spent as Evil across all Reincarnations.</p>
	<p><b>Formula</b>: (x ^ 0.5)%, where x is time spent as Evil (All Time).</p>
	<hr>
	<p id="Titan"><b><img src="/realm/Factions/picks/TitanBloodline.png" alt="Titan" align="middle"> Titan</b></p>
	<p><b>Effect</b>: Increase the production of all buildings based on the amount of Royal Exchanges you purchased.</p>
	<p><b>Formula</b>: (12 * x ^ 0.8)%, where x is the amount of Royal Exchanges you own.</p>
	<hr>
	<p id="Druid"><b><img src="/realm/Factions/picks/DruidBloodline.png" alt="Druid" align="middle"> Druid</b></p>
	<p><b>Effect</b>: Multiplicatively increase Mana Regeneration based on Maximum Mana.</p>
	<p><b>Formula</b>: ((0.25 * x ^ 0.5) + (0.0025 * ln(1 + x) ^ 5))%, where x is your Maximum Mana.</p>
	<hr>
	<p id="Faceless"><b><img src="/realm/Factions/picks/FacelessBloodline.png" alt="Faceless" align="middle"> Faceless</b></p>
	<p><b>Effect</b>: Increase Maximum Mana based on Mana produced in this Era (additive).</p>
	<p><b>Formula</b>: +(0.5 * ln(1 + x) ^ 4), where x is your Mana produced in this Era.</p>
	<p><b>Effect</b>: Also provides the ability to cast Gem Grinder regardless of alignment. If your alignment is Neutral, Gem Grinder bonus increases chaotically based on assistants.</p>
	<p><b>Formula</b>: (20 * (ln(1 + x) / ln((x mod 10) + 2)) ^ 2)%, where x is assistants owned.</p>
	<hr>
	<p id="Dwarf"><b><img src="/realm/Factions/picks/DwarvenBloodline.png" alt="Dwarf" align="middle"> Dwarf</b></p>
	<p><b>Effect</b>: Increase the base production of each building based on Excavation depth. Bonus increases with building tier.</p>
	<p><b>Formula</b>: +(ln(1 + x) ^ 1.75 * 10 ^ ((1.25 * T) ^ 0.75) / 30) base production per second, where x is Excavation depth and T is the building tier.</p>
	<?php echo realm_tier_table('dwarf-bloodline'); ?>
	<hr>
	<p id="Drow"><b><img src="/realm/Factions/picks/DrowBloodline.png" alt="Drow" align="middle"> Drow</b></p>
	<p><b>Effect</b>: Increase the production of all buildings based on mana produced in this Reincarnation.</p>
	<p><b>Formula</b>: (2.75 * ln(1 + x) ^ 2.75)%, where x is mana produced in this Reincarnation.</p>
	<hr>
	<p id="Dragon"><b><img src="/realm/Factions/picks/DragonBloodline.png" alt="Dragon" align="middle"> Dragon</b></p>
	<p><b>Effect</b>: Increase the production of Unique Buildings based on Faction Coin find chance.</p>
	<p><b>Formula</b>: (3 * x ^ 0.3)%, where x is your Faction Coin find chance.</p>
	<hr>
	<p id="Archon"><b><img src="/realm/Factions/picks/ArchonBloodline.png" align="middle"> Archon</b></p>
	<p><b>Requirements</b>: Archon Unlocked, R130+</p>
	<p><b>Effect</b>: Gain additional research slots based on time spent this Era.</p>
	<p><b>Formula</b>: (1 + floor(((1 + x / 16200) ^ 0.5 - 1) / 2)), where x is time spent in this Era (in seconds).</p>
	<p><b>Note</b>: +1 research at start, +2 at 2 days, +3 at 6 days, +4 at 12 days.. (T >= N * (N - 1)) where T is time in days and N is amount of extra researches.</p>
	<p><b>A3+ Effect</b>: You can purchase additional researches based on their research points cost. This budget increases with time spent in this Era.</p>
	<p><b>A3+ Formula</b>: +(ln(1 + x) ^ 3), where x is time spent in this Era.</p>
	<hr>
	<p id="Djinn"><b><img src="/realm/Factions/picks/DjinnBloodline.png" align="middle"> Djinn</b></p>
	<p><b>Requirements</b>: Djinn Unlocked, R130+</p>
	<p><b>Effect</b>: Gain access to the Catalyst Spell.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/CatalystSpell.png" alt="Catalyst" align="middle"> Catalyst</b></p>
	<p><b>Spell Type</b>: (Chaos) Djinn Faction Spell</p>
	<p><b>Cost</b>: 500,000 Mana - <b>Duration</b>: Fixed to 60 seconds</p>
	<p><b>Effect</b>: Activates two random Vanilla or base alignment spells at one tier below the Ascension maximum for 60 seconds. This spell's duration cannot be modified.</p>
	<p><b>Note</b>: Having access to this spell also enables the spell trophies and the challenge rewards of those spells.</p>
	<p><b>Note</b>: Can not cast a spell that is already available.</p>
	<hr>
	<p id="Makers"><b><img src="/realm/Factions/picks/MakersBloodline.png" align="middle"> Makers</b></p>
	<p><b>Requirements</b>: Makers Unlocked, R130+</p>
	<p><b>Effect</b>: Increase your Set power based on faction coins collected this Era.</p>
	<p><b>Formula</b>: (0.25 * ln(1 + x) ^ 1.35)%, where x is Faction Coins found in this Era.</p>
<?php include "../scripts/footer.html"; ?>
