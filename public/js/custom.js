$("#logout").click(function () {
    $.ajax({
        type: 'POST',
        url: '/logout',
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        success: function () {
            $(location).attr('href', '/');
        }
    });
});