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

                function displayMessages(messages, element) {
                    if (messages.length > 0) {
                        let messageElement = $(element);
                        let ul = $('<ul>');

                        messageElement.css('display', 'block');
                        messages.foreach = (message) => {
                            ul.append($('<li>').text(message));
                        }
                        messageElement.html(ul);
                    }
                    location.reload();
                }

                displayMessages(successMessages, '.alert-success');
                displayMessages(errorMessages, '.alert-danger');
            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    });
});