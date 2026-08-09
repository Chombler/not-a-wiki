(function () {
  function showHide(element) {
    var trigger = element && element.jquery ? element[0] : element;
    if (!trigger) return;
    var target = trigger.nextElementSibling;
    if (!target || !target.classList.contains('autohide')) return;
    var opening = target.hidden;
    target.hidden = !opening;
    trigger.setAttribute('aria-expanded', String(opening));
  }

  window.shohid = showHide;

  document.addEventListener('DOMContentLoaded', function () {
    if (window.jQuery) {
      window.jQuery('[research]').style_my_tooltips();
      window.jQuery('[data-research]').style_my_tooltips({ attribute: 'data-research' });
    }

    var menuButton = document.querySelector('.site-menu-button');
    var sidebar = document.querySelector('.site-sidebar');
    if (menuButton && sidebar) {
      menuButton.addEventListener('click', function () {
        var open = sidebar.classList.toggle('is-open');
        menuButton.setAttribute('aria-expanded', String(open));
      });
    }

    var themeButton = document.querySelector('.theme-toggle');
    if (themeButton) {
      var updateThemeButton = function () {
        var night = document.documentElement.dataset.theme === 'night';
        themeButton.textContent = night ? 'Arcane Ledger' : 'Castle Night';
        themeButton.setAttribute('aria-pressed', String(night));
      };
      updateThemeButton();
      themeButton.addEventListener('click', function () {
        var theme = document.documentElement.dataset.theme === 'night' ? 'ledger' : 'night';
        document.documentElement.dataset.theme = theme;
        try { localStorage.setItem('realm-reference-theme', theme); } catch (_) {}
        updateThemeButton();
      });
    }

    var filter = document.getElementById('page-filter');
    if (filter) {
      filter.addEventListener('input', function () {
        var query = filter.value.toLowerCase().trim();
        document.querySelectorAll('.progression-nav li').forEach(function (item) {
          item.hidden = Boolean(query && item.textContent.toLowerCase().indexOf(query) === -1);
        });
        document.querySelectorAll('.progression-group').forEach(function (group) {
          group.hidden = Boolean(query && !group.querySelector('li:not([hidden])'));
        });
      });
    }

    document.querySelectorAll('.site-main table:not(.imgtable)').forEach(function (table) {
      if (table.parentElement && table.parentElement.classList.contains('table-scroll')) return;
      var wrapper = document.createElement('div');
      var caption = table.querySelector('caption');
      wrapper.className = 'table-scroll';
      wrapper.setAttribute('role', 'region');
      wrapper.setAttribute('tabindex', '0');
      wrapper.setAttribute('aria-label', caption && caption.textContent.trim() || 'Scrollable data table');
      table.parentNode.insertBefore(wrapper, table);
      wrapper.appendChild(table);
    });

    document.querySelectorAll('[onclick*="shohid"] + .autohide').forEach(function (panel, index) {
      var trigger = panel.previousElementSibling;
      if (!trigger) return;
      if (!panel.id) panel.id = 'collapsible-section-' + (index + 1);
      panel.hidden = true;
      trigger.setAttribute('role', 'button');
      trigger.setAttribute('tabindex', '0');
      trigger.setAttribute('aria-controls', panel.id);
      trigger.setAttribute('aria-expanded', 'false');
      trigger.addEventListener('keydown', function (event) {
        if (event.key !== 'Enter' && event.key !== ' ') return;
        event.preventDefault();
        showHide(trigger);
      });
    });

    var main = document.getElementById('main-content');
    var toc = document.getElementById('page-toc');
    var list = document.getElementById('page-toc-list');
    if (!main || !toc || !list) return;
    var headings = Array.prototype.slice.call(main.querySelectorAll('h2, h3')).filter(function (heading) {
      return !heading.closest('[data-guide-entry], .build-card, .research-build-row, .guide-build-card, .guide-detail-source, .build-group-title, .reference-panel-title, .autohide');
    });
    var used = {};
    headings.forEach(function (heading, index) {
      var base = heading.id || heading.textContent.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'section-' + (index + 1);
      var id = base;
      var suffix = 2;
      while (used[id] || (document.getElementById(id) && document.getElementById(id) !== heading)) id = base + '-' + suffix++;
      used[id] = true;
      heading.id = id;
      var item = document.createElement('li');
      if (heading.tagName === 'H3') item.className = 'page-toc-subsection';
      var link = document.createElement('a');
      link.href = '#' + id;
      link.textContent = heading.textContent.trim();
      item.appendChild(link);
      list.appendChild(item);
    });
    toc.hidden = false;
  });
})();
