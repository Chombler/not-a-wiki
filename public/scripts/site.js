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
    var supportsTrueHover = !window.matchMedia || window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    if (window.jQuery && supportsTrueHover) {
      window.jQuery('[research]').style_my_tooltips();
      window.jQuery('[data-research]').style_my_tooltips({ attribute: 'data-research' });
    }

    if (!document.getElementById('s-m-t-tooltip')) {
      var tooltipShell = document.createElement('div');
      tooltipShell.id = 's-m-t-tooltip';
      tooltipShell.appendChild(document.createElement('div'));
      tooltipShell.style.display = 'none';
      tooltipShell.style.position = 'absolute';
      document.body.appendChild(tooltipShell);
    }

    var touchTooltip = document.getElementById('s-m-t-tooltip');
    var activeTouchHotspot = null;
    var closeTouchTooltip = function () {
      if (!touchTooltip || !activeTouchHotspot) return;
      touchTooltip.style.display = 'none';
      touchTooltip.style.opacity = '0';
      touchTooltip.style.zIndex = '-1';
      activeTouchHotspot.setAttribute('aria-expanded', 'false');
      activeTouchHotspot = null;
    };
    var openTouchTooltip = function (hotspot, event) {
      if (!touchTooltip) return;
      var content = hotspot.getAttribute('research') || hotspot.getAttribute('data-research');
      if (!content && window.jQuery) content = window.jQuery(hotspot).data('smt-title');
      if (!content) return;
      if (activeTouchHotspot === hotspot) {
        closeTouchTooltip();
        return;
      }
      closeTouchTooltip();
      if (window.jQuery) {
        var legacyHotspot = window.jQuery(hotspot);
        legacyHotspot.removeClass('smt-current-element');
        window.jQuery(document).unbind('mousemove');
        if (!hotspot.getAttribute('research') && hotspot.hasAttribute('research')) hotspot.setAttribute('research', content);
        if (!hotspot.getAttribute('data-research') && hotspot.hasAttribute('data-research')) hotspot.setAttribute('data-research', content);
      }
      activeTouchHotspot = hotspot;
      hotspot.setAttribute('aria-expanded', 'true');
      touchTooltip.children[0].innerHTML = content;
      touchTooltip.style.display = 'block';
      touchTooltip.style.opacity = '1';
      touchTooltip.style.zIndex = '9999';
      var point = event.changedTouches && event.changedTouches[0] || event;
      var clientX = Number.isFinite(point.clientX) ? point.clientX : window.innerWidth / 2;
      var clientY = Number.isFinite(point.clientY) ? point.clientY : window.innerHeight / 2;
      var margin = 12;
      var left = window.scrollX + Math.max(margin, Math.min(clientX + 12, window.innerWidth - touchTooltip.offsetWidth - margin));
      var top = window.scrollY + clientY + 20;
      if (top + touchTooltip.offsetHeight > window.scrollY + window.innerHeight - margin) {
        top = window.scrollY + Math.max(margin, clientY - touchTooltip.offsetHeight - 12);
      }
      touchTooltip.style.left = left + 'px';
      touchTooltip.style.top = top + 'px';
    };

    document.querySelectorAll('img[usemap]').forEach(function (image) {
      var mapName = image.getAttribute('usemap').replace(/^#/, '');
      var imageMap = Array.prototype.find.call(document.querySelectorAll('map[name]'), function (candidate) {
        return candidate.getAttribute('name') === mapName;
      });
      if (!imageMap) return;
      var areas = Array.prototype.slice.call(imageMap.querySelectorAll('area[coords]'));
      areas.forEach(function (area) {
        if (!area.dataset.originalCoords) area.dataset.originalCoords = area.getAttribute('coords');
      });
      var resizeMap = function () {
        if (!image.naturalWidth || !image.naturalHeight || !image.clientWidth || !image.clientHeight) return;
        var scaleX = image.clientWidth / image.naturalWidth;
        var scaleY = image.clientHeight / image.naturalHeight;
        areas.forEach(function (area) {
          var original = area.dataset.originalCoords.split(',').map(Number);
          var shape = (area.getAttribute('shape') || 'rect').toLowerCase();
          var scaled = original.map(function (coordinate, index) {
            if (shape === 'circle' && index === 2) return Math.round(coordinate * (scaleX + scaleY) / 2);
            return Math.round(coordinate * (index % 2 === 0 ? scaleX : scaleY));
          });
          area.setAttribute('coords', scaled.join(','));
        });
      };
      if (image.complete) resizeMap();
      else image.addEventListener('load', resizeMap, { once: true });
      if (window.ResizeObserver) new ResizeObserver(resizeMap).observe(image);
      else window.addEventListener('resize', resizeMap);
    });

    document.querySelectorAll('area[research], area[data-research], .trophy-grid-button[research]').forEach(function (hotspot) {
      if (!hotspot.getAttribute('href')) {
        hotspot.setAttribute('role', 'button');
        hotspot.setAttribute('tabindex', '0');
      }
      hotspot.setAttribute('aria-expanded', 'false');
      hotspot.addEventListener('click', function (event) {
        if (hotspot.getAttribute('href') && window.matchMedia('(hover: hover) and (pointer: fine)').matches) return;
        event.preventDefault();
        event.stopPropagation();
        openTouchTooltip(hotspot, event);
      });
      hotspot.addEventListener('keydown', function (event) {
        if (event.key !== 'Enter' && event.key !== ' ') return;
        if (event.key === 'Enter' && hotspot.getAttribute('href')) return;
        event.preventDefault();
        event.stopPropagation();
        openTouchTooltip(hotspot, event);
      });
    });
    document.addEventListener('click', function (event) {
      if (activeTouchHotspot && event.target !== activeTouchHotspot) closeTouchTooltip();
    });
    window.addEventListener('scroll', closeTouchTooltip, { passive: true });

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
