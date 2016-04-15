// delete a note
$(document).ready(function () {
    $('[id^=delete_]').click(function () {
        var num = $(this).attr('id').match(/\d+/g);
        if (num.length == 1)
        {
            $.post(
                '/admin/notes/ajax/delete',
                {data : { id : num[0] }}
            ).done(function (data) {
                $('#note_'+num).hide();
            });
        }
        else
        {
            alert("Was an error, see a console");
            console.log('Found more than 1 matches: ' + num);
        }
    });
});
