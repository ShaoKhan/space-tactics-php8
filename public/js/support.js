$(document).ready(function () {

    $('.ticket').on('click',function () {
        let message_number =  $(this).data('ticket');
        $('.ticket-body-'+message_number).slideToggle();

    });

    
});