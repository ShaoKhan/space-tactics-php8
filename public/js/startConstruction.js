$(document).ready(function () {
    $('.start-construction').on('click', function () {

        let planetId = $('.planet-switcher-select').find(':selected').val();
        let data = $(this).data('values');

        $.ajax({
            url: '/startConstruction',
            method: 'POST',
            data: {
                planetId: planetId,
                buildingId: data
            },
            success: function (response) {
                let successMessages = response.successMessages;
                let errorMessages = response.errorMessages;
                let building = response.building;
                displayMessages(successMessages, '.alert-success', building);
                displayMessages(errorMessages, '.alert-danger');
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});

function displayMessages(messages, element, building = false) {
    if (messages.length > 0) {
        let messageElement = $(element);
        let ul = $('<ul>');

        messageElement.css('display', 'block');
        messages.forEach((message) => {
            if (building) {
                message += ' ' + building;
            }
            ul.append($('<li>').text(message));
        });
        messageElement.append(ul);
    }
    location.reload();
}