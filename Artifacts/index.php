<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
	<h6><img src='/realm/Factions/picks/ExcavationTopPage.png'></h6>
	<p><b>There are two kinds of artifacts</b></p>
	<p><a href="/realm/QuestArtifacts" research="Quest Artifacts"><b>Quest Artifacts</b></a> and <a href="/realm/LoreArtifacts" research="Lore Artifacts"><b>Lore Artifacts</b></a></p>
	<p>For Artifact Sets, go to <a href="/realm/ArtifactSet" research="Artifact Sets"><b>Artifact Sets</b></a></p>
	<p><b>In-game description</b></p>
	<p>Enter the Archeology Association to control the progress of your Excavations. There you will be able to fund more excavations to find Faction Coins, the rare Rubies and ancient Artifacts from the civilizations of the old.</p>
	<p>Archaeology was first implemented in the "Ancient Races" expansion for introducing the Neutral Factions.</p>
	<p>Excavating enables to find Rubies (See the <b><a target="_blank" href="/realm/Rubies/">Ruby</a></b> page), with luck: Faction Coins, and at certain thresholds or under certain conditions: Artifacts. Specific artifacts are required to unlock the Neutral & Prestige Factions.</p>
	<p>Some artifacts will reward direct bonuses and the amount of discovered artifacts take part in some Research upgrades.</p>
	<p><b>Requirements</b></p>
	<p>Archaeology is unlocked once you have over 1 B (1e9) gems, produced over 10 Oc (1e28) coins and bought the</p>
	<p><b><img src='/realm/Factions/picks/Archeology-upgrade.png' align='middle'> Archeology Upgrade</b>.</p>
	<p><b>Upgrade Cost</b>: 100 Oc (1e29). To be bought once throughout the entire game and permanently unlocks an "Excavation" button which will appear on the left under the Upgrades tab.</p>
	<br>
	<p>To unlock the chance to find <b>Lore Artifacts</b>, it requires the</p>
	<p><b><img src='/realm/Factions/picks/SurveyEquipment.png' align='middle'> Survey Equipment Upgrade</b>.</p>
	<p><b>Upgrade Cost</b>: 100 Dc (1e35) and at least 100 excavations. To be bought once throughout the entire game and does not show up as bought upgrade.</p>
	<hr>
	<p><b>Excavations</b></p>
	<p>The first excavation costs 1 Oc (1e27) coins, and each subsequent excavation costs without any cost multiplier reduction 20% more than the one before.</p>
	<p><b>Cost Formula for the x-th excavation</b>: (1e27 ^ (0.75 ^ A) * M ^ (x - 1)), where A is the number of times you have ascended and M the excavation cost multiplier.</p>
	<p>The <b>excavation cost multiplier</b> is equal to:<br/>
	   - A0: (1 + 0.2 - C), where C is the sum of your flat cost reduction upgrades (such as DN8 or E290).<br/>
	   - A1+: (1 + (0.2 - C) / (5 * A)), where C is the sum of your flat cost reduction upgrades and A is the number of times you have ascended.</p>
	<p>Every excavation awards Faction Coins in 4.3.15.</p>
	<p><b>Base Faction Coin Reward Formula</b>: (250 + floor(0.5 * x ^ 1.05)) ^ (1 + 0.35 * A), where x is current excavation depth and A is Ascensions. Applicable upgrades modify the base before the Ascension exponent.</p>
	<p><b>Note</b>: Every time you reincarnate or ascend, your excavation counter will be set back to zero.</p>
	<hr>
	<p><b>Excavation Reset</b></p>
	<p>To be able to do more excavations within a Reincarnation you can do an Excavation Reset, which also sets the counter back to zero. There are two options:<br>Ruby Reset and Free Reset.</p>
	<p><b>Ruby Cost for Ruby Reset</b>: (floor(x / 3000) + 1), where x is the number of excavations.</p>
	<p><b>Note</b>: Not recommended. It is better to spend rubies in ruby power, unless you have very specific reason to spend them on a reset.</p>
	<p><b>Free Reset Availability</b>: Ascension 1 and higher.</p>
	<p><b>Free Reset Coin Requirement Formula</b>: (G * (G + 1) / 2) * 10 ^ (3 * x - d), where G is the Gems required for the current Reincarnation, x is the number of Excavation Resets made in this Reincarnation and d is any order-of-magnitude reduction from upgrades.</p>
	<p><b>Note</b>: Resetting no longer removes coins, rewards or Rubies and no longer applies a production penalty. The requirement for the next reset increases.</p>
	<p><b>Note</b>: Each ruby found from excavation is a single all-time reward. No matter how the counter is set back to zero, you cannot find the same ruby again.</p>
	<hr>
	<p><img src="/realm/Factions/picks/QuestArtifacts.png" usemap="#QuestArtifacts-map"></p>
	<p><img src="/realm/Factions/picks/LoreArtifacts.png" usemap="#LoreArtifacts-map"></p>
	<map name="QuestArtifacts-map">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/AncientStoneSlab1.png&quot; align=&quot;middle&quot;> Ancient Stoneslab 1</b></p>
		<p><b>Description</b>: We discovered an ancient stone slab written in old scriptures. It appears to say something about Halls of Legends.</p>
		<p><b>Requirement</b>: 5th Excavation</p>
		<p><b>Effect</b>: 1st clue required to unlock the Titan Alliance.</p>
	" coords="3,43,56,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FossilizedPieceofBark1.png&quot; align=&quot;middle&quot;> Fossilized Piece of Bark 1</b></p>
		<p><b>Description</b>: We discovered a fossilized piece of Bark with the image of a Faction Coin carved into it.</p>
		<p><b>Requirement</b>: 10th Excavation</p>
		<p><b>Effect</b>: 1st clue required to unlock the Druid Alliance.</p>
	" coords="63,43,116,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/BoneFragment1.png&quot; align=&quot;middle&quot;> Bone Fragment 1</b></p>
		<p><b>Description</b>: We discovered a sundial shaped artefact, probably made of animal bones.</p>
		<p><b>Requirement</b>: 15th Excavation</p>
		<p><b>Effect</b>: 1st clue required to unlock the Faceless Alliance.</p>
	" coords="123,43,176,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/AncientStoneSlab2.png&quot; align=&quot;middle&quot;> Ancient Stoneslab 2</b></p>
		<p><b>Description</b>: We discovered an ancient stone slab written in old scriptures.We can recognize the number 300.</p>
		<p><b>Requirement</b>: 20th Excavation</p>
		<p><b>Effect</b>: 2nd clue required to unlock the Titan Alliance.</p>
	" coords="183,43,236,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FossilizedPieceofBark2.png&quot; align=&quot;middle&quot;> Fossilized Piece of Bark 2</b></p>
		<p><b>Description</b>: We discovered a fossilized piece of Bark with the symbol of One Million.</p>
		<p><b>Requirement</b>: 25th Excavation</p>
		<p><b>Effect</b>: 2nd clue required to unlock the Druid Alliance.</p>
	" coords="243,43,296,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/BoneFragment2.png&quot; align=&quot;middle&quot;> Bone Fragment 2</b></p>
		<p><b>Description</b>: We discovered an artefact shaped like the number 36, probably made of animal bones.</p>
		<p><b>Requirement</b>: 30th Excavation</p>
		<p><b>Effect</b>: 2nd clue required to unlock the Faceless Alliance.</p>
	" coords="303,43,356,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/KeytotheLostCity.png&quot; align=&quot;middle&quot;> Key to the Lost City</b></p>
		<p><b>Description</b>: Despite being thousands of years old, it's still shiny.</p>
		<p><b>Requirement</b>: R24+, 1500th Excavation</p>
		<p><b>Effect</b>: Part of the Neutral research quest</p>
	" coords="363,43,416,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/AncientDevice.png&quot; align=&quot;middle&quot;> Ancient Device</b></p>
		<p><b>Description</b>: This strange Device seems to react to the Ancient Races magical capabilities. We may channel its power to increase their research potential!</p>
		<p><b>Requirement</b>: Play any Neutral Faction, their Unique Building, 2000+ excavations.</p>
		<p><b>Effect</b>: Unlocks Ancient Device Power, which provides 1 additional slot for each Research branch the Neutral faction has affinity to (2 slots total).</p>
		<p><b>Chance</b>: 0.2% </p>
		<p><b>Cost</b>: 100 QiSxg (1e200)</p>
		<p><b>Note</b>: Has no effect in R100+</p>
	" coords="3,103,56,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/EarthCore.png&quot; align=&quot;middle&quot;> Earth Core</b></p>
		<p><b>Description</b>: This piece of rock is continuously shifting its shape, responding to mysterious energy sources.</p>
		<p><b>Requirement</b>: R29+, 2750th Excavation</p>
		<p><b>Effect</b>: Part of the Prestige research quest</p>
	" coords="63,103,116,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/HornoftheKings.png&quot; align=&quot;middle&quot;> Horn of the Kings</b></p>
		<p><b>Description</b>: It is said that when this horn is blown, the voices of past Dwarven Kings can be heard in the Wind.</p>
		<p><b>Requirement</b>: Dwarven Faction, Dwarven Forges, 3250+ Excavations</p>
		<p><b>Effect</b>: Unlocks Legacy of the Dwarven Kings, which adds 3 slots: 2 for Craftsmanship and 1 for the Good base faction's affinity.</p>
		<p><b>Chance</b>: 0.5%</p>
		<p><b>Cost</b></b>: 10 SxSpg (1e232) and 100 M (1e8) Dwarven Coins</p>
		<p><b>Note</b>: Has no effect in R100+</p>
	" coords="123,103,176,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FlameofBondelnar.png&quot; align=&quot;middle&quot;> Flame of Bondelnar</b></p>
		<p><b>Description</b>: The magical azure flame of Bondelnar constantly emanates a silent, yet subtle, evil aura.</p>
		<p><b>Requirement</b>: Drow Faction, Spider Sanctuaries, 3000+ Excavations</p>
		<p><b>Effect</b>: Unlocks the upgrade The Dark Light of Bondelnar that adds 3 extra slots: 2 for Warfare and 1 related to the Evil Base Faction's facility you are playing.</p>
		<p><b>Chance</b>: 0.5%</p>
		<p><b>Cost</b>: 10 SxSpg (1e232), 100 M (1e8) Drow Coins</p>
		<p><b>Note</b>: Has no effect in R100+</p>
	" coords="183,103,236,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SpikyRoughEggArtifact.png&quot; align=&quot;middle&quot;> Spiky Rough Egg</b></p>
		<p><b>Hint</b>: Excavate deeper around eggs.</p>
		<p><b>Description</b>: What a weird egg... it looks ages old, yet something alive is inside. Perhaps if you wait long enough, something will hatch?</p>
		<p><b>Requirement</b>: R46+, 1500 Excavations</p>
		<p><b>Effect</b>: Unlocks the Hatch! Egg</p>
		<p><b>Chance</b>: 2%</p>
	" coords="243,103,296,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ObsidianShardArtifact.png&quot; align=&quot;middle&quot;> Obsidian Shard</b></p>
		<p><b>Description</b>: Extremely hard and black as darkness itself, this material cannot apparently be carved or melted. It is a mystery how you can make this thing into a sword.</p>
		<p><b>Requirement</b>: R75+, any Faction, 8000th Excavation</p>
		<p><b>Effect</b>: Unlocks Secrets of the Warriors</p>
	" coords="303,103,356,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FirstIronFragment.png&quot; align=&quot;middle&quot;> First Iron Fragment</b></p>
		<p><b>Clue</b>: This one seems to require a lot of magical renewance.</p>
		<p><b>Description</b>: It looks like a piece of an iron object. It's broken off on two sides.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Angel Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + 30 * x) ^ 3 / 1,000,000 (1 M))%, where x is Mana Regeneration per tick; 30 * x is nominal Mana Regeneration per second.</p>
	" coords="363,103,416,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SecondIronFragment.png&quot; align=&quot;middle&quot;> Second Iron Fragment</b></p>
		<p><b>Clue</b>: Found via extensive Royal Trading mandates.</p>
		<p><b>Description</b>: It looks like a piece of an iron object. It's broken off on two sides.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Titan Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (x / 50,000,000 (50 M))%, where x is your Royal Exchange bonus.</p>
	" coords="3,163,56,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ThirdIronFragment.png&quot; align=&quot;middle&quot;> Third Iron Fragment</b></p>
		<p><b>Clue</b>: Chances to find increase while not actively searching.</p>
		<p><b>Description</b>: It looks like a piece of an iron object. It's broken off on two sides.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Undead Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 3 / 500,000)%, where x is your offline production bonus.</p>
	" coords="63,163,116,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FirstCrystalFragment.png&quot; align=&quot;middle&quot;> First Crystal Fragment</b></p>
		<p><b>Clue</b>: Assistants will lead the way.</p>
		<p><b>Description</b>: A strange, glass-like material that appears to have been shattered into three pieces.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Fairy Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (x / 1,000,000,000,000 (1 T))%, where x is assistant count (including temporary assistants).</p>
	" coords="123,163,176,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SecondCrystalFragment.png&quot; align=&quot;middle&quot;> Second Crystal Fragment</b></p>
		<p><b>Clue</b>: Are Faction Coins attracted to glass?</p>
		<p><b>Description</b>: A strange, glass-like material that appears to have been shattered into three pieces.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Faceless Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (4 * ln(1 + x) ^ 3 / 50,000,000 (50 M))%, where x is Faction Coins found this Era.</p>
	" coords="183,163,236,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ThirdCrystalFragment.png&quot; align=&quot;middle&quot;> Third Crystal Fragment</b></p>
		<p><b>Clue</b>: Also acts as a spell catalyst.</p>
		<p><b>Description</b>: A strange, glass-like material that appears to have been shattered into three pieces.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Demon Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (x / 1,000,000 (1 M))%, where x is evil spells cast this Reincarnation.</p>
	" coords="243,163,296,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FirstStoneFragment.png&quot; align=&quot;middle&quot;> First Stone Fragment</b></p>
		<p><b>Clue</b>: Click to Carve.</p>
		<p><b>Description</b>: Made from stone so ancient it is unknown to the current world. Two parts seem to be missing.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Elven Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 3 / 20,000)%, where x is the amount of clicks made in this Era.</p>
	" coords="303,163,356,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SecondStoneFragment.png&quot; align=&quot;middle&quot;> Second Stone Fragment</b></p>
		<p><b>Clue</b>: Stone to stone, buildings to buildings.</p>
		<p><b>Description</b>: Made from stone so ancient it is unknown to the current world. Two parts seem to be missing.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Druid Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (x / 5,000,000 (5 M))%, where x is the amount of buildings owned this Era.</p>
	" coords="363,163,416,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ThirdStoneFragment.png&quot; align=&quot;middle&quot;> Third Stone Fragment</b></p>
		<p><b>Clue</b>: Might be collected with taxes.</p>
		<p><b>Description</b>: Made from stone so ancient it is unknown to the current world. Two parts seem to be missing.</p>
		<p><b>Requirement</b>: R125+, Ascension 2+, Goblin Faction, 5,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 3 / 125,000)%, where x is Tax Collections cast in this Era.</p>
	" coords="3,223,56,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ObsidianCrown.png&quot; align=&quot;middle&quot;> Obsidian Crown</b></p>
		<p><b>Clue</b>: Only the wisest turns over the same stone twice. Or more.</p>
		<p><b>Description</b>: The legendary Black Crown of the Mercenary Lord. Some words are engraved into the inner circle at its base: &amp;quot;Aran en Ilya, Silas en Quenta&amp;quot;.</p>
		<p><b>Requirement</b>: R170+, play as Mercenary</p>
		<p><b>Effect</b>: Unlocks Mercenary Union Contract</p>
		<p><b>Chance</b>: (x / 1,000)%, where x is the number of free and ruby excavation resets in this Reincarnation.</p>
	" coords="63,223,116,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ForgottenRelic.png&quot; align=&quot;middle&quot;> Forgotten Relic</b></p>
		<p><b>Clue</b>: Research it!</p>
		<p><b>Description</b>: Intricate leylines of mana cover the surface of this stone, moving and flailing endlessly to create ever-different patterns.</p>
		<p><b>Requirement</b>: R180+</p>
		<p><b>Effect</b>: Unlocks Facility Research upgrades</p>
		<p><b>Note</b>: Each Facility needs their respective artifact and this artifact to get their respective upgrade.</p>
		<p><b>Chance</b>: ((2 * x) ^ 2 / 1,000,000,000 (1 B))%, where x is spent Research Budget.</p>
	" coords="123,223,176,276" shape="rect">
	</map>
	<map name="LoreArtifacts-map">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/RoughStone.png&quot; alt=&quot;Artifact&quot; align=&quot;middle&quot;> Rough Stone</b></p>
		<p><b>Hint</b>: A first-time only discovery.</p>
		<p><b>Description</b>: A common, totally uninteresting stone.</p>
		<p><b>Chance</b>: 2% on the first excavation of a run, after abdication or reincarnation.</p>
		<p><b>Effect</b>: Unlocks Research D290</p>
	" coords="3,43,56,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ScarabofFortune.png&quot; alt=&quot;Scarab of Fortune&quot; align=&quot;middle&quot;> Scarab of Fortune</b></p>
		<p><b>Hint</b>: Rarely found in the pyramids of old.</p>
		<p><b>Description</b>: You found the rarest of relics. This golden scarab will grant you 7 days of good luck, starting from now. Make good use of it.</p>
		<p><b>Chance</b>: (x / 1,000)%, where x is the amount of Ancient Pyramids you own.</p>
		<p><b>Effect</b>: Awards an upgrade of the same name that increases the production of all buildings by 0.1% for each trophy you unlocked.</p>
		<p><b>Cost</b>: 7 Td (7e42)</p>
	" coords="63,43,116,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ChocolateCookie.png&quot; alt=&quot;Chocolate Cookie&quot; align=&quot;middle&quot;> Chocolate Cookie</b></p>
		<p><b>Hint</b>: Excavated commonly in all areas.</p>
		<p><b>Description</b>: Found in a wasteland made of cakes and sweets, snatched from the hands of an old woman.</p>
		<p><b>Chance</b>: (x / 50)%, where x is the your Excavation count.</p>
	" coords="123,43,176,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FossilizedRodent.png&quot; alt=&quot;Fossilized Rodent&quot; align=&quot;middle&quot;> Fossilized Rodent</b></p>
		<p><b>Hint</b>: Hello, mouse.</p>
		<p><b>Description</b>: What's this, a prehistoric mouse...?</p>
		<p><b>Chance</b>: (x / 5,000,000 (5 M))%, where x is the amount of clicks made in this Reincarnation.</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increase clicking reward based on the amount of artifacts you discovered.</p>
		<p><b>Formula</b>: (10 * x)%, where x is number of artifacts you discovered.</p>
		<p><b>Cost</b>: 100 Qid (1e50)</p>
	" coords="183,43,236,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/PowerOrb.png&quot; alt=&quot;Power Orb&quot; align=&quot;middle&quot;> Power Orb</b></p>
		<p><b>Hint</b>: Attracted by massive concentration of mana.</p>
		<p><b>Description</b>: Throbbing with Arcane Power</p>
		<p><b>Requirement</b>: 3000+ Maximum Mana</p>
		<p><b>Chance</b>: (x / 15,000)%, where x is your Maximum Mana.</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Multiplicatively increases Mana Regeneration by 2.5%.</p>
		<p><b>Cost</b>: 1 QaVg (1e75), A1+: Free</p>
	" coords="243,43,296,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/PinkCarrot.png&quot; alt=&quot;Smiley face&quot; align=&quot;middle&quot;> Pink Carrot</b></p>
		<p><b>Hint</b>: Found randomly in the Farms.</p>
		<p><b>Description</b>: The main product of properly nurtured Farms.</p>
		<p><b>Requirement</b>: Fairy Faction (Not Dwarven)</p>
		<p><b>Chance</b>: (x / 5,000)%, where x is the amount of Farms you own.</p>
	" coords="303,43,356,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/BottledVoice.png&quot; alt=&quot;Smiley face&quot; align=&quot;middle&quot;> Bottled Voice</b></p>
		<p><b>Hint</b>: Can be captured when Chanting.</p>
		<p><b>Description</b>: The essence of a melodic Fairy voice.</p>
		<p><b>Requirement</b>: Fairy Faction (Not Dwarven)</p>
		<p><b>Chance</b>: (x ^ 1.5 / 100,000)%, where x is the amount of Fairy Chanting casts this Era.</p>
	" coords="363,43,416,96" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/LuckyClover.png&quot; alt=&quot;Smiley face&quot; align=&quot;middle&quot;> Lucky Clover</b></p>
		<p><b>Hint</b>: Requires extreme amounts of luck!</p>
		<p><b>Description</b>: A perfectly shaped four leaf clover. Each leaf is almost unnaturally identical to the other three.</p>
		<p><b>Requirement</b>: Elven Faction (Not Dwarven)</p>
		<p><b>Chance</b>: ((x - 1) * 50)%, where x is the highest number of consecutive Elven Lucks.</p>
	" coords="3,103,56,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Mini-treasure.png&quot; alt=&quot;Smiley face&quot; align=&quot;middle&quot;> Mini-treasure</b></p>
		<p><b>Hint</b>: Click your way to the treasure!</p>
		<p><b>Description</b>: It's a small perfect replica of our gold-filled treasure.</p>
		<p><b>Requirement</b>: Elven Faction (Not Dwarven)</p>
		<p><b>Chance</b>: (x / 3,000,000 (3 M))%, where x is the amount of clicks made this Era.</p>
	" coords="63,103,116,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Pillarfragment.png&quot; alt=&quot;Smiley face&quot; align=&quot;middle&quot;> Pillar Fragment</b></p>
		<p><b>Hint</b>: May fall from the Heavens.</p>
		<p><b>Description</b>: A tiny piece of the legendary pillars which sustain all the Heavens.</p>
		<p><b>Requirement</b>: Angel Faction (Not Dwarven)</p>
		<p><b>Chance</b>: (x / 3,750)%, where x is the amount of Heaven's Gates you own.</p>
	" coords="123,103,176,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DivineSword.png&quot; alt=&quot;Smiley face&quot; align=&quot;middle&quot;> Divine Sword</b></p>
		<p><b>Hint</b>: Only found by dedicated Angel allies.</p>
		<p><b>Description</b>: The shining golden sword of an Archangel. Its hilt feels pleasantly warm to the pure of heart and burning hot for the villain.</p>
		<p><b>Requirement</b>: Angel Faction (Not Dwarven), at least 4 hours spent as Angel in this Reincarnation.</p>
		<p><b>Chance</b>: (x / 86,400)%, where x is time spent as Angel in this Reincarnation, in seconds.</p>
	" coords="183,103,236,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/AncientCoinPiece.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Ancient Coin Piece</b></p>
		<p><b>Hint</b>: Rarely found among other special coins.</p>
		<p><b>Description</b>: A common goblin lucky charm. The older it is, the luckier you are, or so they say.</p>
		<p><b>Requirement</b>: Goblin Faction (Not Drow)</p>
		<p><b>Chance</b>: (x / 50,000,000 (50 M))%, where x is the amount of Faction Coins found this Reincarnation.</p>
	" coords="243,103,296,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/GoblinPurse.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Goblin Purse</b></p>
		<p><b>Hint</b>: Fill your pockets with extorted money.</p>
		<p><b>Description</b>: Heavy and roomy. Definitely too big for just pocket change.</p>
		<p><b>Requirement</b>: Goblin Faction (Not Drow)</p>
		<p><b>Chance</b>: (x / 300,000)%, where x is Tax collections cast this Era.</p>
	" coords="303,103,356,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/RottenOrgan.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Rotten Organ</b></p>
		<p><b>Hint</b>: Found among large masses of dead bodies.</p>
		<p><b>Description</b>: Ew... disgusting. It still pulses.</p>
		<p><b>Requirement</b>: Undead Faction (Not Drow)</p>
		<p><b>Chance</b>: (x / 500)%, where x is the amount of assistants you own.</p>
	" coords="363,103,416,156" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/JawBone.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Jaw Bone</b></p>
		<p><b>Hint</b>: Needs some time in the night.</p>
		<p><b>Description</b>: A jaw, missing more than half of its teeth.</p>
		<p><b>Requirement</b>: Undead Faction (Not Drow), at least 1 hour of Night Time activity in this Reincarnation.</p>
		<p><b>Chance</b>: (x / 36,000)%, where x is Night Time activity in this Reincarnation, in seconds.</p>
	" coords="3,163,56,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DemonicFigurine.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Demonic Figurine</b></p>
		<p><b>Hint</b>: Look for the trophies of the beast.</p>
		<p><b>Description</b>: An intricate figurine representing the evil face of a lesser demon.</p>
		<p><b>Requirement</b>: Demon Faction (Not Drow), 666+ Trophies unlocked.</p>
		<p><b>Chance</b>: 1%</p>
	" coords="63,163,116,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DemonHorn.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Demon Horn</b></p>
		<p><b>Hint</b>: Only found by dedicated Demon allies.</p>
		<p><b>Description</b>: Still blazing with the flames of Hell. Handle with care.</p>
		<p><b>Requirement</b>: Demon Faction (Not Drow), at least 4 hours spent as Demon in this Reincarnation.</p>
		<p><b>Chance</b>: (x / 86,400)%, where x is time spent as Demon in this Reincarnation, in seconds.</p>
	" coords="123,163,176,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/HugeTitanStatue.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Huge Titan Statue</b></p>
		<p><b>Hint</b>: Struck by the lightning.</p>
		<p><b>Description</b>: The granite representation of a giant wielding a lightning bolt in its fist. A foot appears to be missing.</p>
		<p><b>Requirement</b>: Titan Faction (Not Dragon)</p>
		<p><b>Chance</b>: (x / 1,000)%, where x is Lightning Strike casts this Era.</p>
	" coords="183,163,236,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/TitanShield.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Titan Shield</b></p>
		<p><b>Hint</b>: Don't fret it.</p>
		<p><b>Description</b>: A gargantuan metal shield, twice as tall as a common human.</p>
		<p><b>Requirement</b>: Titan Faction (Not Dragon), 10+ hours playtime (This Era)</p>
		<p><b>Chance</b>: (x / 180,000)%, where x is time played in this Era.</p>
	" coords="243,163,296,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/GlyphTable.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Glyph Table</b></p>
		<p><b>Hint</b>: Balance your buildings.</p>
		<p><b>Description</b>: Contains all the secrets of the Druidic Alphabet.</p>
		<p><b>Requirement</b>: Druid Faction (Not Dragon), same amount of each building tier</p>
		<p><b>Chance</b>: 2%</p>
	" coords="303,163,356,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/StoneOfBalance.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Stone of Balance</b></p>
		<p><b>Hint</b>: A Grand Balance performance.</p>
		<p><b>Description</b>: A carved stone hovering above its pedestal.</p>
		<p><b>Requirement</b>: Druid Faction (Not Dragon)</p>
		<p><b>Chance</b>: (x / 30,000)%, where x is Grand Balance casts this Era.</p>
	" coords="363,163,416,216" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/TranslucentGoo.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Translucent Goo</b></p>
		<p><b>Hint</b>: Byproduct of the Brain.</p>
		<p><b>Description</b>: A completely odorless sticky substance with a diaphanous, unsettling glow.</p>
		<p><b>Requirement</b>: Faceless Faction (Not Dragon)</p>
		<p><b>Chance</b>: (x / 400)%, where x is Brainwave casts this Era</p>
	" coords="3,223,56,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Octopus-shapedHelmet.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Octopus-shaped Helmet</b></p>
		<p><b>Hint</b>: Found in the Labyrinths.</p>
		<p><b>Description</b>: A large helmet with empty metal prongs to accommodate tentacular appendages.</p>
		<p><b>Requirement</b>: Faceless Faction (Not Dragon)</p>
		<p><b>Chance</b>: (x / 2,000)%, where x is the amount of Labyrinths you own.</p>
	" coords="63,223,116,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DwarvenBow.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Dwarven Bow</b></p>
		<p><b>Hint</b>: Click to throw.</p>
		<p><b>Description</b>: Actually a heavy throwing hammer.</p>
		<p><b>Requirement</b>: Dwarven Faction</p>
		<p><b>Chance</b>: (x / 25,000)%, where x is the amount of clicks made in this Era.</p>
	" coords="123,223,176,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/StoneTankard.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Stone Tankard</b></p>
		<p><b>Hint</b>: Found in the Inns.</p>
		<p><b>Description</b>: A very heavy mug for drinking the heaviest beers.</p>
		<p><b>Requirement</b>: Dwarven Faction</p>
		<p><b>Chance</b>: (x / 25,000)%, where x is the amount of Inns you own.</p>
	" coords="183,223,236,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/CeremonialDagger.png&quot; alt=&quot;Artifacts&quot; align=&quot;middle&quot;> Ceremonial Dagger</b></p>
		<p><b>Hint</b>: Avoid hurting your fingers.</p>
		<p><b>Description</b>: Its blade is unnaturally keen and sharp.</p>
		<p><b>Requirement</b>: Drow Faction, 0 Treasure clicks this Era (including automatic clicks)</p>
		<p><b>Chance</b>: 2%</p>
	" coords="243,223,296,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ArachnidFigurine.png&quot; alt=&quot;Arachnid Figurine&quot; align=&quot;middle&quot;> Arachnid Figurine</b></p>
		<p><b>Hint</b>: Embrace Evil. For a while.</p>
		<p><b>Description</b>: If you are afraid of spiders, Drow aren't your faction.</p>
		<p><b>Requirement</b>: Drow Faction, 24h+ Evil Playtime (All Time)</p>
		<p><b>Chance</b>: (x / 4,320,000 (4.32 M))%, where x is time spent as Evil (All Time).</p>
	" coords="303,223,356,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SteelPlate.png&quot; alt=&quot;Steel Plate&quot; align=&quot;middle&quot;> Steel Plate</b></p>
		<p><b>Hint</b>: Legacy from 50 generations ago.</p>
		<p><b>Description</b>: A full plate made of hardened steel.</p>
		<p><b>Requirement</b>: R5+, Mercenary Faction</p>
		<p><b>Chance</b>: (x / 50)%, where x is the amount of Reincarnation you made.</p>
	" coords="363,223,416,276" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/BlackSword.png&quot; alt=&quot;Black Sword&quot; align=&quot;middle&quot;> Black Sword</b></p>
		<p><b>Hint</b>: Only found by really, really dedicated Mercenary allies.</p>
		<p><b>Description</b>: A long sword with an extremely sharp blade made of dark metal.</p>
		<p><b>Requirement</b>: Mercenary Faction, at least 100 Mercenary affiliations (All Time)</p>
		<p><b>Chance</b>: (x / 60,000)%, where x is time spent as Mercenary (All Time).</p>
	" coords="3,283,56,336" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DragonFangArtifact.png&quot; alt=&quot;Dragon Fang&quot; align=&quot;middle&quot;> Dragon Fang</b></p>
		<p><b>Hint</b>: Found in the Wyrm Dens.</p>
		<p><b>Description</b>: This huge fang can barely fit in the hands of a Titan.</p>
		<p><b>Requirement</b>: R50+, Dragon Faction</p>
		<p><b>Chance</b>: (x / 400,000)%, where x is the amount of Iron Strongholds you own.</p>
	" coords="63,283,116,336" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DragonSoulArtifact.png&quot; alt=&quot;Dragon Soul&quot; align=&quot;middle&quot;> Dragon Soul</b></p>
		<p><b>Hint</b>: Take five deep breaths.</p>
		<p><b>Description</b>: The extracted soul from an ancient dragon, wields the power to end the world in an instant. Also makes a good soup ingredient.</p>
		<p><b>Requirement</b>: R50+, Dragon Faction, have 5 different Dragon Breath effects active simultaneously</p>
		<p><b>Chance</b>: (x / 200,000)%, where x is Dragon's Breath casts this Era.</p>
	" coords="123,283,176,336" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/VanillaFlavorJuice.png&quot; alt=&quot;Smiley face&quot; align=&quot;middle&quot;> Vanilla Flavor Juice</b></p>
		<p><b>Hint</b>: Quickly!</p>
		<p><b>Description</b>: An essence from extremely savory vanilla beans.</p>
		<p><b>Requirement</b>: R16+, any Vanilla Faction, first 5 minutes of the game</p>
		<p><b>Chance</b>: 20%</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increase the production of all buildings by 2,500% for the first 25 minutes (this Era) for all Vanilla factions. Does not work while offline.</p>
		<p><b>Cost</b>: 1 coin</p>
		<p><b>Note</b>: Effect is nullified if you affiliate with Prestige.</b>
	" coords="183,283,236,336" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/AncientCocoaBeanArtifacts.png&quot; align=&quot;middle&quot;> Ancient Cocoa Bean</b></p>
		<p><b>Hint</b>: True Neutral Flavor.</p>
		<p><b>Description</b>: Despite being centuries old, it still smells like top-quality cocoa.</p>
		<p><b>Requirement</b>: R24+, any Neutral Faction</p>
		<p><b>Chance</b>: 10%</p>
		<p><b>Effect</b>: Awards an upgrade named Chocolate Flavor Smoothie.</p>
		<p><b>Effect</b>: Increase the production of all buildings by 2,500% for the first 15 minutes (this Era) for all Neutral factions. Does not work while offline.</p>
		<p><b>Cost</b>: 1 coin</p>
		<p><b>Note</b>: Effect is nullified if you affiliate with Prestige.</b>
	" coords="243,283,296,336" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/KnowYourEnemyPartI.png&quot; align=&quot;middle&quot;> Know Your Enemy, Part I</b></p>
		<p><b>Hint</b>: A true Mercenary should learn by all other cultures.</p>
		<p><b>Description</b>: All the knowledge you need, stored in a handy book.</p>
		<p><b>Requirement</b>: R12+, Mercenary Faction, have upgrades from all 11 Factions</p>
		<p><b>Chance</b>: 10%</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increases the production of all buildings based on time spent as Non-Mercenary (All Time 'Time spent' with Factions in the stats). Only available to Mercenaries.</p>
		<p><b>Formula</b>: (0.75 * x ^ 0.6)%, where x is time spent as non-Mercenary factions (All Time).</p>
		<p><b>Cost</b>: 100 Vg (1e65)</p>
	" coords="303,283,356,336" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/VoodooDoll.png&quot; align=&quot;middle&quot;> Voodoo Doll</b></p>
		<p><b>Hint</b>: Found in the Witch Conclaves.</p>
		<p><b>Description</b>: You are now CURSED! And you feel a sting in your lower rear.</p>
		<p><b>Requirement</b>: R16+, Evil Alignment</p>
		<p><b>Chance</b>: (x / 10,000)%, where x is the amount of Witch Conclaves you own.</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increase the production of all building by 0.1% for each trophy you have unlocked.</p>
		<p><b>Cost</b>: 20 Qig (2e154)</p>
	" coords="363,283,416,336" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/WallFragment.png&quot; align=&quot;middle&quot;> Wall Fragment</b></p>
		<p><b>Hint</b>: Ascension...</p>
		<p><b>Description</b>: A fragment of an utterly and completely unbreakable wall. Enjoy your paradox.</p>
		<p><b>Requirement</b>: R40+</p>
		<p><b>Chance</b>: 10%</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increase the production of all buildings based on their tier.</p>
		<p><b>Formula</b>: (3 * (2 * (11 - T)) ^ 3)%, where T is building tier.</p>
		<?php echo realm_tier_table('wall-fragment'); ?>
		<p><b>Cost</b>: 1 M (1e6), A2+ free</p>
		<p><b>Alignment</b>: Any</p>
	" coords="3,343,56,396" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FortuntTellerMachineArtifact.png&quot; align=&quot;middle&quot;> Fortune Teller Machine</b></p>
		<p><b>Hint</b>: Don't choose your allies until you know more.</p>
		<p><b>Description</b>: Will tell you 1 of 24 statements at random.</p>
		<p><b>Requirement</b>: Not affiliated with any Faction</p>
		<p><b>Chance</b>: 0.1%</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Upgrade Requirement</b>: R40+</p>
		<p><b>Effect</b>: Increase the production of Non-Unique buildings based on time spent in this Reincarnation.</p>
		<p><b>Formula</b>: (6.5 * x ^ 0.65)%, where x is time spent in this Reincarnation.</p>
		<p><b>Cost</b>: 100 Qi (1e20), A2+ Free</p>
	" coords="63,343,116,396" shape="rect">
		<area target="_blank" href="/realm/SunForce/" research="
	<p><b><img src=&quot;/realm/Factions/picks/DawnstoneArtifact.png&quot; align=&quot;middle&quot;> Dawnstone</b></p>
		<p><b>Hint</b>: Relic of the Dawn hours.</p>
		<p><b>Description</b>: Only found during sunrise hours. Emits a faint glow.</p>
		<p><b>Requirement</b>: R16+, between 5:00 AM and 11:59 AM (your local time)</p>
		<p><b>Chance</b>: (x / 10,000)%, where x is your Excavation count.</p>
		<p><b>Effect</b>: With Both the Dawnstone and Duskstone artifacts, awards the Sun Force upgrade.</p>
		<p><b>Note</b>: Click image for details</p>
	" coords="123,343,176,396" shape="rect">
		<area target="_blank" href="/realm/SunForce/" research="
	<p><b><img src=&quot;/realm/Factions/picks/DuskstoneArtifact.png&quot; align=&quot;middle&quot;> Duskstone</b></p>
		<p><b>Hint</b>: Relic of the Dusk hours.</p>
		<p><b>Description</b>: Only found during sunset hours. Absorbs light in a small radius.</p>
		<p><b>Requirement</b>: R16+, between 6:00 PM and 8:59 PM (your local time)</p>
		<p><b>Chance</b>: (x / 10,000)%, where x is your Excavation count.</p>
		<p><b>Effect</b>: With Both the Dawnstone and Duskstone artifacts, awards the Sun Force upgrade.</p>
		<p><b>Note</b>: Click image for details</p>
		<br>
		<p><b>Note</b>: Finding both stones awards the <b><a target=&quot;_blank&quot; href=&quot;/realm/SunForce/&quot;>Sun Force</a></b> upgrade.</p>
	" coords="183,343,236,396" shape="rect">
		<area target="_blank" href="/realm/Lineages/#LineageCost" research="
	<p><b><img src=&quot;/realm/Factions/picks/AncientHeirloomTrophy.png&quot; align=&quot;middle&quot;> Ancient Heirloom</b></p>
		<p><b>Hint</b>: Relic of the Lineage.</p>
		<p><b>Description</b>: Passed down countless generations.</p>
		<p><b>Requirement</b>: Have at least 1 Lineage level purchased (R60+).</p>
		<p><b>Chance</b>: (x / 20)%, where x is the sum of all lineage levels.</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Note</b>: Click image for details</p>
		<p><b>Note</b>: For more details about Lineage Level cost see <b><a target=&quot;_blank&quot; href=&quot;/realm/Lineages/#LineageCost&quot;>Lineage</a></b> page.</p>
	" coords="243,343,296,396" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/KnowYourEnemyPart2.png&quot; align=&quot;middle&quot;> Know Your Enemy, Part II</b></p>
		<p><b>Hint</b>: Even an expert Mercenary should learn by all other cultures.</p>
		<p><b>Description</b>: Much more knowledge than you need, stored in a handy book.</p>
		<p><b>Requirement</b>: R75+, Mercenary Faction, Unique Building, have upgrades from all 12 Factions</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increases the production of all buildings based on time spent as Non-Mercenary (All Time 'Time spent' with Factions in the stats). Only available to Mercenaries.</p>
		<p><b>Formula</b>: (0.065 * x ^ 0.65)%, where x is time spent as non-mercenary factions in seconds (All Time).</p>
		<p><b>Chance</b>: 5%</p>
		<p><b>Cost</b>: 100 Noqag (1e152)</p>
	" coords="303,343,356,396" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/VeteranFigurineArtifact.png&quot; align=&quot;middle&quot;> Veteran Figurine</b></p>
		<p><b>Hint</b>: A reward for the veteran challenger.</p>
		<p><b>Description</b>: The warrior of a thousand battles, ultimate champion of the Realms.</p>
		<p><b>Requirement</b>: R85+, Dracomet Vault (Dragon Challenge 6)</p>
		<p><b>Chance</b>: (x / 1,000,000)%, where x is time spent in this Era in seconds.</p>
		<p><b>Effect</b>: Passive effect: allows Mercenaries to benefit from all faction challenges.</p>
		<p><b>Note</b>: This effect does not function in Ascension 3 or later.</p>
	" coords="363,343,416,396" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/WallChunkArtifact.png&quot; align=&quot;middle&quot;> Wall Chunk</b></p>
		<p><b>Hint</b>: More Ascension...</p>
		<p><b>Description</b>: A bigger piece of the infamous Ascension Wall.</p>
		<p><b>Requirement</b>: R100+</p>
		<p><b>Chance</b>: 10%</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increase the production of all buildings based on their tier.</p>
		<p><b>Formula</b>: (30,000 * (11 - T) ^ 3.5)%, where T is building tier.</p>
		<?php echo realm_tier_table('wall-chunk'); ?>
		<p><b>Cost</b>: 1 Sx (1e21), A3+ Free</p>
	" coords="3,403,56,456" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ExcavatedMirageArtifact.png&quot; align=&quot;middle&quot;> Excavated Mirage</b></p>
		<p><b>Hint</b>: Raise your chances.</p>
		<p><b>Description</b>: You know all too well this does not exist, yet it fills you with hope and optimism.</p>
		<p><b>Requirement</b>: R100+</p>
		<p><b>Chance</b>: (ln(1 + x) / 200)%, where x is your Faction Coin find chance.</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Effect</b>: Increase Faction Coin find chance by a multiplicative 200%.</p>
		<p><b>Cost</b>: 1 Sx (1e21), A3+ Free</p>
	" coords="63,403,116,456" shape="rect">
		<area target="_blank" href="/realm/Lineages/#LineageCost" research="
	<p><b><img src=&quot;/realm/Factions/picks/AncestralHourglassArtifact.png&quot; align=&quot;middle&quot;> Ancestral Hourglass</b></p>
		<p><b>Hint</b>: Really, raise your chances.</p>
		<p><b>Description</b>: The silver sands contained within seem to never stop flowing.</p>
		<p><b>Requirement</b>: R100+</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 1.5 / 5,000)%, where x is your Faction Coin find chance.</p>
		<p><b>Effect</b>: Awards an upgrade of the same name.</p>
		<p><b>Note</b>: Click image for details</p>
		<p><b>Note</b>: For more details about Lineage Level cost see <b><a target=&quot;_blank&quot; href=&quot;/realm/Lineages/#LineageCost&quot;>Lineage</a></b> page.</p>
	" coords="123,403,176,456" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SilkClothArtifact.png&quot; align=&quot;middle&quot;> Silk Cloth</b></p>
		<p><b>Hint</b>: Found in the Swarming Towers.</p>
		<p><b>Description</b>: The purest silk made for Fairies, by Fairies, of Fairies.</p>
		<p><b>Requirement</b>: R100+, Fairy Faction, Pink Carrot and Bottled Voice artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x / 400,000)%, where x is the amount of Wizard Towers you own (Building count multipliers <b>do not</b> count).</p>
	" coords="183,403,236,456" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/RawEmeraldArtifact.png&quot; align=&quot;middle&quot;> Raw Emerald</b></p>
		<p><b>Hint</b>: Not found on the first Excavation round.</p>
		<p><b>Description</b>: Just slightly less precious than a raw Ruby.</p>
		<p><b>Requirement</b>: R100+, Elven Faction, Lucky Clover and Mini-treasure artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (((3 * x) ^ 4.5) / 10,000)%, where x is free and ruby excavation resets (this Era).</p>
	" coords="243,403,296,456" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FossilizedWingArtifact.png&quot; align=&quot;middle&quot;> Fossilized Wing</b></p>
		<p><b>Hint</b>: Angels may fall after a long time.</p>
		<p><b>Description</b>: The remains of an Angel fallen to earth.</p>
		<p><b>Requirement</b>:  R100+, Angel Faction, Pillar Fragment and Divine Sword artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x / 2,592,000 (2.592 M))%, where x is time spent with Angels (All Time).</p>
	" coords="303,403,356,456" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SpikedWhipArtifact.png&quot; align=&quot;middle&quot;> Spiked Whip</b></p>
		<p><b>Hint</b>: Used by the overseers in the Slave Markets.</p>
		<p><b>Description</b>: Use with caution. You do not want to exterminate all your slaves.</p>
		<p><b>Requirement</b>: R100+, Goblin Faction, Ancient Coin Piece and Goblin Purse artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x / 500,000)%, where x is the amount of Slave Pens you own (Building count multipliers <b>do not</b> count).</p>
	" coords="363,403,416,456" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DustyCoffinArtifact.png&quot; align=&quot;middle&quot;> Dusty Coffin</b></p>
		<p><b>Hint</b>: The undead have patience.</p>
		<p><b>Description</b>: Sealed since forever, yet you can hear a strange noise from within.</p>
		<p><b>Requirement</b>: R100+, Undead Faction, Rotten Organ and Jaw Bone artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x / 2,592,000 (2.592 M))%, where x is Undead playtime without abdicating, in seconds.</p>
	" coords="3,463,56,516" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/CrystallizedLavaArtifact.png&quot; align=&quot;middle&quot;> Crystallized Lava</b></p>
		<p><b>Hint</b>: Found in the Burning Abysses.</p>
		<p><b>Description</b>: Incandescent but still. Can be used efficiently as a desk lamp.</p>
		<p><b>Requirement</b>: R100+, Demon Faction, Demonic Figurine and Demon Horn artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x / 200,000)%, where x is the amount of Hall of Legends you own (Building count multipliers <b>do not</b> count).</p>
	" coords="63,463,116,516" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/TitanHelmetArtifact.png&quot; align=&quot;middle&quot;> Titan Helmet</b></p>
		<p><b>Hint</b>: Found in the trade route used for Exchanges.</p>
		<p><b>Description</b>: Made of enough metal to craft a human-sized full plate.</p>
		<p><b>Requirement</b>: R100+, Titan Faction, Huge Titan Statue and Titan Shield artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x ^ 2 / 500,000,000 (500 M))%, where x is Royal Exchanges (Royal Exchange count multipliers <b>do not</b> count).</p>
	" coords="123,463,176,516" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/BranchoftheLifeTreeArtifact.png&quot; align=&quot;middle&quot;> Branch of the Life Tree</b></p>
		<p><b>Hint</b>: Found in the remains of druidic ancestors.</p>
		<p><b>Description</b>: Despite being torn from its source tree, it keeps growing buds and leaves.</p>
		<p><b>Requirement</b>: R100+, Druid Faction, Glyph Table and Stone of Balance artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x ^ 3 / 1,000,000 (1 M))%, where x is the level of Druid Lineage.</p>
	" coords="183,463,236,516" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/NightmareFigmentArtifact.png&quot; align=&quot;middle&quot;> Nightmare Figment</b></p>
		<p><b>Hint</b>: A strong and quick brain is required.</p>
		<p><b>Description</b>: An unshaped, ephemeral substance which is politely trying to corrupt your mind.</p>
		<p><b>Requirement</b>: R100+, Faceless Faction, Translucent Goo and Octupus-shaped Helmet artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x ^ 1.5 / 1,000,000 (1 M))%, where x is Brainwave's headstart time.</p>
	" coords="243,463,296,516" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/BeardHair.png&quot; align=&quot;middle&quot;> Beard Hair</b></p>
		<p><b>Hint</b>: It requires a lot of beard samples to get the perfect hair.</p>
		<p><b>Description</b>: Hopefully coming from a real dwarven beard.</p>
		<p><b>Requirement</b>: R116+, Dwarven Faction, Stone Tankard and Dwarven Bow artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x / 10,000,000,000,000 (10 T))%, where x is the amount of assistants you own (including temporary assistants).</p>
	" coords="303,463,356,516" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/PoisonVial.png&quot; align=&quot;middle&quot;> Poison Vial</b></p>
		<p><b>Hint</b>: Combo your way through.</p>
		<p><b>Description</b>: One drop of this is enough to fell thousands of non-immune creatures.</p>
		<p><b>Requirement</b>: R116+, Drow Faction, Ceremonial Dagger and Arachnid Figurine artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: ((40 * x ^ 0.9) / 10,000,000 (10 M))%, where x is combo strike counter.</p>
	" coords="363,463,416,516" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DragonScale.png&quot; align=&quot;middle&quot;> Dragon Scale</b></p>
		<p><b>Hint</b>: Usually found when a lot of magic is lingering.</p>
		<p><b>Description</b>: Very high on the realms' most accurate hardiness rankings.</p>
		<p><b>Requirement</b>: R116+, Dragon Faction, Dragon Fang and Dragon Soul artifacts, 2000+ Excavations</p>
		<p><b>Chance</b>: (x / 2,000)%, where x is the amount of active spells, including spell tiers.</p>
	" coords="3,523,56,576" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/LanternofGuidanceArtifact.png&quot; align=&quot;middle&quot;> Lantern of Guidance</b></p>
		<p><b>Hint</b>: Massive mana flows can offer guidance.</p>
		<p><b>Description</b>: Follow the guiding light, o wonderer, for it shall bring you fortune.</p>
		<p><b>Requirement</b>: R120+, Proof of Order</p>
		<p><b>Chance</b>: (ln(30 * x) ^ 3 / 234,567)%, where x is Mana Regeneration per tick; 30 * x is nominal Mana Regeneration per second.</p>
		<p><b>Effect</b>: Unlocks the Lantern of Guidance upgrade for 1e136 coins. It increases all building production by (4 * (30 * x) ^ 0.2)%, raised to the power of 1.5 while affiliated with an Order faction, where x is Mana Regeneration per tick; 30 * x is nominal Mana Regeneration per second.</p>
	" coords="63,523,116,576" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/OilLampArtifact.png&quot; align=&quot;middle&quot;> Oil Lamp</b></p>
		<p><b>Hint</b>: Chaos magic burns brightly.</p>
		<p><b>Description</b>: Rub it, polish it. And remember to express your desires precisely, lest you want to face dire consequences.</p>
		<p><b>Requirement</b>: R120+, Proof of Chaos</p>
		<p><b>Chance</b>: (min(x, y, z) / 6,480,000 (6.48 M))%, where x is Fairy Chanting spell activity time, y is Hellfire Blast spell activity time, and z is Brainwave spell activity time (All Time).</p>
		<p><b>Effect</b>: Unlocks the Oil Lamp upgrade for 1e136 coins. It increases all building production by (9 * x ^ 0.2)%, raised to the power of 1.5 while affiliated with a Chaos faction, where x is Maximum Mana.</p>
	" coords="123,523,176,576" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SparkofLifeArtifact.png&quot; align=&quot;middle&quot;> Spark of Life</b></p>
		<p><b>Hint</b>: The power of Creation may spark something new.</p>
		<p><b>Description</b>: The spark of Creation, dimly shining from the bottom of its encasing crystal.</p>
		<p><b>Requirement</b>: R120+, Proof of Balance</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 2 / 240,000)%, where x is the amount of Faction Coins collected this Era.</p>
		<p><b>Effect</b>: Unlocks the Spark of Life upgrade for 1e136 coins. It increases all building production by (x ^ 0.2)%, raised to the power of 1.5 while affiliated with a Balance faction, where x is Faction Coin find chance.</p>
	" coords="183,523,236,576" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/PlanetaryForceArtifact.png&quot; align=&quot;middle&quot;> Planetary Force</b></p>
		<p><b>Hint</b>: Try every day for better luck! Missing a day is the same as breaking a mirror, you know.</p>
		<p><b>Description</b>: Planets aligning seem to affect your realm in different ways...</p>
		<p><b>Requirement</b>: R100+, Ascension 2+, Dawnstone and Duskstone</p>
		<p><b>Chance</b>: ((x ^ 2.5) / 2,500)%, where x is amount of consecutive days logged in.</p>
		<p><b>Effect</b>: Awards an upgrade with the same name.</p>
		<p><b>Effect</b>: Activates all Sun Force effects at once.</p>
		<p><b>Cost</b>: 100 Qi (1e20), A3+ Free</p>
	" coords="243,523,296,576" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/MercenaryInsigniaArtifact.png&quot; align=&quot;middle&quot;> Mercenary Insignia</b></p>
		<p><b>Hint</b>: Gem rhabdomancy seems to work best.</p>
		<p><b>Description</b>: The infamous metal cross of the Mercenaries. You should be both proud and afraid to carry one.</p>
		<p><b>Requirement</b>: R160+, Ascension 3+, Mercenary Faction, Steel Plate and Black Sword artifacts</p>
		<p><b>Chance</b>: ((0.5 * floor(log10(x))) ^ 2 / 10,000)%, where x is the amount of gems owned.</p>
	" coords="303,523,356,576" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/ManaLoom.png&quot; align=&quot;middle&quot;> Mana Loom</b></p>
		<p><b>Hint</b>: Attracted by amassed mana reserves.</p>
		<p><b>Description</b>: Used to weave even the thinnest mana strings.</p>
		<p><b>Requirement</b>: R180+, Chaos Alignment, 5,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 3 / 400,000)%, where x is the amount of Mana produced in this Era.</p>
		<p><b>Effect</b>: Awards upgrade with same name.</p>
	" coords="363,523,416,576" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Factory.png&quot; align=&quot;middle&quot;> Factory</b></p>
		<p><b>Hint</b>: Dig it manually.</p>
		<p><b>Description</b>: Mass-production is the way to go.</p>
		<p><b>Requirement</b>: R180+, Neutral Alignment, 5,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 3 / 80,000)%, where x is the amount of clicks made in this Era.</p>
		<p><b>Effect</b>: Awards upgrade with same name.</p>
	" coords="3,583,56,636" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Mythos.png&quot; align=&quot;middle&quot;> Mythos</b></p>
		<p><b>Hint</b>: Spells become happy when used for a long time.</p>
		<p><b>Description</b>: Accurate historical list of every existing or non-existing deity.</p>
		<p><b>Requirement</b>: R180+, Good Alignment, 5,000+ Excavations</p>
		<p><b>Chance</b>: (x / 2,160,000 (2.16 M))%, where x is the activity time in this Reincarnation of your least used spell (excluding Share Benefits, Catalyst and Event spells).</p>
		<p><b>Effect</b>: Awards upgrade with same name.</p>
	" coords="63,583,116,636" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Vault.png&quot; align=&quot;middle&quot;> Vault</b></p>
		<p><b>Hint</b>: Show your prowess as a Royal Trader.</p>
		<p><b>Description</b>: Never a place could be more secure.</p>
		<p><b>Requirement</b>: R180+, Balance Alignment, 5,000+ Excavations</p>
		<p><b>Chance</b>: (x / 100,000,000 (100 M))%, where x is Royal Exchange Bonus.</p>
		<p><b>Effect</b>: Awards upgrade with same name.</p>
	" coords="123,583,176,636" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Athanor.png&quot; align=&quot;middle&quot;> Athanor</b></p>
		<p><b>Hint</b>: Archemy.</p>
		<p><b>Description</b>: The legendary oven that could smelt souls into matter.</p>
		<p><b>Requirement</b>: R180+, Order Alignment, 5,000+ Excavations</p>
		<p><b>Chance</b>: (x / 1,000,000 (1 M))%, where x is Alchemy research points.</p>
		<p><b>Effect</b>: Awards upgrade with same name.</p>
	" coords="183,583,236,636" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Battlefield.png&quot; align=&quot;middle&quot;> Battlefield</b></p>
		<p><b>Hint</b>: Would you think an army is enough to excavate this?</p>
		<p><b>Description</b>: An extremely accurate replica of a battle fought long ago.</p>
		<p><b>Requirement</b>: R180+, Evil Alignment, 5,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) ^ 3 / 160,000)%, where x is amount of assistants you own.</p>
		<p><b>Effect</b>: Awards an upgrade with same name.</p>
	" coords="243,583,296,636" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/Apeiron.png&quot; align=&quot;middle&quot;> Apeiron</b></p>
		<p><b>Hint</b>: Be different.</p>
		<p><b>Description</b>: The source of everything. Can fit in the average pocket.</p>
		<p><b>Requirement</b>: R175+, Mercenary, 15 different Faction upgrades</p>
		<p><b>Chance</b>: 0.1%</p>
		<p><b>Effect</b>: Awards an upgrade with same name.</p>
	" coords="303,583,356,636" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/GlowingWingArtifact.png&quot; align=&quot;middle&quot;> Glowing Wing</b></p>
		<p><b>Hint</b>: Mana Wings!</p>
		<p><b>Description</b>: And this is why Fairies don't need torches.</p>
		<p><b>Requirement</b>: R225+, Fairy Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) / 8,000)%, where x is Mana produced this Era.</p>
	" coords="363,583,416,636" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SylvanMirrorArtifact.png&quot; align=&quot;middle&quot;> Sylvan Mirror</b></p>
		<p><b>Hint</b>: Pay a barber with Faction Coins.</p>
		<p><b>Description</b>: An Elf with messy hair is not an Elf, by their own laws.</p>
		<p><b>Requirement</b>: R225+, Elven Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) / 8,000)%, where x is your Faction Coin find chance.</p>
	" coords="3,643,56,696" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/SolidCloudArtifact.png&quot; align=&quot;middle&quot;> Solid Cloud</b></p>
		<p><b>Hint</b>: A cloud of spells.</p>
		<p><b>Description</b>: Angels have the power to save your life! And make a backup of it on the internet.</p>
		<p><b>Requirement</b>: R225+, Angel Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (x / 20,000)%, where x is the number of active spells, including additional spell tiers.</p>
	" coords="63,643,116,696" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/OrcFangNecklaceArtifact.png&quot; align=&quot;middle&quot;> Orc Fang Necklace</b></p>
		<p><b>Hint</b>: Torment your subjects with taxes.</p>
		<p><b>Description</b>: To remind your slaves who's in charge.</p>
		<p><b>Requirement</b>: R225+, Goblin Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) / 8,000)%, where x is Tax Collection casts in this Era.</p>
	" coords="123,643,176,696" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/BloodChaliceArtifact.png&quot; align=&quot;middle&quot;> Blood Chalice</b></p>
		<p><b>Hint</b>: Pour a bottle of Frenzy.</p>
		<p><b>Description</b>: The healthiest vampire breakfast.</p>
		<p><b>Requirement</b>: R225+, Undead Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (x / 10,000)%, where x is Blood Frenzy's duration (The duration when it was cast).</p>
	" coords="183,643,236,696" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DemonTailArtifact.png&quot; align=&quot;middle&quot;> Demon Tail</b></p>
		<p><b>Hint</b>: Evil wizardry.</p>
		<p><b>Description</b>: Said to bring great luck to whom it possess...es.</p>
		<p><b>Requirement</b>: R225+, Demon Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (x / 100,000)%, where x is Evil Spell Casts in this Era.</p>
	" coords="243,643,296,696" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/FrozenLightningArtifact.png&quot; align=&quot;middle&quot;> Frozen Lightning</b></p>
		<p><b>Hint</b>: Lightning never strikes the same place a couple million times. Maybe.</p>
		<p><b>Description</b>: A sculpture representing the embodiment of Titanic power.</p>
		<p><b>Requirement</b>: R225+, Titan Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (x / 100,000)%, where x is Lightning Strike activity time in this Era.</p>
	" coords="303,643,356,696" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/PrimalLeafArtifact.png&quot; align=&quot;middle&quot;> Primal Leaf</b></p>
		<p><b>Hint</b>: Huuuuge blue ball.</p>
		<p><b>Description</b>: Druid Catalyst for channeling the power of nature.</p>
		<p><b>Requirement</b>: R225+, Druid Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) / 16,000)%, where x is the highest Maximum Mana in this Reincarnation.</p>
	" coords="363,643,416,696" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/TheBlackestInkArtifact.png&quot; align=&quot;middle&quot;> The Blackest Ink</b></p>
		<p><b>Hint</b>: Quality takes time.</p>
		<p><b>Description</b>: High-quality, freshly produced Faceless ink.</p>
		<p><b>Requirement</b>: R225+, Faceless Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (x / 8,000)%, where x is the longest game session this Reincarnation (but <b>not</b> this Era).</p>
	" coords="3,703,56,756" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/DwarvenAnvilArtifact.png&quot; align=&quot;middle&quot;> Dwarven Anvil</b></p>
		<p><b>Hint</b>: Dwarven clicks!</p>
		<p><b>Description</b>: Every dwarven child is required to bring this to school every day.</p>
		<p><b>Requirement</b>: R235+, Dwarven Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) / 20,000)%, where x is your number of clicks in this Reincarnation.</p>
	" coords="63,703,116,756" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/StilettoHeelArtifact.png&quot; align=&quot;middle&quot;> Stiletto Heel</b></p>
		<p><b>Hint</b>: A drow trade.</p>
		<p><b>Description</b>: Drow make the most beautiful underground females.</p>
		<p><b>Requirement</b>: R235+, Drow Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (x / 10,000)%, where x is the number of Royal Exchanges you have.</p>
	" coords="123,703,176,756" shape="rect">
		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/EyeOfTheDragonArtifact.png&quot; align=&quot;middle&quot;> Eye Of The Dragon</b></p>
		<p><b>Hint</b>: Draconic Assistants.</p>
		<p><b>Description</b>: The ultimate thrill of the fight.</p>
		<p><b>Requirement</b>: R235+, Dragon Faction, Ascension 4+, 10,000+ Excavations</p>
		<p><b>Chance</b>: (ln(1 + x) / 20,000)%, where x is the highest amount of assistants you had in this Reincarnation.</p>
	" coords="183,703,236,756" shape="rect">

		<area research="
	<p><b><img src=&quot;/realm/Factions/picks/MaskOfScorchRahArtifact.png&quot; align=&quot;middle&quot;> Mask of Scorch'Rah</b></p>
		<p><b>Hint</b>: The time has come...</p>
		<p><b>Description</b>: An otherworldly, ever-burning mask that continuously shifts burn marks over its surface.</p>
		<p><b>Requirement</b>: A4+, R255+, 50,000+ Excavations and at least 4 Legacy upgrades purchased.</p>
		<p><b>Chance</b>: (x / 1,000,000)%, where x is time spent in this Era, in seconds.</p>
	" coords="243,703,296,756" shape="rect">
	</map>
<?php include "../scripts/footer.html"; ?>
