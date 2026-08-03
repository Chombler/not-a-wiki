<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
	<h6><img src="/realm/Factions/picks/ExcavationTopPage.png"></h6>
	<h6>Artifact Sets</h6>
	<p><b>Finding all the faction artifacts for a specific faction</b>(R100+) will also unlock a new selection of upgrades called "Artifact Sets". You will be able to pick one per game only, similar to Bloodlines and Lineages. Abdicating will reset your choice and allow to pick another.</p>
	<p><b>Requires all lore artifacts related to the faction to use its set.</b> All artifacts can be found on the <a href="/realm/LoreArtifacts" research="Lore Artifacts"><b>Lore Artifacts</b></a> page.</p>
	<p>Artifact Set upgrades are free and do not suffer from Ascension penalties.</p>
	<h6><center><img src="/realm/Factions/picks/ArtifactSets.png" usemap="#ArtifactSets-map"></h6></center>
	<map name="ArtifactSets-map">
		<area href="#Fairy" target="" research="
		<p><b><img src='/realm/Factions/picks/FairySet.png' align='middle'> Fairy Set</b></p>
		<p><b>Requirement</b>: R100+, Pink Carrot, Bottled Voice, Silk Cloth</p>
		<p><b>Effect</b>: Multiplicatively increase Maximum Mana based on the amount of Good Buildings owned.</p>
		<p><b>Formula</b>: (x ^ 0.5)%, where x is the amount of Good Buildings you own.</p>
		<p><b>Second Effect Requirement</b>: R225+, Glowing Wing</p>
		<p><b>Effect</b>: Farms, Inns and Blacksmiths count more based on the amount of time spent with Fairies in this Reincarnation.</p>
		<p><b>Formula</b>: (2 * ln(1 + x) ^ 1.5)%, where x is time spent with Fairies in this Reincarnation.</p>
		" coords="10,10,64,64" shape="rect">
		<area href="#Elven" target="" research="
		<p><b><img src='/realm/Factions/picks/ElvenSet.png' align='middle'> Elven Set</b></p>
		<p><b>Requirement</b>: R100+, Lucky Clover, Mini-treasure, Raw Emerald</p>
		<p><b>Effect</b>: Autoclicks 10 times per second.</p>
		<p><b>Note</b>: Also generates the same amount of clicks offline.</p>
		<p><b>Second Effect Requirement</b>: R225+, Sylvan Mirror</p>
		<p><b>Effect</b>: Clicks count more based on automatic clicks.</p>
		<p><b>Formula</b>: (ln(1 + x) ^ 2.5 + x ^ 0.25)%, where x is automatic clicks this Era.</p>
		<p><b>Note</b>: NOT affected by any 'clicks count more' effects.</p>
		" coords="70,10,124,64" shape="rect">
		<area href="#Angel" target="" research="
		<p><b><img src='/realm/Factions/picks/AngelSet.png' align='middle'> Angel Set</b></p>
		<p><b>Requirement</b>: R100+, Pillar Fragment, Divine Sword, Fossilized Wing</p>
		<p><b>Effect</b>: Additively increase Mana Regeneration based on highest amount of spells cast in a single Era.</p>
		<p><b>Formula</b>: +(3.5 * x ^ 0.35), where x is spells cast in a single Era.</p>
		<p><b>Second Effect Requirement</b>: R225+, Solid Cloud</p>
		<p><b>Effect</b>: Increase the duration of all spells based on the amount of Unique Buildings you own.</p>
		<p><b>Formula</b>: (x ^ 0.5)%, where x is Unique Buildings built.</p>
		" coords="130,10,184,64" shape="rect">
		<area href="#Goblin" target="" research="
		<p><b><img src='/realm/Factions/picks/GoblinSet.png' align='middle'> Goblin Set</b></p>
		<p><b>Requirement</b>: R100+, Ancient Coin Piece, Goblin Purse, Spiked Whip</p>
		<p><b>Effect</b>: Increase Faction Coin find chance additively and multiplicatively based on time spent in this Era.</p>
		<p><b>Additive Formula</b>: +(70 * x ^ 0.7)%, where x is time spent in this Era.</p>
		<p><b>Multiplicative Formula</b>: (0.6 * x ^ 0.6)%, where x is time spent in this Era.</p>
		<p><b>Second Effect Requirement</b>: R225+, Orc Fang Necklace</p>
		<p><b>Effect</b>: Each time you cast a spell, you also cast free Tax Collections based on time spent in this Era.</p>
		<p><b>Formula</b>: +(floor(1 + 0.25 * ln(1 + x) ^ 1.5)), where x is time spent this Era.</p>
		" coords="10,70,64,124" shape="rect">
		<area href="#Undead" target="" research="
		<p><b><img src='/realm/Factions/picks/UndeadSet.png' align='middle'> Undead Set</b></p>
		<p><b>Requirement</b>: R100+, Rotten Organ, Jaw Bone, Dusty Coffin</p>
		<p><b>Effect</b>: Additively Increase max mana based on offline bonus.</p>
		<p><b>Formula</b>: +(7500 + 7.5 * ln(1 + x) ^ 3.75), where x is offline Multiplier.</p>
		<p><b>Second Effect Requirement</b>: R225+, Blood Chalice</p>
		<p><b>Effect</b>: Multiplicatively increases production bonus from Gems based on Faction Coins found this Era.</p>
		<p><b>Formula</b>: (ln(1 + x) ^ 2)%, where x is Faction Coins found this Era.</p>
		" coords="70,70,124,124" shape="rect">
		<area href="#Demon" target="" research="
		<p><b><img src='/realm/Factions/picks/DemonSet.png' align='middle'> Demon Set</b></p>
		<p><b>Requirement</b>: R100+, Demonic Figurine, Demon Horn, Crystallized Lava</p>
		<p><b>Effect</b>: Trophies count more based on the amount of the three highest tier buildings you own.</p>
		<p><b>Formula</b>: (x ^ 0.5)%, where x is the total number owned of the three highest-tier buildings.</p>
		<p><b>Second Effect Requirement</b>: R225+, Demon Tail</p>
		<p><b>Effect</b>: Increase production bonus from Gems based on the amount of Evil spells cast in this Reincarnation.</p>
		<p><b>Formula</b>: +(2.25 * ln(1 + x) ^ 2.25)%, where x is Evil Spell Casts this Reincarnation.</p>
		" coords="130,70,184,124" shape="rect">
		<area href="#Titan" target="" research="
		<p><b><img src='/realm/Factions/picks/TitanSet.png' align='middle'> Titan Set</b></p>
		<p><b>Requirement</b>: R100+, Huge Titan Statue, Titan Shield, Titan Helmet</p>
		<p><b>Effect</b>: Increase Royal Exchange Bonus additively and multiplicatively based on time spent in this Era.</p>
		<p><b>Additive Formula</b>: +(3 * x ^ 0.7)%, where x is time spent in this Era.</p>
		<p><b>Multiplicative Formula</b>: (0.6 * x ^ 0.6)%, where x is time spent in this Era.</p>
		<p><b>Second Effect Requirement</b>: R225+, Frozen Lightning</p>
		<p><b>Effect</b>: Whenever you cast a spell, your production is increased based on Lightning Strike activity in this Reincarnation for 20 seconds. If another spell is cast while this effect is active, it is restored to full duration.</p>
		<p><b>Formula</b>: (x ^ 0.7)%, where x is Lightning Strike activity time this Reincarnation.</p>
		" coords="10,130,64,184" shape="rect">
		<area href="#Druid" target="" research="
		<p><b><img src='/realm/Factions/picks/DruidSet.png' align='middle'> Druid Set</b></p>
		<p><b>Requirement</b>: R100+, Glyph Table, Stone Of Balance, Branch of the Life Tree</p>
		<p><b>Effect</b>: Increase the duration of each spell based on their respective activity time (This Era).</p>
		<p><b>Formula</b>: (x ^ 0.5)%, where x is each individual spell's activity time This Era in seconds.</p>
		<p><b>Second Effect Requirement</b>: R225+, Primal Leaf</p>
		<p><b>Effect</b>: Lineage levels count more based on spell casts in this Era.</p>
		<p><b>Formula</b>: (0.5 * ln(1 + x) ^ 1.5)%, where x is spell casts this Era.</p>
		" coords="70,130,124,184" shape="rect">
		<area href="#Faceless" target="" research="
		<p><b><img src='/realm/Factions/picks/FacelessSet.png' align='middle'> Faceless Set</b></p>
		<p><b>Requirement</b>: R100+, Translucent Goo, Octopus-shaped Helmet, Nightmare Figment</p>
		<p><b>Effect</b>: Gain assistants based on the highest amount of assistants you had in a previous Era.</p>
		<p><b>Formula</b>: +(4500 + 12 * x ^ 0.3), where x is the highest amount of assistants in a previous Era.</p>
		<p><b>Second Effect Requirement</b>: R225+, The Blackest Ink</p>
		<p><b>Effect</b>: Increase Research Budget based on Faction Coins found in this Era.</p>
		<p><b>Formula</b>: +(min(3000, ln(1 + x) ^ 1.5)), where x is Faction Coins found in this Era.</p>
		" coords="130,130,184,184" shape="rect">
		<area href="#Dwarven" target="" research="
		<p><b><img src='/realm/Factions/picks/DwarvenSet.png' align='middle'> Dwarven Set</b></p>
		<p><b>Requirement</b>: R116+, Dwarven Bow, Stone Tankard, Beard Hair</p>
		<p><b>Effect</b>: Multiplicatively increase Assistants based on your Royal Exchange bonus.</p>
		<p><b>Formula</b>: (8 * x ^ 0.4)%, where x is Royal Exchange bonus.</p>
		<p><b>Second Effect Requirement</b>: R235+, Dwarven Anvil</p>
		<p><b>Effect</b>: Multiplicatively increase Mana Regeneration based on time spent in this Era.</p>
		<p><b>Formula</b>: (0.7 * x ^ 0.7)%, where x is your time spent in this Era.</p>
		" coords="10,190,64,244" shape="rect">
		<area href="#Drow" target="" research="
		<p><b><img src='/realm/Factions/picks/DrowSet.png' align='middle'> Drow Set</b></p>
		<p><b>Requirement</b>: R116+, Ceremonial Dagger, Arachnid Figurine, Poison Vial</p>
		<p><b>Effect</b>: Spells cast count more based on time spent as Evil in this Reincarnation.</p>
		<p><b>Formula</b>: (6 * ln(1 + x) ^ 1.6)%, where x is time spent as Evil in this Reincarnation.</p>
		<p><b>Second Effect Requirement</b>: R235+, Stiletto Heel</p>
		<p><b>Effect</b>: Increase the Ascension multiplier for Royal Market bonus by 0.7.</p>
		" coords="70,190,124,244" shape="rect">
		<area href="#Dragon" target="" research="
		<p><b><img src='/realm/Factions/picks/DragonSet.png' align='middle'> Dragon Set</b></p>
		<p><b>Requirement</b>: R116+, Dragon Fang, Dragon Soul, Dragon Scale</p>
		<p><b>Effect</b>: Reduce higher-tier cost scaling for all spells.</p>
		<p><b>Second Effect Requirement</b>: R235+, Eye of the Dragon</p>
		<p><b>Effect</b>: All alignment spells gain 1 additional tier.</p>
		" coords="130,190,184,244" shape="rect">
		<area href="#Mercenary" target="" research="
		<p><b><img src='/realm/Factions/picks/MercenarySet.png' align='middle'> Mercenary Set</b></p>
		<p><b>Requirement</b>: R160+, Steel Plate, Black Sword, Mercenary Insignia</p>
		<p><b>Effect</b>: Allows you to pick the same lineage as your faction.</p>
		<p><b>Effect</b>: Lineage levels count 25% more.</p>
		" coords="10,250,64,304" shape="rect">
	</map>
	<br/>
	<H6 id="Fairy"></h6>
	<p><b><img src="/realm/Factions/picks/FairySet.png" align="middle"> Fairy Set</b></p>
	<p><b>Requirement</b>: R100+, Pink Carrot, Bottled Voice, Silk Cloth</p>
	<p><b>Effect</b>: Multiplicatively increase Maximum Mana based on the amount of Good Buildings owned.</p>
	<p><b>Formula</b>: (x ^ 0.5)%, where x is the amount of Good Buildings you own.</p>
	<p><b>Second Effect Requirement</b>: R225+, Glowing Wing</p>
	<p><b>Effect</b>: Farms, Inns and Blacksmiths count more based on the amount of time spent with Fairies in this Reincarnation.</p>
	<p><b>Formula</b>: (2 * ln(1 + x) ^ 1.5)%, where x is time spent with Fairies in this Reincarnation.</p>
	<br/>
	<H6 id="Elven"></h6>
	<p><b><img src="/realm/Factions/picks/ElvenSet.png" align="middle"> Elven Set</b></p>
	<p><b>Requirement</b>: R100+, Lucky Clover, Mini-treasure, Raw Emerald</p>
	<p><b>Effect</b>: Autoclicks 10 times per second.</p>
	<p><b>Note</b>: Also generates the same amount of clicks offline.</p>
	<p><b>Second Effect Requirement</b>: R225+, Sylvan Mirror</p>
	<p><b>Effect</b>: Clicks count more based on automatic clicks.</p>
	<p><b>Formula</b>: (ln(1 + x) ^ 2.5 + x ^ 0.25)%, where x is automatic clicks this Era.</p>
	<p><b>Note</b>: NOT affected by any "clicks count more" effects.</p>
	<br/>
	<H6 id="Angel"></h6>
	<p><b><img src="/realm/Factions/picks/AngelSet.png" align="middle"> Angel Set</b></p>
	<p><b>Requirement</b>: R100+, Pillar Fragment, Divine Sword, Fossilized Wing</p>
	<p><b>Effect</b>: Additively increase Mana Regeneration based on highest amount of spells cast in a single Era.</p>
	<p><b>Formula</b>: +(3.5 * x ^ 0.35), where x is spells cast in a single Era.</p>
	<p><b>Second Effect Requirement</b>: R225+, Solid Cloud</p>
	<p><b>Effect</b>: Increase the duration of all spells based on the amount of Unique Buildings you own.</p>
	<p><b>Formula</b>: (x ^ 0.5)%, where x is Unique Buildings built.</p>
	<br/>
	<H6 id="Goblin"></h6>
	<p><b><img src="/realm/Factions/picks/GoblinSet.png" align="middle"> Goblin Set</b></p>
	<p><b>Requirement</b>: R100+, Ancient Coin Piece, Goblin Purse, Spiked Whip</p>
	<p><b>Effect</b>: Increase Faction Coin find chance additively and multiplicatively based on time spent in this Era.</p>
	<p><b>Additive Formula</b>: +(70 * x ^ 0.7)%, where x is time spent in this Era.</p>
	<p><b>Multiplicative Formula</b>: (0.6 * x ^ 0.6)%, where x is time spent in this Era.</p>
	<p><b>Second Effect Requirement</b>: R225+, Orc Fang Necklace</p>
	<p><b>Effect</b>: Each time you cast a spell, you also cast free Tax Collections based on time spent in this Era.</p>
	<p><b>Formula</b>: +(floor(1 + 0.25 * ln(1 + x) ^ 1.5)), where x is time spent this Era.</p>
	<br/>
	<H6 id="Undead"></h6>
	<p><b><img src="/realm/Factions/picks/UndeadSet.png" align="middle"> Undead Set</b></p>
	<p><b>Requirement</b>: R100+, Rotten Organ, Jaw Bone, Dusty Coffin</p>
	<p><b>Effect</b>: Additively increase max mana based on offline bonus.</p>
	<p><b>Formula</b>: +(7500 + 7.5 * ln(1 + x) ^ 3.75), where x is offline Multiplier.</p>
	<p><b>Second Effect Requirement</b>: R225+, Blood Chalice</p>
	<p><b>Effect</b>: Multiplicatively increases production bonus from gems based on Faction Coins found this Era.</p>
	<p><b>Formula</b>: (ln(1 + x) ^ 2)%, where x is Faction Coins found this Era.</p>
	<br/>
	<H6 id="Demon"></h6>
	<p><b><img src="/realm/Factions/picks/DemonSet.png" align="middle"> Demon Set</b></p>
	<p><b>Requirement</b>: R100+, Demonic Figurine, Demon Horn, Crystallized Lava</p>
	<p><b>Effect</b>: Trophies count more based on the amount of the three highest tier buildings you own.</p>
	<p><b>Formula</b>: (x ^ 0.5)%, where x is the total number owned of the three highest-tier buildings.</p>
	<p><b>Second Effect Requirement</b>: R225+, Demon Tail</p>
	<p><b>Effect</b>: Increase production bonus from Gems based on the amount of Evil spells cast in this Reincarnation.</p>
	<p><b>Formula</b>: +(2.25 * ln(1 + x) ^ 2.25)%, where x is Evil Spell Casts this Reincarnation.</p>
	<br/>
	<H6 id="Titan"></h6>
	<p><b><img src="/realm/Factions/picks/TitanSet.png" align="middle"> Titan Set</b></p>
	<p><b>Requirement</b>: R100+, Huge Titan Statue, Titan Shield, Titan Helmet</p>
	<p><b>Effect</b>: Increase Royal Exchange Bonus additively and multiplicatively based on time spent in this Era.</p>
	<p><b>Additive Formula</b>: +(3 * x ^ 0.7)%, where x is time spent in this Era.</p>
	<p><b>Multiplicative Formula</b>: (0.6 * x ^ 0.6)%, where x is time spent in this Era.</p>
	<p><b>Second Effect Requirement</b>: R225+, Frozen Lightning</p>
	<p><b>Effect</b>: Whenever you cast a spell, your production is increased based on Lightning Strike activity in this Reincarnation for 20 seconds. If another spell is cast while this effect is active, it is restored to full duration.</p>
	<p><b>Formula</b>: (x ^ 0.7)%, where x is Lightning Strike activity time this Reincarnation.</p>
	<br/>
	<H6 id="Druid"></h6>
	<p><b><img src="/realm/Factions/picks/DruidSet.png" align="middle"> Druid Set</b></p>
	<p><b>Requirement</b>: R100+, Glyph Table, Stone Of Balance, Branch of the Life Tree</p>
	<p><b>Effect</b>: Increase the duration of each spell based on their respective activity time (This Era).</p>
	<p><b>Formula</b>: (x ^ 0.5)%, where x is each individual spell's activity time This Era in seconds.</p>
	<p><b>Second Effect Requirement</b>: R225+, Primal Leaf</p>
	<p><b>Effect</b>: Lineage levels count more based on spell casts in this Era.</p>
	<p><b>Formula</b>: (0.5 * ln(1 + x) ^ 1.5)%, where x is spell casts this Era.</p>
	<br/>
	<H6 id="Faceless"></h6>
	<p><b><img src="/realm/Factions/picks/FacelessSet.png" align="middle"> Faceless Set</b></p>
	<p><b>Requirement</b>: R100+, Translucent Goo, Octopus-shaped Helmet, Nightmare Figment</p>
	<p><b>Effect</b>: Gain assistants based on the highest amount of assistants you had in a previous Era.</p>
	<p><b>Formula</b>: +(4500 + 12 * x ^ 0.3), where x is the highest amount of assistants in a previous Era.</p>
	<p><b>Second Effect Requirement</b>: R225+, The Blackest Ink</p>
	<p><b>Effect</b>: Increase Research Budget based on Faction Coins found in this Era.</p>
	<p><b>Formula</b>: +(min(3000, ln(1 + x) ^ 1.5)), where x is Faction Coins found in this Era.</p>
	<br/>
	<H6 id="Dwarven"></h6>
	<p><b><img src="/realm/Factions/picks/DwarvenSet.png" align="middle"> Dwarven Set</b></p>
	<p><b>Requirement</b>: R116+, Dwarven Bow, Stone Tankard, Beard Hair</p>
	<p><b>Effect</b>: Multiplicatively increase Assistants based on your Royal Exchange bonus.</p>
	<p><b>Formula</b>: (8 * x ^ 0.4)%, where x is Royal Exchange bonus.</p>
	<p><b>Second Effect Requirement</b>: R235+, Dwarven Anvil</p>
	<p><b>Effect</b>: Multiplicatively increase Mana Regeneration based on time spent in this Era.</p>
	<p><b>Formula</b>: (0.7 * x ^ 0.7)%, where x is your time spent in this Era.</p>
	<br/>
	<H6 id="Drow"></h6>
	<p><b><img src="/realm/Factions/picks/DrowSet.png" align="middle"> Drow Set</b></p>
	<p><b>Requirement</b>: R116+, Ceremonial Dagger, Arachnid Figurine, Poison Vial</p>
	<p><b>Effect</b>: Spells cast count more based on time spent as Evil in this Reincarnation.</p>
	<p><b>Formula</b>: (6 * ln(1 + x) ^ 1.6)%, where x is time spent as Evil in this Reincarnation.</p>
	<p><b>Second Effect Requirement</b>: R235+, Stiletto Heel</p>
	<p><b>Effect</b>: Increase the Ascension multiplier for Royal Market bonus by 0.7.</p>
	<br/>
	<H6 id="Dragon"></h6>
	<p><b><img src="/realm/Factions/picks/DragonSet.png" align="middle"> Dragon Set</b></p>
	<p><b>Requirement</b>: R116+, Dragon Fang, Dragon Soul, Dragon Scale</p>
	<p><b>Effect</b>: Reduce higher-tier cost scaling for all spells.</p>
	<p><b>Second Effect Requirement</b>: R235+, Eye of the Dragon</p>
	<p><b>Effect</b>: All alignment spells gain 1 additional tier.</p>
	<br/>
	<H6 id="Mercenary"></h6>
	<p><b><img src="/realm/Factions/picks/MercenarySet.png" align="middle"> Mercenary Set</b></p>
	<p><b>Requirement</b>: R160+, Steel Plate, Black Sword, Mercenary Insignia</p>
	<p><b>Effect</b>: Allows you to pick the same lineage as your faction.</p>
	<p><b>Effect</b>: Lineage levels count 25% more.</p>
	<br/>
<?php include "../scripts/footer.html"; ?>
