$(document).ready(function () {
    $('.planet-switcher-select').on('change', function () {

        document.location.href = '/main/'+$(this).children("option:selected").val();
    })
});

