$(document).ready(function () {

    $('.message-header').on('click',function () {
        let message_number =  $(this).data('id');
        let $toggleableElements = $('.message-text');
        $toggleableElements.each(function() {
            if (!$(this).is($(this).siblings('.clickable-element'))) {
                $(this).slideUp();
            }
        });
        $('.message-text.text-'+message_number).slideToggle();
    });


    $('#myModal').on('shown.bs.modal', function () {
        $('#myInput').trigger('focus')
    })
});