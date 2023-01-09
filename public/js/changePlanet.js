$(document).ready(function () {
    $('.planet-switcher-select-main, .planet-switcher-select').on('change', function () {
        let path = window.location.pathname.split('/');
        let referer = path[1];
        document.location.href = '/' + referer + '/' + $(this).children("option:selected").val();
    })
});

