<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
	<h6><a href="/realm/Factions/"><img src="/realm/Factions/picks/ArchonTopPage.png" align="middle"></a></h6>
	<p><b>In-game description</b></p>
	
	<p><b>Alignment</b>: Order</p>
		
	<p><b>Unlock Requirements</b>: First, Second, and Third Iron Fragments</p>
	<p><b><img src="/realm/Factions/picks/FirstIronFragment.png" align="middle"> First Iron Fragment</b></p>
	<p><b>Clue</b>: This one seems to require a lot of magical renewance.</p>
	<p><b>Description</b>: It looks like a piece of an iron object. It's broken off on two sides.</p>
	<p><b>Requirements</b>: R125+, 12,500+ Excavations, Play as Angel</p>
	<p><b>Chance</b>: (log10(1 + x) ^ 3 / 100,000)%, where x is Mana Regeneration.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/SecondIronFragment.png" align="middle"> Second Iron Fragment</b></p>
	<p><b>Clue</b>: Found via extensive Royal Trading mandates.</p>
	<p><b>Description</b>: It looks like a piece of an iron object. It's broken off on two sides.</p>
	<p><b>Requirements</b>: R125+, 12,500+ Excavations, Play as Titan</p>
	<p><b>Chance</b>: (x ^ 3 / 5,000,000,000 (5 B))%, where x is royal exchange bonus.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ThirdIronFragment.png" align="middle"> Third Iron Fragment</b></p>
	<p><b>Clue</b>: Chances to find increase while not actively searching.</p>
	<p><b>Description</b>: It looks like a piece of an iron object. It's broken off on two sides.</p>
	<p><b>Requirements</b>: R125+, 12,500+ Excavations, Play as Undead</p>
	<p><b>Chance</b>: ((log10(1 + x) - 2) ^ 3 / 500,000)%, where x is offline bonus.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonMask.png" align="middle"> Archon Mask</b></p>
	<p><b>Requirement</b>: Find all 3 Iron Fragments.</p>
	<p><b>Cost</b>: 10 Dqag (1e130)</p>
	<p><b>Effect</b>: Multiplicatively increase Faction Coin find chance by 500%.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonQuest.png" align="middle"> Archon Quest</b></p>
	<p><b>Requirement</b>: R125+, Collect all 3 Iron Fragments and accumulate 3 hours of Temporal Flux activity time in this Reincarnation.</p>
	<p><b>Cost</b>: 1 Ocqag (1e147)</p>
	<p><b>Effect</b>: Unlocks Archon Faction</p>
	<br/>
	<p><b>Faction spell</b></p>
	<p><b><img src="/realm/Factions/picks/Precognition.png" align="middle"> Precognition</b></p>
	<p><b>Cost</b>: 123,456 Mana - <b>Duration</b>: 20 seconds</p>
	<p><b>Effect</b>: Buildings, Assistants, Royal Exchanges, Spells cast and Clicks count more based on Mana produced in this Era.</p>
	<p><b>Formula</b>: (0.65 * ln(1 + x) ^ 1.15)%, where x is Mana produced in this Era. The result is multiplied by at least 1, increasing with spell tier.</p>
	<p><b>Note</b>: Formula Improved to (1.25 * ln(1 + x) ^ 1.5)% with AR2.</p>
	<br/>
	<p><b>Spell Trophy & Upgrade</b></p>
	<p><b><img src="/realm/Factions/picks/ChronoLoadingSpellUpgrade.png" align="middle"> Chrono Loading</b></p>
	<p><b>Requirement</b>: Cast Precognition with at least 100 Qa (1e17) Mana Regeneration.</p>
	<p><b>Note</b>: Precognition raises regen itself. Make sure that you have 100 Qa (1e17) before being cast.</p>
	<p><b>Cost</b>: 10 Octg (1e118), A3+ Free</p>
	<p><b>Effect</b>: A fraction of Precognition's duration is added to time spent in this Era.</p>
	<p><b>Formula</b>: 150 * ln(1 + x / 60) ^ 2 seconds, where x is its duration in seconds.</p>
	<hr>
	<center><b>When using Mercenary</b></center>
	<p><b>Note</b>: Astral Faction Upgrades can only be purchased with Mercenary Upgrade 4, 8, 12 and 16.</p>
	<p><b>Note</b>: Astral spells can only be bought from the Mercenary Sorcery contract.</p>
	<hr>
	<p><b>Tier 1 Upgrades</b></p>
	<p><b><img src="/realm/Factions/picks/ArchonTradeTreaty.png" align="middle"> Archon Trade Treaty</b></p>
	<p><b>Description</b>: The Archon value loyalty and any systematic and efficient plan of action. Affiliating with them will increase your ability to boost your production immensely over long periods of time.</p>
	<p><b>Requirements</b>: Vanilla and Prestige Union</p>
	<p><b>Cost</b>: 1 Oc (1e27) Angel and Undead Coins</p>
	<p><b>Effect</b>: Unlocks Archon Upgrades</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade1.png" align="middle"> Star Trading</b></p>
	<p><b>Cost</b>: 1e153 Coins</p>
	<p><b>Effect</b>: Increase the production of all buildings based on the maximum amount of Royal Exchanges you made in this Reincarnation.</p>
	<p><b>Formula</b>: (0.9 * x)%, where x is the highest amount of Royal Exchanges made in this Reincarnation.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade2.png" align="middle"> Energy Recharge</b></p>
	<p><b>Cost</b>: 1e155 Coins</p>
	<p><b>Effect</b>: Multiplicatively increase Maximum Mana based on time spent as Order in this Reincarnation.</p>
	<p><b>Formula</b>: (0.25 * x ^ 0.5)%, where x is time spent as Order this Reincarnation</p>
	<p><b>Effect</b>: Also change Precognition's production formula to (1.3 * ln(1 + x) ^ 1.25)% and its starting duration to 1 minute, where x is Mana produced in this Era.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade3.png" align="middle"> Cosmic Resonance</b></p>
	<p><b>Cost</b>: 1e157 Coins</p>
	<p><b>Effect</b>: Increase Royal Exchange bonus based on clicks made in this Reincarnation.</p>
	<p><b>Formula</b>: +(0.5 * x ^ 0.5)%, where x is clicks made this Reincarnation.</p>
	<hr>
	<p><b>Tier 2 Upgrades</b></p>
	<p><b><img src="/realm/Factions/picks/ArchonFriendshipPact.png" align="middle"> Archon Friendship Pact</b></p>
	<p><b>Cost</b>: 1 No (1e30) Angel and Undead Coins</p>
	<p><b>Effect</b>: Unlocks Archon Upgrades</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade4.png" align="middle"> Constellation</b></p>
	<p><b>Cost</b>: 1e163 Coins</p>
	<p><b>Effect</b>: Multiplicatively increase Mana Regeneration based on the amount of Unique Buildings owned.</p>
	<p><b>Formula</b>: (0.5 * x ^ 0.5)%, where x is Unique Buildings.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade5.png" align="middle"> Archon Pride</b></p>
	<p><b>Cost</b>: 1e165 Coins</p>
	<p><b>Effect</b>: Multiplicatively increase assistants and Mana produced while offline based on your current Lineage level.</p>
	<p><b>Assistant Formula</b>: (x)%, where x is your current Lineage level.</p>
	<p><b>Offline Mana Formula</b>: (1.15 * x ^ 1.15)%, where x is your current Lineage level.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade6.png" align="middle"> Absent-mindedness</b></p>
	<p><b>Cost</b>: 1e167 Coins</p>
	<p><b>Effect</b>: Increase Offline production based on Excavation Depth and Excavation Resets made in this Reincarnation.</p>
	<p><b>Formula</b>: (30 + 0.75 * x ^ 0.75 + 4 * (1 + y + z) ^ 4)%, where x is Excavation Depth and y and z are free and ruby Excavation Resets made in this Reincarnation.</p>
	<hr>
	<p><b>Tier 3 Upgrades</b></p>
	<p><b><img src="/realm/Factions/picks/ArchonAlliance.png" align="middle"> Archon Alliance</b></p>
	<p><b>Cost</b>: 1 Dc (1e33) Angel and Undead Coins</p>
	<p><b>Effect</b>: Unlocks Archon Upgrades</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade7.png" align="middle"> Superior Consciousness</b></p>
	<p><b>Cost</b>: 1e173 Coins</p>
	<p><b>Effect</b>: Increase the production of Unique buildings based on their quantity.</p>
	<p><b>Formula</b>: (x)%, where x is Unique Buildings.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade8.png" align="middle"> Strange Attraction</b></p>
	<p><b>Cost</b>: 1e175 Coins</p>
	<p><b>Effect</b>: Multiplicatively increase Faction Coin find chance based on the activity time of your least used spell.</p>
	<p><b>Formula</b>: (100 + 0.8 * x ^ 0.8)%, where x is spell with least activity time this Reincarnation.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade9.png" align="middle"> Arcane Core</b></p>
	<p><b>Cost</b>: 1e177 Coins</p>
	<p><b>Effect</b>: Increase the production of all buildings based on mana produced in this Reincarnation.</p>
	<p><b>Formula</b>: (2.5 * (0.5 * ln(1 + x)) ^ 2.5)%, where x is mana produced in this Reincarnation.</p>
	<hr>
	<p><b><img src="/realm/Factions/picks/ArchonHeritage.png" align="middle"> Archon Heritage</b></p>
	<p><b>Requirements</b>: Archon Champion Trophy</p>
	<p><b>Cost</b>: 1 Ud (1e36) Angel and Undead Coins</p>
	<p><b>Effect</b>: Buildings, Assistants, Royal Exchanges, Spells cast and Clicks count more, by 10%.</p>
	<hr>
	<p><b>R130+</b></p>
	<p><b><img src="/realm/Factions/picks/NexusQuest.png" align="middle"> Nexus Quest</b></p>
	<p><b>Description</b>: Hassar, Ruler. Our kind wants to establish better communications with you. Please build more Wizard Towers/Witch Conclaves/Alchemist Labs to convert.</p>
	<p><b>Requirements</b>: R130+, Buy 25,000 Wizard Towers/Witch Conclaves/Alchemist Labs.</p>
	<p><b>Cost</b>: 1e177 Coins</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/NexusUpgrade.png" align="middle"> Unique Building Upgrade</b></p>
	<p><b>Requirements</b>: Nexus Quest.</p>
	<p><b>Cost</b>: 1e180 Coins</p>
	<p><b>Effect</b>: Gives Nexus Unique Building.</p>
	<br/>
	<p><b>Unique Building</b></p>
	<p><b><img src="/realm/Factions/picks/NexusUniqueBuilding.png" align="middle"></b></p>
	<p>Upgrade Wizard Towers/Witch Conclaves/Alchemist Labs to Nexuses, boosting their production based on time spent as Order and unlocking more unique perks for the building.</p>
	<p><b>Formula</b>: (80 * x ^ 0.8)%, where x is time spent as Order this Reincarnation.</p>
	<p><b>Requirement</b>: Nexus Quest.</p>
	<p><b>Effect</b>: Grants access to Faction Union.</p>
	<hr>
	<p><b>Tier 4 Upgrades</b></p>
	<p><b><img src="/realm/Factions/picks/ArchonUnion.png" align="middle"> Archon Union</b></p>
	<p><b>Requirements</b>: Nexus Unique Building</p>
	<p><b>Cost</b>: 1 Dd (1e39) Angel and Undead Coins</p>
	<p><b>Effect</b>: Grants access to Union Upgrades.</p>
	<p><b>Effect</b>: Temporal Flux also increases Maximum Mana.</p>
	<p><b>Formula</b>: (0.35 * (x / 60) ^ 0.825)%, where x is time spent in this Era.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade10.png" align="middle"> Purity of Form</b></p>
	<p><b>Requirements</b>: Archon Union</p>
	<p><b>Cost</b>: 1e183 Coins</p>
	<p><b>Effect</b>: Lineage levels count 200% more for all purposes.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade11.png" align="middle"> Absolute Hierarchy</b></p>
	<p><b>Requirements</b>: Archon Union</p>
	<p><b>Cost</b>: 1e185 Coins</p>
	<p><b>Effect</b>: All faction spells gain 1 tier.</p>
	<br/>
	<p><b><img src="/realm/Factions/picks/ArchonUpgrade12.png" align="middle"> Essence Extractor</b></p>
	<p><b>Requirements</b>: Archon Union</p>
	<p><b>Cost</b>: 1e187 Coins</p>
	<p><b>Effect</b>: Multiplicatively increase production bonus from Gems based on the duration of your longest spell.</p>
	<p><b>Formula</b>: (0.15 * x ^ 0.7)%, where x is the duration of your longest spell.</p>
<?php include "../scripts/footer.html"; ?>
