$(document).ready(function () {

    $('button[data-bs-toggle="modal"]').on('click', function () {
        let extraData = $(this).data('ticketid');
        $('.modal .modal-body #support_answer_ticketId').val(extraData);
    });

    $('#myForm').submit(function (e) {
        e.preventDefault();

        let form = $(this);
        let formData = form.serialize();

        $.ajax({
            type: 'POST',
            url: form.attr('action'),
            data: formData,
            success: function (data) {
                //console.log(data); // Handle the successful response here
            },
            error: function (xhr, status, error) {
                //console.error(error); // Handle the error response here
            }
        });
    });


});