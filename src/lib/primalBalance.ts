const ascensions = [0, 1, 2, 3, 4] as const;
const additionalTargets = Array.from({ length: 10 }, (_, index) => index + 1);

// Inverse of floor((effectiveMana / 100000) ^ (0.2 / (0.5 * ascension + 1))).
// The game applies "Mana produced counts more" effects before this calculation.
export function primalBalanceMana(targets: number, ascension: number) {
  return 100_000 * targets ** (5 * (0.5 * ascension + 1));
}

function formatMana(value: number) {
  return value.toExponential(6)
    .replace(/\.0+(?=e)/, '')
    .replace(/(\.\d*?[1-9])0+(?=e)/, '$1')
    .replace('e+', 'e');
}

export function primalBalanceTableHtml() {
  const headings = ascensions.map((ascension) => `<th scope="col">A${ascension}</th>`).join('');
  const rows = additionalTargets.map((targets) => {
    const total = targets + 1;
    const values = ascensions
      .map((ascension) => `<td>${formatMana(primalBalanceMana(targets, ascension))}</td>`)
      .join('');
    return `<tr><td>+${targets}</td><td>${total}${total === 11 ? ' (all)' : ''}</td>${values}</tr>`;
  }).join('');

  return `<table class="numtable primal-balance-table"><caption><b>Effective Mana Produced required for Primal Balance targets</b></caption><thead><tr><th rowspan="2" scope="col">Additional targets</th><th rowspan="2" scope="col">Total buildings affected</th><th colspan="5" scope="colgroup">Current Ascension</th></tr><tr>${headings}</tr></thead><tbody>${rows}</tbody></table><p class="table-note"><b>How to read this table</b>: The A0–A4 columns are the character's current Ascension number. These are effective Mana Produced thresholds: effects that make Mana Produced count more, including Druid Perk 5 and active Temporal Flux, are applied before Primal Balance checks the value. Your displayed raw Mana Produced may therefore be lower than the table entry when those effects apply.</p>`;
}
