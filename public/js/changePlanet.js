$(document).ready(function () {
    $('.planet-switcher-select-main, .planet-switcher-select').on('change', function () {
        const selectedOption = $(this).children('option:selected').val();
        const referer = window.location.pathname.split('/')[1] || 'main';
        const sanitizedSelectedOption = encodeURIComponent(selectedOption); // Sanitize the selected option
        const sanitizedReferer = encodeURIComponent(referer); // Sanitize the referer
        window.location.href = `/${sanitizedReferer}/${sanitizedSelectedOption}`;
    });
});
