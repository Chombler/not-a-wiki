<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
	<h6><a href="/realm/Challenges/"><img src="/realm/Factions/picks/ChallengesTopPage.png"></h6></a>
	<p><b>Recommended</b> gem level for doing any drow challenge is e90+</p>
	<h6 id="DWC1"></h6>
	<p><b>Drow Challenge 1</b></p>
	<p><b><img src='/realm/Factions/picks/OrganizedCrimeChallenge.png' alt='Organized Crime' align='middle'> Organized Crime</b></p>
	<p>&quot;The mysterious drow wish for you to prove your murderous honor to them.&quot;</p>
	<p><b>Requirements</b>: Demon as Base Faction, Drow as Prestige Faction, Reincarnation 6+, Perfect Combo upgrade purchased, Goblin, Demon and Undead challenge 1 completed.</p>
	<p><b>Challenge</b>: Have at least 500 Trophies, 1,000 Royal Exchanges, and a Combo Strike counter of 250 in this Era.</p>
	<p><b>Effect</b>: Increase Royal Exchange bonus based on the amount of unlocked trophies.</p>
	<p><b>Formula</b>: +(0.8 * x ^ 0.8)%, where x is the amount of unlocked Trophies.</p>
	<p><b>Upgrade</b>: Works with Demon + Drow</p>
	<p><b>Tip</b>: Use Elven Bloodline.</p>
	<hr>
	<h6 id="DWC2"></h6>
	<p><b>Drow Challenge 2</b></p>
	<p><b><img src='/realm/Factions/picks/DarkEleganceChallenge.png' align='middle'> Dark Elegance</b></p>
	<p>&quot;The Spider Queen is not pleased with some of her worshippers. You must weed out the weak and sacrifice them at the temple altar.&quot;</p>
	<p><b>Requirements</b>: Goblin as Base Faction, Drow as Prestige Faction, Reincarnation 11+, Drow Bloodline, Goblin, Demon and Undead challenge 2 and Drow challenge 1 completed.</p>
	<p><b>Challenge</b>: Build 1750 Spider Sanctuaries (Dark Temples).</p>
	<p><b>Effect</b>: Increase the production of all buildings based on Faction Coins found this Era. Does not suffer from Ascension penalties.</p>
	<p><b>Formula</b>: (ln(1 + x) ^ 2)%, where x is the amount of Faction Coins found this Era.</p>
	<p><b>Upgrade</b>: Works with Goblin + Drow</p>
	<hr>
	<h6 id="DWC3"></h6>
	<p><b>Drow Challenge 3</b></p>
	<p><b><img src='/realm/Factions/picks/SorcerersPactChallenge.png' align='middle'> Sorcerer's Pact</b></p>
	<p>&quot;A legion of interlopers have invaded our sanctuaries. Work yourselves into a rage and tear them apart.&quot;</p>
	<p><b>Requirements</b>: Undead as Base Faction, Drow as Prestige Faction, Reincarnation 21+, 1750 excavations, Goblin, Demon and Undead challenge 3 and Drow challenge 2 completed.</p>
	<p><b>Challenge</b>: Have at least 2 hours of combined Blood Frenzy and Combo Strike activity time in this Era.</p>
	<p><b>Effect</b>: Increase offline gains of spell activity time and Faction Coins based on Offline production bonus.</p>
	<p><b>Formula</b>: (0.05 * ln(1 + x) ^ 1.5)%, where x is Offline production bonus.</p>
	<p><b>Upgrade</b>: Works with Undead + Drow</p>
	<p><b>Tip</b>: Run both spells at the same time, depending on Mana Regeneration it takes about 1 hour 15 minutes to complete the challenge.</p>
	<hr>
	<h6 id="DWC4"></h6>
	<p><b>Drow Challenge 4</b></p>
	<p><b><img src='/realm/Factions/picks/TrainedAssasinsChallenge.png' align='middle'> Trained Assassins</b></p>
	<p>&quot;There is a civil war between 2 Spider Gods. Bolster our forces and wipe the weaklings off the face of the realm.&quot;</p>
	<p><b>Requirements</b>: Any Evil as Base Faction, Drow as Prestige Faction, Reincarnation 27+, 2000 excavations, Drow Challenge 3 completed.</p>
	<p><b>Challenge</b>: Cast Call to Arms with at least 30,000 buildings.</p>
	<p><b>Effect</b>: Increase Offline production based on time spent in this Era.</p>
	<p><b>Formula</b>: (2 * x ^ 0.8)%, where x is time spent in this Era.</p>
	<p><b>Upgrade</b>: Works with any Evil + Drow</p>
	<hr>
	<h6 id="DWC5"></h6>
	<p><b>Drow Challenge 5</b></p>
	<p><b><img src='/realm/Factions/picks/ShadowMirageChallenge.png' align='middle'> Shadow Mirage</b></p>
	<p>&quot;It is time to emerge from the shadows. Our warriors will demonstrate their hard work and lead us to domination of the realm.&quot;</p>
	<p><b>Requirements</b>: Any Evil as Base Faction, Drow as Prestige Faction, Reincarnation 33+, Drow Unique Building, Drow Challenge 4 completed.</p>
	<p><b>Challenge</b>: Have at least 2 hours offline (This Era) and at least 360 charges of Combo Strike.</p>
	<p><b>Effect</b>: Multiplicatively increase triggered Tax Collections based on Royal Exchange bonus.</p>
	<p><b>Formula</b>: (5 + 2 * x ^ 0.2)%, where x is Royal Exchange bonus.</p>
	<p><b>Upgrade</b>: Works with All</p>
	<hr>
	<h6 id="DWCR"></h6>
	<p><b>Drow Challenge Reward</b></p>
	<p><b><img src='/realm/Factions/picks/VersaltileComboChallengeReward.png' align='middle'> Versatile Combo</b></p>
	<p><b>Effect</b>: Increase Combo Strike counter based on the amount of spells cast in this Era. (Not including Tax Collection)</p>
	<p><b>New Combo Strike Counter Formula</b>: (x + y), where x is your Combo Strike cast count and y is every other spell (except tax collection and generic) cast count.</p>
	<p><b>Effect</b>: Also increase offline spells cast amount multiplicatively based on your offline Mana Regeneration.</p>
	<p><b>Formula</b>: (5 * ln(1 + 30 * x))%, where x is your offline Mana Regeneration.</p>
<?php include "../scripts/footer.html"; ?>