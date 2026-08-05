# **Raalm Gronder A3 Builds for v4.3.11**

**Link for the A3 plot (partially OUTDATED, check the gem ranges): [plot](https://i.imgur.com/KOmAgQO.png)**

**Link for patch 4.3 patch notes: [notes](https://docs.google.com/document/d/1xVXiP3R2WtRH9gwUfoo8mkKiYuQQgg8W8J6eMFcDNeQ/edit?tab=t.0)**

**The builds are split between R160-R180 and R181-R219 in different document tabs (found in the sidebar on PC or by scrolling further down on mobile).**

## **A3 Roadmap**

**0\. When Offline or Idle**

* Unlock tier 4 spells (when you can fulfill the requirements).  
* 160-164: FRAN and DDGB for spells tiers priority if idle time.

**1\. R165**

* Prestige Factions unlocked.

**2\. R172**

* Astral Factions unlocked.  
* Complete the Mercenary Duel.  
* Artifacts  
  * Obsidian Crown  
  * Mercenary Insignia  
* True Harlequin trophy.

**3\. R180**

* (When offline/idle) Unlock Gem Grinder/Precognition/Infinite Spiral/Spiritual Surge tier 4\.  
* Artifacts  
  * Forgotten Relic  
  * Mana Loom, Factory, Mythos, Vault, Athanor, & Battlefield  
  * Apeiron  
* Lineages to level 75\.

**4\. R190**

* Mercenary Challenge 1

**5\. R194**

* Mercenary Challenge 2

**6\. R198**

* Mercenary Challenge 3

**7\. R202**

* Mercenary Challenge 4

**8\. R206**

* God's Fingers (while waiting for MCC5)  
* Mercenary Challenge 5  
* Architect trophy  
* (Optional) Excavate for Rubies

**9\. Before Ascending** (either after MCC5 or end of R219)

* Architect, God's Fingers, Mana Falls trophies.  
* Unlock all researches.

## **Research budget in A3**

R170 power: \+(450 \+ 3.5 \* R), where R is (current Reincarnation \- 159\) 

* Reincarnations count more effects apply post-subtraction

Mercenary first contract: 500 budget in every branch.  
Mercenary fourth contract: 1000 budget in every branch.  
Mercenary Magic, Sorcery and Union Contracts now increase Research Budget.

* Merc Spell Formula: \+(1000 \+ 5 \* x ^ 0.5), where x is the activity time of the chosen spell.  
* Note: Capped at \+5,000 Budget.  
* Note: Split equally between Facilities of the faction’s research affiliations if it has more than one.  
* Example: God’s Hand activity time increases Divine Budget by (y \= 1000 \+ 5 \* x ^ 0.5) when God’s Hand is picked; Grand Balance activity time increases Craftsmanship and Warfare Budget by (0.5 \* y) each; Dragon’s Breath increases Research Budget for all Facilities by (1/6 \* y).  
* Neutral Affiliations: Titan \= Angel and Goblin (D and E branches), Druid \= Elven and Demon (C and W), Faceless \= Fairy and Undead (S and A)

Unions increase the budget of factions associated with the union based on how many upgrades you have of that faction: \+(400\*x)

* Dwarven union splits budget between all good branches.  
  Drow union splits budget between all evil branches.  
  Dragon union splits budget between all branches.

Research facilities artifacts: (500 \+ ln(((1 \+ x) \* (1 \+ y)) ^ 0.5) ^ 3), where x and y are time spent as the following alignments:

* Spellcraft (Fairy): Good, Chaos  
* Craftsmanship (Elf): Good, Balance  
* Divine (Angel): Good, Order  
* Economics (Goblin): Evil, Balance  
* Alchemy (Undead): Evil, Order  
* Warfare (Demon): Evil, Chaos

With 5 mins as both alignments you’ll have 185 extra budget  
With 10 mins as both alignments you’ll have 261 extra budget  
With 15 mins as both alignments you’ll have 314 extra budget

* Forbidden: 500 \+ 0.75 \*ln(1 \+(x \* y) ^ 0.5) ^ 3, where x is the highest time spent between the Good and Evil alignments and y is the highest time spent between the Order, Chaos, and Balance alignments this Reincarnation

Archon Bloodline: ln(1 \+ x) ^ 3, where x is time spent this Era.  
Goblin Lineage Perk 6: 4 \* x ^ 0.5, where x is Tax Collection worth in seconds, capped at 3000\.   
Dwarf Lineage Perk 6: 0.6 \* x ^ 0.6, where x is Excavation depth, capped at 3000\.
