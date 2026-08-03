<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<b><center><font size="5">Historic Page, outdated and no longer worked on!</font></center></b>
<h6><img src="/realm/Factions/picks/ResearchTopPage.png"></h6>
<h6>Mercenary Research</h6>
<p><img src="/realm/Factions/picks/MercenaryEncampmentQuest.png" alt="Mercenary Encampment Quest" align="middle"> <b>Mercenary Encampment Quest</b></p>
<p>We salute you, commander. Your strategical skills had not gone unnoticed within our ranks. We have decided to offer you a chance to establish a formal encampment within your boundaries... Build more structures to strengthen our city.</p>
<p><b>Requirement</b>: Mercenary (Any Alignment), 125000 buildings</p>
<p><b>Cost</b>: 10 Notg (1e121)</p>
<p><b>Note</b>: Only needs bought once.</p>
<p><b>Unlocks</b>: Mercenary Unique Buildings</p>
<hr>
<p><b>Unique Buildings</b></p>
<p><b>Good</b></p>
<p><img src="/realm/Factions/picks/MercenaryCamp.png" alt="Mercenary Camp" align="middle"> <b>Mercenary Camp</b></p>
<p><b>Requirement</b>: Mercenary Encampment Quest</p>
<p><b>Cost</b>: 100 Qag (1e125)</p>
<p><b>Effect 1</b>: Allows access to Research Facilities</p>
<p><b>Effect 2</b>: Upgrade Knights Jousts to Mercenary Camps, boosting their production based on the amount of Non-Unique buildings you own and unlocking more unique perks for the building.</p>
<p><b>Formula</b>: (1.25 * (1 + x) ^ 1.25)%, where x is Non-Unique Buildings built.</p>
<p><b>Effect 3</b>: Unlocks Round Table</p>
<br/>
<p><img src="/realm/Factions/picks/RoundTable.png" alt="Round Table" align="middle"> <b>Round Table</b> (Spell Upgrade)</p>
<p><b>Requirement</b>: Mercenary Camp</p>
<p><b>Cost</b>: 1 Qaqag (1e135)</p>
<p><b>Effect 1</b>: Gives 1 additional upgrade from any of the Good factions.</p>
<p><b>Effect 2</b>: Upgrades Tax Collection spell to Share Benefits. Increases the production of all buildings and Faction Coin find chance based on this spell tier level for 20 seconds. Can be cast up to 35 tiers.</p>
<p><b>Note</b>: Tier 41 and above cost x4/x2.25 (with S1275) instead of x2/x1.5 (with S1275) than each previous tier.</p>
<p><b>Faction Spell</b>: Tax Collection</p>
<br/>
<p><img src="/realm/Factions/picks/ShareBenefits.png" alt="Round Table" align="middle"> <b>Good</b></p>
<p><b>Requirement</b>: Mercenary Camp</p>
<p><b>Cost</b>: 1 Qaqag (1e135)</p>
<p><b>Effect</b>: Increases the production of all buildings and Faction Coin find chance based on this spell tier level for 20 seconds. Can be cast up to 36 tiers.</p>
<p><b>Formula</b>: 120 ^ (0.25 * t), where t is tier (FC chance multiplier)</p>
<p><b>Formula</b>: ((2.20 ^ T) - 1) * 100, multiplicative (production multiplier)</p>
<p><b>Effect</b>: Now adds Tax Collections casts based on its duration and current tier cast.</p>
<p><b>Formula</b>: (10 * x * T), where x is spell duration and T is spell tier</p>
<p><b>Formula</b>: sum formula is (x ^ (0.15 * T)), where x is spell duration and T is spell tier</p>
<br/>
<p><img src="/realm/Factions/picks/GoodMercenaryUpgrade13.png" alt="Round Table" align="middle"> <b>Good Mercenary Upgrade 13</b></p>
<p>You can purchase any upgrade from any Good Faction for an increased price</p>
<p><b>Requirement</b>: Round Table (Good Spell Upgrade)</p>
<hr>
<p><b>Evil</b></p>
<p><img src="/realm/Factions/picks/TyrantGarrison.png" alt="Tyrant Garrison" align="middle"> <b>Tyrant Garrison</b></p>
<p><b>Requirement</b>: Mercenary Encampment Quest</p>
<p><b>Cost</b>: 100 Qag (1e125)</p>
<p><b>Effect 1</b>: Allows access to Research Facilities</p>
<p><b>Effect 2</b>: Upgrade Evil Fortresses to Tyrant Garrisons, boosting their production based on Offline Production Bonus and unlocking more unique perks for the building.</p>
<p><b>Effect 3</b>: Unlocks Dark Covenant</p>
<p><b>Formula</b>: (85 + 8.5 * x ^ 0.85)%, where x is the Offline Production Bonus multiplier.</p>
<br/>
<p><img src="/realm/Factions/picks/ReapInterests.png" alt="Tyrant Garrison" align="middle"> <b>Evil</b></p>
<p><b>Requirement</b>: Tyrant Garrison</p>
<p><b>Cost</b>: 1 Qaqag (1e135)</p>
<p><b>Effect</b>: Additional Reap Interests casts increase the Tax Collection seconds worth of production.</p>
<p><b>Formula</b>: y * ln(1 + x) ^ 4 seconds, where y is Tax Collection worth and x is Reap Interests casts.</p>
<p><b>Note</b>: Extra time from reap interests does apply to S50.</p>
<p><b>Note</b>: S50 tax collections do increase reap interests.</p>
<br/>
<p><img src="/realm/Factions/picks/DarkCovenant.png" alt="Dark Covenant" align="middle"> <b>Dark Covenant</b> (Spell Upgrade)</p>
<p><b>Requirement</b>: Tyrant Garrison</p>
<p><b>Cost</b>: 1 Qaqag (1e135)</p>
<p><b>Effect 1</b>: Gives 1 additional upgrade from any of the Evil factions.</p>
<p><b>Effect 2</b>: Upgrades Tax Collection spell to Reap Interests Additional casts of Reap Interests increase its seconds worth of production.</p>
<br/>
<p><img src="/realm/Factions/picks/EvilMercenaryUpgrade13.png" alt="Round Table" align="middle"> <b>Evil Mercenary Upgrade 13</b></p>
<p>You can purchase any upgrade from any Evil Faction for an increased price.</p>
<p><b>Requirement</b>: Tyrant Garrison (Evil Spell Upgrade)</p>
<hr>
<p><b>Neutral</b></p>
<p><img src="/realm/Factions/picks/Freemason'sHall.png" alt="Freemason's Hall" align="middle"> <b>Freemason's Hall</b></p>
<p><b>Requirement</b>: Mercenary Encampment Quest</p>
<p><b>Cost</b>: 100 Qag (1e125)</p>
<p><b>Effect 1</b>: Allows access to Research Facilities</p>
<p><b>Effect 2</b>: Upgrade Inns to Freemason's Halls, boosting their production based on Faction Coins found in this Era and unlocking more unique perks for the building.</p>
<p><b>Formula</b>: (60 + 60 * ln(1 + x) ^ 6)%, where x is Faction Coins found in this Era.</p>
<p><b>Effect 3</b>: Unlocks Secret Exchange</p>
<br/>
<p><img src="/realm/Factions/picks/SecretExchange.png" alt="Secret Exchange" align="middle"> <b>Secret Exchange</b> (Spell Upgrade)</p>
<p><b>Requirement</b>: Freemason's Hall</p>
<p><b>Cost</b>: 1 Qaqag (1e135)</p>
<p><b>Effect </b>: Upgrades Tax Collection spell to Appraisal Vantage, Generates additional Faction Coins per cast</p>
<p><img src="/realm/Factions/picks/AppraisalVantage.png" alt="Freemason's Hall" align="middle"> <b>Neutral</b></p>
<p><b>Requirement</b>: Freemason's Hall</p>
<p><b>Cost</b>: 1 Qaqag (1e135)</p>
<p><b>Effect</b>: Generates additional Faction Coins per cast</p>
<p><b>Formula</b>: (2.5 * x ^ 2.5), where x is original Faction Coin chance.</p>
<br/>
<p><img src="/realm/Factions/picks/ObsidianShardArtifact.png" alt="Secrets of the Warriors" align="middle"> <b>Obsidian Shard</b></p>
<p><b>Requirement</b>: R75+ and the 1,500th Excavation as any Faction.</p>
<p><b>Description</b>: Extremely hard and black as darkness itself, this material cannot apparently be carved or melted. It is a mystery how you can make this thing into a sword.</p>
<p><b>Effect</b>: Unlocks Secrets of the Warriors</p>
<br/>
<p><img src="/realm/Factions/picks/SecretsoftheWarriors.png" alt="Secrets of the Warriors" align="middle"> <b>Secrets of the Warriors</b></p>
<p><b>Requirement</b>: Obsidian Shard</p>
<p><b>Cost</b>: 100 Qiqag (1e140) and 10 Qa (1e16) of every Faction Coin.</p>
<p><b>Effect</b>: Unlocks Researches for Mercenaries and increases their production by 10,000%.</p>
<p><b>Effect</b>: Unlocks 3 Research Slots per branch.</p>
<hr>
<p><b>Research</b></p>
<p><b>S2900 - For Mercenary</b></p>
<p><b>Research Name</b>: Scholarship</p>
<p><b>Hint</b>: More buildings for the Black Army!</p>
<p><b>Requirement</b>: 11000 Merc Unique Buildings.</p>
<p><b>Cost</b>: 2.174e162</p>
<p><b>Effect</b>: Increase Non-Unique building production based on Unique Buildings owned.</p>
<p><b>Formula</b>: (10 * x ^ 1.05)%, where x is Unique Buildings owned.</p>
<br/>
<p><b>S3200 - For All Factions</b></p>
<p><b>Research Name</b>: Manipulation</p>
<p><b>Hint</b>: First spell, many served.</p>
<p><b>Requirement</b>: 1B (1e9) Tax Collections (This R), (Calefaction A1325) and (Psionics S1500).</p>
<p><b>Cost</b>: 2.563e179</p>
<p><b>Effect</b>: Multiplicatively increase Mana Regeneration by 12% per active spell.</p>
<p><b>Formula</b>: (12 * x)%, where x is active spells.</p>
<p><b>Effect</b>: Also increases offline spell cast amount multiplicatively by 1200%.</p>
<hr>
<p><b>C3000 - For Mercenary</b></p>
<p><b>Research Name</b>: Customizing</p>
<p><b>Hint</b>: Go into a deeper tunnel.</p>
<p><b>Requirement</b>: 9000 Excavations as Mercenary.</p>
<p><b>Cost</b>: 1.066e168</p>
<p><b>Effect</b>: Increases the production of all buildings based on the amount of artifacts you own.</p>
<p><b>Formula</b>: (2 * x ^ 2), where X is artifacts you own.</p>
<br/>
<p><b>C3100 - All Factions</b></p>
<p><b>Research Name</b>: Engineering</p>
<p><b>Hint</b>: Spend some quality time with the Mercenaries.</p>
<p><b>Requirement</b>: 12 days as Mercenary (across all Reincarnations).</p>
<p><b>Cost</b>: 5.227e173</p>
<p><b>Effect</b>: Increase Maximum Mana based on clicks made in this Reincarnation.</p>
<p><b>Formula</b>: +(1.5 * x ^ 0.35), where x is clicks made in this Reincarnation.</p>
<hr>
<p><b>D2850 - For Mercenary</b></p>
<p><b>Research Name</b>: Intervention</p>
<p><b>Requirement</b>: Secrets of the Warriors.</p>
<p><b>Cost</b>: 3.105e159</p>
<p><b>Effect</b>: Increase Unique Building production based on total time spent as Mercenary.</p>
<p><b>Formula</b>: (80 + 2 * x ^ 0.8)%, where x is total time spent as Mercenary.</p>
<br/>
<p><b>D3350 - For All Factions</b></p>
<p><b>Research Name</b>: Vampirism</p>
<p><b>Hint</b>: Sound the alarms, production has gone offline!</p>
<p><b>Requirement</b>: 100 Sp% (1e26%) offline bonus, (Intervention D2850) and (Upheaval W3150).</p>
<p><b>Cost</b>: 8.799e187</p>
<p><b>Effect</b>: Increase assistants additively and multiplicatively based on your Offline Bonus.</p>
<p><b>Additive Formula</b>: +(2.5 * ln(1 + x) ^ 2.5), where x is your Offline Bonus.</p>
<p><b>Multiplicative Formula</b>: (0.2 * ln(1 + x) ^ 2)%, where x is your Offline Bonus.</p>
<hr>
<p><b>E3250 - For All Factions</b></p>
<p><b>Research Name</b>: Hirelings</p>
<p><b>Requirement</b>: (Intimidation E1325) and (Scholarship S2900).</p>
<p><b>Cost</b>: 1.795e182</p>
<p><b>Effect</b>: Gain additional assistants based on Faction Coins found in this Era.</p>
<p><b>Formula</b>: +(5 * ln(1 + x) ^ 2.5), where x is Faction Coins found in this Era.</p>
<br/>
<p><b>E3300 - For Mercenary</b></p>
<p><b>Research Name</b>: Estates</p>
<p><b>Hint</b>: 50k shades of uniqueness.</p>
<p><b>Requirement</b>: 45000 Unique buildings, (Hoarding E1225) and (Combination A2950).</p>
<p><b>Cost</b>: 1.257e185</p>
<p><b>Effect</b>: Gives you all the Unique Buildings of your alignment.</p>
<p><b>Effect</b>: Ascension 3: Gain all the Unique Buildings that match your alignments.</p>
<hr>
<p><b>A2950 - For Mercenary</b></p>
<p><b>Research Name</b>: Combination</p>
<p><b>Hint</b>: Some lineage?</p>
<p><b>Requirement</b>: All Lineages Level at 15.</p>
<p><b>Cost</b>: 1.522e165</p>
<p><b>Effect</b>: Select an additional bloodline.</p>
<p><b>Effect</b>: You also gain the base effect of its respective Lineage.</p>
<p><b>Effect</b>: Combination Bloodline effects R60/R115 power.</p>
<br/>
<p><b>A3400 - For All Factions</b></p>
<p><b>Research Name</b>: Chemistry</p>
<p><b>Hint</b>: Get attracted to Faction Coins.</p>
<p><b>Requirement</b>: 1 No (1e30) FC (Found this Era), (Customizing C3000) & (Manipulation S3200).</p>
<p><b>Cost</b>: 6.161e190</p>
<p><b>Effect</b>: Increases Faction Coin find chance based on the total amount of Lineage levels you have.</p>
<p><b>Effect</b>: Also increases Faction Coin find chance by a multiplicative 300%.</p>
<p><b>Formula</b>: 3 * x ^ 2.25, where x is total Lineage levels.</p>
<hr>
<p><b>W3050 - For Mercenary</b></p>
<p><b>Research Name</b>: Flanking</p>
<p><b>Requirement</b>: 100 M (1e8) Base Assistants, Authority (W1275), and Intimidation (E1325).</p>
<p><b>Cost</b>: 7.464e170</p>
<p><b>Effect</b>: Increases the production of buildings one tier directly above or below a Unique Building based on the amount of assistants you own.</p>
<p><b>Formula</b>: (2 * x ^ 0.8)%, where x is assistants.</p>
<br/>
<p><b>W3150 - For All Factions</b></p>
<p><b>Research Name</b>: Upheaval</p>
<p><b>Hint</b>: More of the baseline production buildings!</p>
<p><b>Requirement</b>: 60000 Farms, Inns and Blacksmiths.</p>
<p><b>Cost</b>: 3.66e176</p>
<p><b>Effect</b>: Increases the production of all buildings based on their tier, giving the highest bonus to the lowest.</p>
<p><b>Formula</b>: (150 * (12 - T) ^ 2.15)%, where T is building tier.</p>
<?php include "../scripts/footer.html"; ?>
