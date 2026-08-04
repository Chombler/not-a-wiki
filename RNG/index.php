<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php include "../scripts/header.html"; ?>
<p><b>Random Number Generator</b></p>
<p>Realm Grinder uses pseudorandom number generators for random game results. A generator's current integer state determines its future output, so results from a saved state are deterministic even though they are intended to appear random during normal play.</p>
<p><b>Current implementation (v4.3.12)</b></p>
<p>The game's generator uses the Park–Miller “minimal standard” recurrence with multiplier 16,807 and modulus 2,147,483,647. Each generated integer becomes the next state; a random value strictly between 0 and 1 is obtained by dividing that integer by 2,147,483,647.</p>
<p>New generator instances seed their state from the current time and the runtime's random source. If an instance reaches the invalid zero state, it is seeded again before producing a value.</p>
<p>Different mechanics may use different generator instances. Consuming a random value advances only the instance used by that mechanic. Whether an instance is saved, and what actions consume its values, are implementation details of the individual mechanic and should not be inferred from another mechanic's results.</p>
<p>The former RNG-instance and artifact-instantiation screenshots were removed because they did not enumerate the current v4.3.12 mechanics and could not serve as a complete current reference.</p>
<?php include "../scripts/footer.html"; ?>
