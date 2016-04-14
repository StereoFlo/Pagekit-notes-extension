// delete a note
$(document).ready(function () {
    $('[id^=delete_]').click(function () {
        var num = $(this).attr('id').match(/\d+/);
        $.post(
            '/admin/notes/ajax/delete',
            {data : { id : num }}
        ).done(function (data) {
            $('#note_'+num).hide();
        });
    });
});
