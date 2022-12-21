$(document).ready(function () {
    $('.planet-switcher-select').on('change', function () {
        let path = window.location.pathname.split('/');
        let referer = path[1];
        //window.location.href = '/' + referer + '/' + $(this).children("option:selected").val();
        document.location.href = '/buildings/'+$(this).children("option:selected").val();
    })
});

