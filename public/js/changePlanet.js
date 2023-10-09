$(document).ready(function () {
    $('.planet-switcher-select-main, .planet-switcher-select').on('change', function () {
        const selectedOption = $(this).children('option:selected').val();
        const referer = window.location.pathname.split('/')[1] || 'main';
        window.location.href = `/${referer}/${selectedOption}`;
    });
});

