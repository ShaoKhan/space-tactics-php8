$(document).ready(function () {
    $('.planet-switcher-select-main, .planet-switcher-select').on('change', function () {
        let path = window.location.pathname.split('/');
        let referer = path[1];

        //ToDo geht nicht, wenn die Route keinen Controller hat (https://127.0.0.1:8000)

        document.location.href = '/' + referer + '/' + $(this).children("option:selected").val();
    })
});

