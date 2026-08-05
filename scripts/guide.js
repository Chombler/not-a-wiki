(function () {
    function copyText(value, button) {
        function legacyCopy() {
            var field = document.createElement('textarea');
            field.value = value;
            field.setAttribute('readonly', '');
            field.style.position = 'fixed';
            field.style.opacity = '0';
            document.body.appendChild(field);
            field.select();
            document.execCommand('copy');
            field.remove();
        }
        if (navigator.clipboard && navigator.clipboard.writeText) navigator.clipboard.writeText(value).catch(legacyCopy);
        else legacyCopy();
        var original = button.textContent;
        button.textContent = 'Copied';
        window.setTimeout(function () { button.textContent = original; }, 1200);
    }

    document.addEventListener('click', function (event) {
        var button = event.target.closest('[data-build], [data-copy-build], [data-template-target]');
        if (!button) return;
        var target = button.getAttribute('data-template-target');
        var value = target ? document.getElementById(target).value : (button.getAttribute('data-build') || button.getAttribute('data-copy-build'));
        if (value) copyText(value, button);
    });

    function initializeFilter(input) {
        var root = document.querySelector(input.getAttribute('data-guide-filter-target'));
        if (!root) return;
        var rows = Array.prototype.slice.call(root.querySelectorAll('[data-guide-entry]'));
        var count = input.parentElement.querySelector('[data-guide-filter-count]');
        function update() {
            var query = input.value.toLowerCase().trim();
            var visible = 0;
            rows.forEach(function (row) {
                var show = !query || row.textContent.toLowerCase().indexOf(query) !== -1;
                row.hidden = !show;
                if (show) visible++;
            });
            if (count) count.textContent = query ? visible + ' of ' + rows.length : rows.length + ' entries';
        }
        input.addEventListener('input', update);
        update();
    }
    document.querySelectorAll('[data-guide-filter]').forEach(initializeFilter);

    document.querySelectorAll('[data-guide-view-switcher]').forEach(function (switcher) {
        var buttons = Array.prototype.slice.call(switcher.querySelectorAll('[data-guide-view]'));
        var description = switcher.querySelector('[data-guide-view-description]');
        var contents = Array.prototype.slice.call(document.querySelectorAll('[data-guide-view-content]'));
        var labels = {
            progression: 'Follow the era in order with context, requirements, and play notes.',
            lookup: 'Search and copy a known build without reading the full progression guide.'
        };
        function selectView(view) {
            buttons.forEach(function (button) {
                var active = button.getAttribute('data-guide-view') === view;
                button.classList.toggle('is-active', active);
                button.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
            contents.forEach(function (content) {
                content.hidden = content.getAttribute('data-guide-view-content') !== view;
            });
            if (description) description.textContent = labels[view];
        }
        buttons.forEach(function (button) {
            button.addEventListener('click', function () { selectView(button.getAttribute('data-guide-view')); });
        });
        document.addEventListener('click', function (event) {
            var link = event.target.closest('a[href^="#"]');
            if (!link) return;
            var target = document.querySelector(link.getAttribute('href'));
            var viewContent = target && target.closest('[data-guide-view-content]');
            if (viewContent) selectView(viewContent.getAttribute('data-guide-view-content'));
        });
        var hashTarget = location.hash && document.querySelector(location.hash);
        var hashContent = hashTarget && hashTarget.closest('[data-guide-view-content]');
        selectView(hashContent ? hashContent.getAttribute('data-guide-view-content') : 'progression');
        if (hashContent) window.requestAnimationFrame(function () { hashTarget.scrollIntoView(); });
    });

    document.addEventListener('DOMContentLoaded', function () {
      var intro = document.querySelector('.guide-intro');
      var toc = document.getElementById('page-toc-list');
      if (intro && toc) {
        var links = Array.prototype.slice.call(toc.querySelectorAll('a')).filter(function (link) { return link.getAttribute('href') !== '#main-content'; });
        if (links.length > 3) {
            var wrapper = document.createElement('label');
            wrapper.className = 'guide-mobile-jump';
            wrapper.appendChild(document.createTextNode('Jump to section'));
            var select = document.createElement('select');
            select.setAttribute('aria-label', 'Jump to guide section');
            var prompt = document.createElement('option');
            prompt.value = '';
            prompt.textContent = 'Choose a section…';
            select.appendChild(prompt);
            links.forEach(function (link) {
                var option = document.createElement('option');
                option.value = link.getAttribute('href');
                option.textContent = link.textContent;
                select.appendChild(option);
            });
            select.addEventListener('change', function () { if (select.value) location.hash = select.value; });
            wrapper.appendChild(select);
            intro.appendChild(wrapper);
        }
      }
    });
})();
