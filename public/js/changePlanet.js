$(document).ready(function () {
    console.log('da');
    $('.planet-switcher-select-main, .planet-switcher-select').on('change', function () {
        console.log($(this));
        let path = window.location.pathname.split('/');
        let referer = path[1];
        document.location.href = '/' + referer + '/' + $(this).children("option:selected").val();
    })
});

