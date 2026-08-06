<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
	<h6><img src="/realm/Factions/picks/TopPageUpgrade.png" alt="Sun Force" align="middle"></h6>
	<p>Obtained by excavating both the Dawnstone and Duskstone lore artifacts. It has different effects depending on the time of day.</p>
	<p>Sun Force is unavailable starting in Ascension 4.</p>
	<p>At R100+ in Ascension 2 or Ascension 3, you can find Planetary Force, which activates all Sun Force effects at once. See details below.</p>
	<p><img src="/realm/Factions/picks/DawnstoneArtifact.png" alt="Dawnstone" align="middle"><b> Dawnstone</b></p>
	<p><b>Hint</b>: Relic of the Dawn hours.</p>
	<p><b>Description</b>: Only found during sunrise hours. Emits a faint glow.</p>
	<p><b>Requirement</b>: R16+, from 5:00 AM through 11:59 AM local time.</p>
	<p><b>Chance</b>: (x / 10,000)%, where x is your Excavation count.</p>
	<br/>
	<p><img src="/realm/Factions/picks/DuskstoneArtifact.png" alt="Duskstone" align="middle"><b> Duskstone</b></p>
	<p><b>Hint</b>: Relic of the Dusk hours.</p>
	<p><b>Description</b>: Only found during sunset hours. Absorbs light in a small radius.</p>
	<p><b>Requirement</b>: R16+, from 6:00 PM through 8:59 PM local time.</p>
	<p><b>Chance</b>: (x / 10,000)%, where x is your Excavation count.</p>
	<h6>Sun Force</h6>
	<p><b>Upgrade Cost</b>: 1 Notg (1e120) Coins, A1+ free</p>
	<p><b>Note</b>: All times are based on UTC time.</p>
	<p><b>Note</b>: Current
	<a style="text-decoration: none" class="clock24" id="tz24-1509892643-tzutc-eyJob3VydHlwZSI6MTIsInNob3dkYXRlIjoiMCIsInNob3dzZWNvbmRzIjoiMSIsInNob3d0aW1lem9uZSI6IjEiLCJ0eXBlIjoiZCIsImxhbmciOiJlbiJ9">UTC Time</a>
	<script type="text/javascript" src="//w.24timezones.com/l.js" async></script>
	<p><img src="/realm/Factions/picks/SunForce12am6am.png" alt="SunForce12pm6pm" align="middle"><b><font color="red"> 12 AM - 6 AM</font></b></p>
	<p><b>Effect</b>: Gain additional assistants based on the amount of gems you own.</p>
	<p><b>Formula</b>: +(0.25 * ln(1 + x) ^ (1.25 + 0.25 * A)), where x is Gems owned and A is Ascensions.</p>
	<br/>
	<p><img src="/realm/Factions/picks/SunForce6am12pm.png" alt="SunForce12pm6pm" align="middle"><b><font color="red"> 6 AM - 12 PM</font></b></p>
	<p><b>Effect</b>: Increase Mana Regeneration based on the amount of assistants you own. (Additive)</p>
	<p><b>Formula</b>: +(ln(1 + x) ^ (1.5 + 0.25 * A)), where x is assistants owned and A is Ascensions.</p>
	<br/>
	<p><img src="/realm/Factions/picks/SunForce12pm6pm.png" alt="SunForce12pm6pm" align="middle"><b><font color="red"> 12 PM - 6 PM</font></b></p>
	<p><b>Effect</b>: Increase the production of all buildings based on the amount of Faction Coins you collected in this Era.</p>
	<p><b>Formula</b>: (2.5 * ln(1 + x) ^ (1.25 + 2 * A))%, where x is Faction Coins found in this Era and A is Ascensions.</p>
	<br/>
	<p><img src="/realm/Factions/picks/SunForce6pm12am.png" alt="SunForce6pm12am" align="middle"><b><font color="red"> 6 PM - 12 AM</font></b></p>
	<p><b>Effect</b>: Increase offline production based on the amount of buildings you own.</p>
	<p><b>Formula</b>: (15 * x ^ (0.85 + 0.15 * A))%, where x is buildings built and A is Ascensions.</p>
	<hr>
	<p><b><img src="/realm/Factions/picks/PlanetaryForceArtifact.png" align="middle"> Planetary Force</p></b>
	<p><b>Hint</b>: Try every day for better luck! Missing a day is the same as breaking a mirror, you know.</p>
	<p><b>Description</b>: Planets aligning seem to affect your realm in different ways...</p>
	<p><b>Requirements</b>: R100+, Ascension 2 or Ascension 3, Dawnstone and Duskstone found.</p>
	<p><b>Chance</b>: ((x ^ 2.5) / 2500)%, where x is consecutive days logged in.</p>
	<p><b>Effect</b>: Gives upgrade with the same name</p>
	<p><b>Upgrade Effect</b>: Activates all Sun Force effects at once.</p>
	<p><b>Upgrade Cost</b>: 100 Qi (1e20) Coins. Requires a non-unaligned alignment and is unavailable in Ascension 4.</p>
<?php include "../scripts/footer.html"; ?>
