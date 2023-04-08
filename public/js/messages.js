$(document).ready(function () {

    $('.message-header-subject').on('click',function () {
        let message_number =  $(this).data('id');
        let $toggleableElements = $('.message-text');
        $toggleableElements.each(function() {
            if (!$(this).is($(this).siblings('.clickable-element'))) {
                $(this).slideUp();
            }
        });
        $('.message-text.text-'+message_number).slideToggle();
    });

    $('.answer-message').on('click',function () {

        let slug = $(this).parent().parent().data('slug');
        let from = $(this).parent().parent().data('name');

        $('#messageModal').find('.username').html(from);
        $('#messageModal #messages_slug').val(slug);
        $('#messageModal').modal('show');
    });

});