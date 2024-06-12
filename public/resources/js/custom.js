document.addEventListener('DOMContentLoaded', function() {
    var toggleFiltersBtn = document.getElementById('toggleFilters');
    var filtersPanel = document.getElementById('filtersPanel');

    toggleFiltersBtn.addEventListener('click', function() {
        if (filtersPanel.style.display === 'none' || filtersPanel.style.display === '') {
            filtersPanel.style.display = 'block';
            this.textContent = 'Скрыть фильтры';
        } else {
            filtersPanel.style.display = 'none';
            this.textContent = 'Показать фильтры';
        }
    });
});
