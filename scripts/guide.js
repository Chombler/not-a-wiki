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
        var groups = Array.prototype.slice.call(root.querySelectorAll('.guide-build-group'));
        var count = input.parentElement.querySelector('[data-guide-filter-count]');
        function update() {
            var query = input.value.toLowerCase().trim();
            var visible = 0;
            rows.forEach(function (row) {
                var show = !query || row.textContent.toLowerCase().indexOf(query) !== -1;
                row.hidden = !show;
                if (show) visible++;
            });
            groups.forEach(function (group) {
                group.hidden = !!query && !group.querySelector('[data-guide-entry]:not([hidden])');
            });
            if (count) count.textContent = query ? visible + ' of ' + rows.length : rows.length + ' entries';
        }
        input.addEventListener('input', update);
        update();
    }
    document.querySelectorAll('[data-guide-filter]').forEach(initializeFilter);

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
